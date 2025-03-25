<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the CORS settings for your application. 
    | You can allow or restrict the origins, methods, and headers as needed.
    |
    */

    'paths' => ['api/*'],  // Aplica CORS solo a las rutas que comienzan con 'api/'

    'allowed_methods' => ['*'],  // Permite todos los métodos HTTP (GET, POST, PUT, DELETE, etc.)

    'allowed_origins' => ['*'],  // Permite solicitudes desde cualquier origen (cualquier dominio)

    'allowed_origins_patterns' => [],  // Puedes usar expresiones regulares si necesitas restringir aún más los orígenes

    'allowed_headers' => ['*'],  // Permite todos los encabezados HTTP

    'exposed_headers' => [],  // Si necesitas exponer algunos encabezados adicionales

    'max_age' => 0,  // Tiempo en segundos que el navegador puede almacenar la respuesta CORS en caché

    'supports_credentials' => false,  // Si se deben soportar credenciales (cookies, autorizaciones HTTP, etc.)
];
