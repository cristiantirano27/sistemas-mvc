<?php
namespace app\core;

class Server
{
    public function __construct() {
        
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

        return $path;
    }
}

