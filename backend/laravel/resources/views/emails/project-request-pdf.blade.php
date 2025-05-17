<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Solicitud de Proyecto</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
        <h1 style="color: #2c3e50; text-align: center; margin-bottom: 20px; border-bottom: 2px solid #3498db; padding-bottom: 10px;">Solicitud de Proyecto</h1>
        
        <div style="background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <div style="margin-bottom: 15px;">
                <p style="margin: 10px 0;"><strong style="color: #2c3e50;">Nombre:</strong> <span style="color: #444;">{{ $project->name }}</span></p>
                <p style="margin: 10px 0;"><strong style="color: #2c3e50;">Email:</strong> <span style="color: #444;">{{ $project->email }}</span></p>
                <p style="margin: 10px 0;"><strong style="color: #2c3e50;">Teléfono:</strong> <span style="color: #444;">{{ $project->phone }}</span></p>
                <p style="margin: 10px 0;"><strong style="color: #2c3e50;">Dirección:</strong> <span style="color: #444;">{{ $project->address }}</span></p>
            </div>

            <div style="margin-bottom: 15px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                <p style="margin: 10px 0;"><strong style="color: #2c3e50;">Tipo de Proyecto:</strong> <span style="color: #444;">{{ $project->project_type }}</span></p>
                <p style="margin: 10px 0;"><strong style="color: #2c3e50;">Presupuesto:</strong> <span style="color: #444;">{{ $project->budget }}</span></p>
                <p style="margin: 10px 0;"><strong style="color: #2c3e50;">Plazo estimado:</strong> <span style="color: #444;">{{ $project->timeline }}</span></p>
            </div>

            <div style="margin-bottom: 15px;">
                <p style="margin: 10px 0;"><strong style="color: #2c3e50;">Descripción:</strong></p>
                <p style="color: #444; background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin-top: 5px;">{{ $project->description }}</p>
            </div>

        </div>
    </div>
</body>
</html>
