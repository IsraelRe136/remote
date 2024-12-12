<?php
$logFile = 'connections.log';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Leer registros y devolverlos como JSON
    if (file_exists($logFile) && filesize($logFile) > 0) {
        $logs = [];
        $lines = file($logFile, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            $parts = explode(' - ', $line, 2);
            $logs[] = ['timestamp' => $parts[0], 'message' => $parts[1]];
        }
        header('Content-Type: application/json');
        echo json_encode($logs);
    } else {
        header('Content-Type: application/json');
        echo json_encode([]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (isset($data['message'])) {
        $message = $data['message'];
        $timestamp = date('Y-m-d H:i:s');
        file_put_contents($logFile, "$timestamp - $message" . PHP_EOL, FILE_APPEND);
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Log registrado.']);
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Datos inválidos.']);
    }
    exit;
}