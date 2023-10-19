<?php

namespace app\core;

class Router
{
    public function __construct() 
    {
    }

    public function setRouter(string $url, string $callback) 
    {
        echo "Router : {$url} is set to call function: {$callback} </br>";
    }
}
