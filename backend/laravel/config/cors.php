<?php
return [
    'paths' => ['*'], // Permite CORS en toda la API

    'allowed_methods' => ['*'], // Permitir cualquier método HTTP

    'allowed_origins' => ['*','https://palaste.com'], // Cambia '' por la URL de tu frontend

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Permitir cualquier encabezado

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // Si usas autenticación con cookies, ponlo en 'true'
];