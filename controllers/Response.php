<?php

class Response {
    public static function sendResponse($data, $code = 200)
    {
        header('Content-Type: application/json');
        http_response_code($code); // Código de estado HTTP 200 OK
        echo json_encode($data);
    }
}