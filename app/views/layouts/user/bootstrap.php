<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?=
        \mpf\core\base\View::getMeta();
    ?>

    <!-- Bootstrap CSS -->
<!--    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">-->
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
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