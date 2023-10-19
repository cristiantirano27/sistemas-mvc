<?php

require_once __DIR__."/vendor/autoload.php";
use app\core\Application;

$app = new Application();

$app->router->setRouter("/", "loadHomePage");
$app->router->setRouter("/admin", "loadAdminPage");

?>
Hello World! <br>