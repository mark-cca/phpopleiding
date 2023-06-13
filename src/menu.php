<?php
$request = $_SERVER['REQUEST_URI'];

$state = isset($_GET['state']) ? $_GET['state'] : '';

if ($state) {

        require __DIR__ . '/../public/views/uselessbox.php';

}

else{
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
        case '/mum' :
            require __DIR__ . '/../public/views/uselessbox.php';
            break;
        default:
            http_response_code(404);
            require __DIR__ . '/../public/views/404.php';
            break;
    }
}



