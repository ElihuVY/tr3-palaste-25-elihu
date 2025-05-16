<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ProjectRequest;
use PDF;

class ProjectRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $projectRequest;

    public function __construct(ProjectRequest $projectRequest)
    {
        $this->projectRequest = $projectRequest;
    }

    public function build()
{
    // Generar el PDF desde la vista
    $pdf = PDF::loadView('emails.project-request-pdf', ['project' => $this->projectRequest]);

    // Obtener la fecha actual formateada
    $fecha = now()->format('Y-m-d'); // Ejemplo: 2025-05-16
    $fileName = "solicitud_{$fecha}.pdf";

    return $this->subject('Nueva solicitud de proyecto')
        ->view('emails.project-request', ['project' => $this->projectRequest])
        ->attachData($pdf->output(), $fileName, [
            'mime' => 'application/pdf',
        ]);
}

}
