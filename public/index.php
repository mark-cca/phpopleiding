<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Mark van der Zande</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/custom.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>

<?php require __DIR__ . '/views/menu.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <?php $request = $_SERVER['REQUEST_URI'];


            switch ($request) {
                case '/' :
                    require __DIR__ . '/views/home.php';
                    break;
                case '/bmi' :
                    require __DIR__ . '/views/bmi.php';
                    break;
                default:
                    http_response_code(404);
                    require __DIR__ . '/views/404.php';
                    break;
            } ?>

        </div>
    </div>
</div>


</body>
</html>