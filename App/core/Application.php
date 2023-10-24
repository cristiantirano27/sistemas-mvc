<?php

namespace app\core;

class Application
{
    protected Router $router;
    protected Server $server;

    public function __construct() 
    {
        $this->server = new Server();
        $this->router = new Router($this->server);
    }

    public function setRoute(string $url, string $callback) 
    {
        $this->router->setRoute($url, $callback);
    }

    public function run()
    {
        return $this->router->run();    
    }

}
