<?php

namespace App\Mail;

use App\Models\ProjectRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProjectRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    protected $pdfGenerated = false;
    protected $attachedFiles = [];

    public function __construct(ProjectRequest $project)
    {
        $this->project = $project;
    }

    public function build()
    {
        $email = $this->subject('Nueva Solicitud de Proyecto')
                      ->view('emails.project-request'); // Vista alternativa simple

        try {
            // Generar el PDF
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('emails.project-request-pdf', ['project' => $this->project]);
            
            // Generar nombre con fecha
            $fecha = now()->format('Y-m-d_H-i-s');
            $pdfName = 'solicitud_' . $fecha . '.pdf';
            
            $email->attachData($pdf->output(), $pdfName, [
                'mime' => 'application/pdf',
            ]);
            
            $this->pdfGenerated = true;
        } catch (Exception $e) {
            Log::error('Error al generar PDF: ' . $e->getMessage());
            // Continuar sin el PDF adjunto
            $email->view('emails.project-request-pdf', ['project' => $this->project]);
        }

        // Adjuntar archivos si existen
        try {
            $files = is_string($this->project->files) 
                ? json_decode($this->project->files, true) 
                : $this->project->files;
                
            if (is_array($files)) {
                foreach ($files as $filePath) {
                    try {
                        // Verificar si es una ruta relativa o absoluta
                        $fullPath = strpos($filePath, '/') === 0 
                            ? $filePath 
                            : storage_path('app/public/' . $filePath);
                            
                        if (file_exists($fullPath)) {
                            $email->attach($fullPath);
                            $this->attachedFiles[] = $fullPath;
                        } else {
                            Log::warning("Archivo no encontrado: {$fullPath}");
                        }
                    } catch (Exception $e) {
                        Log::error("Error al adjuntar archivo {$filePath}: " . $e->getMessage());
                        // Continuar con el siguiente archivo
                    }
                }
            }
        } catch (Exception $e) {
            Log::error('Error al procesar archivos adjuntos: ' . $e->getMessage());
            // Continuar sin archivos adjuntos
        }

        // Agregar información sobre errores en la generación
        $email->with([
            'pdfGenerated' => $this->pdfGenerated,
            'attachedFilesCount' => count($this->attachedFiles),
            'totalFilesCount' => is_array($files ?? null) ? count($files) : 0
        ]);

        return $email;
    }
}
