-- ========================================================
-- Universidad de La Salle - Asignatura: Bases de Datos
-- Guía de Laboratorio: De MySQL a una aplicación web con PHP
-- Docente: Gabriel Barrera · 2026
--
-- BASE DE DATOS ÚNICA: universidad_db
-- Este archivo contiene todo lo necesario en una sola ejecución:
-- 1. Creación de la base de datos universidad_db
-- 2. Creación de la tabla estudiantes
-- 3. Inserción de los registros iniciales (Ana y Luis)
-- 4. Creación del usuario app_lasalle con sus permisos
-- ========================================================

-- 1. Crear y seleccionar la base de datos única
CREATE DATABASE IF NOT EXISTS universidad_db
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE universidad_db;

-- 2. Crear la tabla estudiantes
CREATE TABLE IF NOT EXISTS estudiantes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  correo VARCHAR(150) NOT NULL UNIQUE,
  programa VARCHAR(100) NOT NULL
);

-- 3. Insertar registros iniciales de prueba
INSERT INTO estudiantes (nombre, correo, programa) VALUES
('Ana Torres', 'ana@example.com', 'Ingeniería de Sistemas'),
('Luis Pérez', 'luis@example.com', 'Ingeniería Industrial');

-- 4. Crear usuario de aplicación con permisos limitados (SELECT e INSERT)
CREATE USER IF NOT EXISTS 'app_lasalle'@'localhost'
IDENTIFIED BY 'Cambiar_Esta_Clave_2026!';

GRANT SELECT, INSERT ON universidad_db.*
TO 'app_lasalle'@'localhost';

FLUSH PRIVILEGES;
