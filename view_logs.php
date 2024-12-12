<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Conexiones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .no-data {
            text-align: center;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registro de Conexiones</h1>
        <?php
        $logFile = 'connections.log';
        if (file_exists($logFile) && filesize($logFile) > 0) {
            $logs = array_reverse(file($logFile));
            echo '<table>';
            echo '<thead><tr><th>Fecha y Hora</th><th>Mensaje</th></tr></thead>';
            echo '<tbody>';
            foreach ($logs as $log) {
                $parts = explode(' - ', $log, 2);
                echo '<tr>';
                echo '<td>' . htmlspecialchars($parts[0]) . '</td>';
                echo '<td>' . htmlspecialchars($parts[1]) . '</td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<p class="no-data">No hay registros disponibles.</p>';
        }
        ?>
    </div>
</body>
</html>