<?php

namespace app\core;

class Router
{
    protected array $routes;
    protected Server $server;

    public function __construct(Server $server) 
    {
        $this->server = $server;
    }

    public function setRoute(string $url, string $callback) 
    {
        $this->routes[$url] = $callback;
        // echo "Router : {$url} is set to call function: {$callback} </br>";
    }

    public function getRoutes()
    {
        return $this->routes;
    }

        public function run()
        {
            $path = $this->server->getPath();

            $callback = $this->routes[$path] ?? false;

            if ($callback === false) 
            {
                return "404 Page Not Found";
            }
            if (is_string($callback)) 
            {
                return $this->renderView($callback);
            }

            // return $callback;
        }

        protected function renderView(string $contentFileName) 
        {
            $layoutString = $this->renderLayout("default");
            $contentString = $this->renderContent($contentFileName);
        
            return str_replace("{{content}}", $contentString, $layoutString);
        }

        protected function renderContent(string $contentFileName)
        {
            ob_start();
            include_once __DIR__."/../views/content/{$contentFileName}.php";
            return ob_get_clean();
        }

        protected function renderLayout(string $layoutFileName) 
        {
            ob_start();
            include_once __DIR__."/../views/layout/{$layoutFileName}.php";
            return ob_get_clean();
        }
    
}
