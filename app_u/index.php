<?php
    require_once "./config/app.php";
    require_once "./autoload.php";
    require_once "./app/views/inc/session_start.php";

    if (isset($_GET['views'])) {
        $url = explode("/", $_GET['views']);
    } else {
        $url = ["login"];
    }
?>
<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <?php require_once "./app/views/inc/head.php"; ?>
</head>
<body>
    <h1 class="title">Title</h1>
    <h2 class="subtitle">Subtitle</h2>
    <?php require_once "./app/views/inc/script.php"; ?>
</body>
</html>