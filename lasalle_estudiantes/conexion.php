<?php
/**
 * Conexión a MySQL usando PDO (PHP Data Objects)
 * Universidad de La Salle - Bases de Datos 2026
 */

$servidor   = 'localhost';
$puerto     = '3306'; // Cambiar a '3307' si MySQL en tu XAMPP corre en dicho puerto
$baseDatos  = 'universidad_db';

// Opción 1: Usuario creado según el laboratorio (Recomendado)
$usuario    = 'app_lasalle';
$contrasena = 'Cambiar_Esta_Clave_2026!';

// Opción 2: Usuario por defecto de XAMPP (descomentar si no has creado app_lasalle)
// $usuario    = 'root';
// $contrasena = '';

$dsn = "mysql:host=$servidor;port=$puerto;dbname=$baseDatos;charset=utf8mb4";

try {
    $conexion = new PDO($dsn, $usuario, $contrasena, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
    ]);
} catch (PDOException $e) {
    // Registra el detalle del error en los logs internos del servidor (Apache/PHP)
    error_log($e->getMessage());
    http_response_code(500);
    // Mensaje genérico sin exponer detalles técnicos al usuario final
    exit('No fue posible conectar con la base de datos.');
}
