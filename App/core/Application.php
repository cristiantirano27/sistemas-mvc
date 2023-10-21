<?php

namespace app\core;

class Application
{
    protected Router $router;

    public function __construct() 
    {
        $this->router = new Router();
    }

    public function setRoute(string $url, string $callback) 
    {
        $this->router->setRoute($url, $callback);
    }

    public function run()
    {
        return $this->router->getPath();    
    }

}
