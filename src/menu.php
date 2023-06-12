<?php
$request = $_SERVER['REQUEST_URI'];


switch ($request) {
    case '/' :
        require __DIR__ . '/../public/views/home.php';
        break;
    case '/bmi' :
        require __DIR__ . '/../public/views/bmi.php';
        break;
    case '/emokonijn' :
        require __DIR__ . '/../public/views/emokonijn.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/../public/views/404.php';
        break;
}
