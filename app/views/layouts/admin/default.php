<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <title>Hello, world!</title>
</head>
<body>
<?= $content ?>
<script src="bootstrap/js/bootstrap.min.js"></script>
<?php
    foreach ($scripts as $script) {
        echo $script;
    }
?>
</body>
</html>