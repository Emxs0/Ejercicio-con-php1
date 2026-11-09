<?php
require __DIR__ . '/conexion.php';

// Validar que la petición sea estrictamente por método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método no permitido.');
}

// Capturar y limpiar espacios en blanco con trim()
$nombre   = trim($_POST['nombre'] ?? '');
$correo   = trim($_POST['correo'] ?? '');
$programa = trim($_POST['programa'] ?? '');

// Validación de datos en el servidor
if ($nombre === '' || $programa === '' ||
    !filter_var($correo, FILTER_VALIDATE_EMAIL) ||
    strlen($nombre) > 100 || strlen($correo) > 150 ||
    strlen($programa) > 100) {
    http_response_code(400);
    exit('Datos inválidos. Regrese y revise el formulario.');
}

try {
    // Consulta preparada con marcadores de posición nombrados para prevenir Inyección SQL
    $sql = 'INSERT INTO estudiantes (nombre, correo, programa)
            VALUES (:nombre, :correo, :programa)';
    
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([
        ':nombre'   => $nombre,
        ':correo'   => $correo,
        ':programa' => $programa
    ]);

    // Redirección POST/Redirect/GET con código HTTP 303 (See Other)
    header('Location: index.php', true, 303);
    exit;
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    // Mensaje descriptivo amigable para el usuario si se viola la restricción UNIQUE del correo
    exit('No se pudo guardar. Revise si el correo ya existe.');
}
