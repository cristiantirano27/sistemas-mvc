<?php

require_once __DIR__."/../vendor/autoload.php";
use app\core\Application;

$app = new Application();

$app->setRoute("/", "home");
$app->setRoute("/admin", "admin");

$callback = $app->run();

echo $callback;

?>
<br>