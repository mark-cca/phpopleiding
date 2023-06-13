<?php
$request = strtok($_SERVER['REQUEST_URI'], '?');


$param = $_GET['id'] ?? null;


$state = $_GET['state'] ?? '';

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
        case '/artikelen' :
            require __DIR__ . '/../public/views/database.php';
            break;
        case '/toevoegen/' :
            require __DIR__ . '/../public/views/partials/artikel_toevoegen.php';
            break;
        case '/bewerken/' :
            if ($param !== null) {
                $_GET['id'] = $param; // Set the parameter in $_GET['id']
            }
            require __DIR__ . '/../public/views/partials/artikel_bewerken.php';
            break;
        case '/verwijderen/' :
            if ($param !== null) {
                $_GET['id'] = $param; // Set the parameter in $_GET['id']
            }
            require __DIR__ . '/../public/views/partials/artikel_verwijderen.php';
            break;
        default:
            http_response_code(404);
            require __DIR__ . '/../public/views/404.php';
            break;
    }
}



