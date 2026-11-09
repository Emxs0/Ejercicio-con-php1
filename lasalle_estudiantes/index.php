<?php
require __DIR__ . '/conexion.php';

$consulta = $conexion->query(
    'SELECT id, nombre, correo, programa FROM estudiantes ORDER BY id DESC'
);
$estudiantes = $consulta->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes - La Salle</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
        }
        h1, h2 {
            color: #0b3c5d;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            margin-bottom: 25px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
            border-radius: 6px;
            overflow: hidden;
        }
        th, td {
            padding: 10px 14px;
            text-align: left;
            border-bottom: 1px solid #e1e4e8;
        }
        th {
            background-color: #0b3c5d;
            color: #ffffff;
        }
        tr:hover {
            background-color: #f1f5f9;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }
        label {
            display: block;
            margin-bottom: 12px;
            font-weight: 600;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 8px 10px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #0b3c5d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
        }
        button[type="submit"]:hover {
            background-color: #1d5f8a;
        }
        .empty-message {
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h1>Registro de estudiantes</h1>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Programa</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($estudiantes)): ?>
                <tr>
                    <td colspan="4" class="empty-message">No hay estudiantes registrados.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($estudiantes as $fila): ?>
                <tr>
                    <td><?= (int) $fila['id'] ?></td>
                    <td><?= htmlspecialchars($fila['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($fila['correo'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($fila['programa'], ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Agregar estudiante</h2>
    <form action="guardar.php" method="post">
        <label>
            Nombre:
            <input type="text" name="nombre" required maxlength="100" placeholder="Ej: Carlos Gómez">
        </label>
        <label>
            Correo:
            <input type="email" name="correo" required maxlength="150" placeholder="Ej: carlos@example.com">
        </label>
        <label>
            Programa:
            <input type="text" name="programa" required maxlength="100" placeholder="Ej: Ingeniería de Sistemas">
        </label>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
