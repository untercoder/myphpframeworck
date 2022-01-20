<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <title>Ошибка!</title>
</head>
<body>
<h1>Ошибка.</h1>

<p><b>Код ошибки: </b> <?= $errno ?></p>
<p><b>Текст ошибки: </b><?= $errstr?></p>
<p><b>Фаил ошибки: </b><?= $errfile ?></p>
<p><b>Строка ошибки: </b><?= $errline ?></p>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>