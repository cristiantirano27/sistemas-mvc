<?php

require_once __DIR__."/../vendor/autoload.php";
use app\core\Application;

$app = new Application();

$app->setRoute("/", "loadHomePage");
$app->setRoute("/admin", "loadAdminPage");

$return = $app->run();



?>
<br>