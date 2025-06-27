<?php
// core/ApiSyntax.php

// ROUTING
function PostOn($route, $callback) {
    global $router;
    $router->post($route, $callback);
}

function GetOn($route, $callback) {
    global $router;
    $router->get($route, $callback);
}

function PutOn($route, $callback) {
    global $router;
    $router->put($route, $callback);
}

function PatchOn($route, $callback) {
    global $router;
    $router->patch($route, $callback);
}

function DeleteOn($route, $callback) {
    global $router;
    $router->delete($route, $callback);
}

// INPUT
function PostIn($callback) {
    $data = json_decode(file_get_contents('php://input'), true) ?? [];
    $callback($data);
}

function PutIn($callback) {
    $data = json_decode(file_get_contents('php://input'), true) ?? [];
    $callback($data);
}

function PatchIn($callback) {
    $data = json_decode(file_get_contents('php://input'), true) ?? [];
    $callback($data);
}

// VALIDATION
function PosValidate($data, $fields) {
    foreach ($fields as $field) {
        if (empty($data[$field])) {
            PostRespond("Falta el campo '$field'", null, 400);
            exit;
        }
    }
}

function PosExpect($data, $schema) {
    foreach ($schema as $field => $type) {
        if (!isset($data[$field])) {
            PostRespond("Campo requerido: $field", null, 400);
            exit;
        }
        $value = $data[$field];
        switch ($type) {
            case 'string':
                if (!is_string($value)) PostRespond("El campo $field debe ser texto", null, 400);
                break;
            case 'integer':
                if (!is_int($value)) PostRespond("El campo $field debe ser entero", null, 400);
                break;
            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) PostRespond("El campo $field no es un email válido", null, 400);
                break;
            default:
                break;
        }
    }
}

// SECURITY
function PostSecure($method = 'API_KEY') {
    $headers = getallheaders();
    if ($method === 'API_KEY') {
        if (!isset($headers['X-API-KEY']) || $headers['X-API-KEY'] !== '123456') {
            PostRespond('Acceso no autorizado', null, 401);
            exit;
        }
    }
    // Placeholder para JWT u otros métodos
}

// LOGGING
function PostLog($message) {
    $date = date('Y-m-d H:i:s');
    $log = "[$date] $message
";
    file_put_contents(__DIR__ . '/../logs/app.log', $log, FILE_APPEND);
}

// ACTION
function PostAction($callback) { $callback(); }
function GetAction($callback) { $callback(); }
function PutAction($callback) { $callback(); }
function PatchAction($callback) { $callback(); }
function DeleteAction($callback) { $callback(); }

// RESPONSE
function PostRespond($message, $data = null, $code = 200) {
    echo Response::json([
        'success' => $code < 400,
        'message' => $message,
        'data' => $data
    ], $code); exit;
}

function GetRespond($message, $data = null, $code = 200) {
    echo Response::json([
        'success' => $code < 400,
        'message' => $message,
        'data' => $data
    ], $code); exit;
}

function PutRespond($message, $data = null, $code = 200) {
    echo Response::json([
        'success' => $code < 400,
        'message' => $message,
        'data' => $data
    ], $code); exit;
}

function PatchRespond($message, $data = null, $code = 200) {
    echo Response::json([
        'success' => $code < 400,
        'message' => $message,
        'data' => $data
    ], $code); exit;
}

function DeleteRespond($message, $data = null, $code = 200) {
    echo Response::json([
        'success' => $code < 400,
        'message' => $message,
        'data' => $data
    ], $code); exit;
}

// ERROR HANDLER GLOBAL
set_exception_handler(function($e) {
    echo Response::json([
        'success' => false,
        'error' => $e->getMessage()
    ], 500);
});
