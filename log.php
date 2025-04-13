<?php
$data = json_decode(file_get_contents('php://input'), true);

error_log(print_r($data, true));

if ($data) {
    $file = __DIR__ . '/log.json';

    try {
        if (!file_exists($file)) {
            if (!file_put_contents($file, json_encode([$data], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
                throw new Exception('Не вдалося створити файл log.json');
            }
        } else {
            $current = json_decode(file_get_contents($file), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Помилка читання JSON: ' . json_last_error_msg());
            }
            $current[] = $data;
            if (!file_put_contents($file, json_encode($current, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
                throw new Exception('Не вдалося записати у файл log.json');
            }
        }
        http_response_code(200);
        echo json_encode(['status' => 'ok']);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(['status' => 'no data']);
}
?>