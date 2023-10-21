<?php

namespace app\core;

class Router
{
    protected array $routes;

    public function __construct() 
    {
    }

    public function setRoute(string $url, string $callback) 
    {
        $this->routes[] = [$url, $callback];
        // echo "Router : {$url} is set to call function: {$callback} </br>";
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getPath()
    {
        $uri = $_SERVER["REQUEST_URI"] ?? "/";    
        $search = "/App";
        $path = str_replace($search, "", $uri);

        $search = "?";
        $indexLocation = strpos($path, $search);

        if (is_int($indexLocation)) 
        {
            $path = substr($path, 0, $indexLocation);
        }

        echo "<pre>";
        var_dump($uri, $path);
        echo "</pre>";
    }
}
