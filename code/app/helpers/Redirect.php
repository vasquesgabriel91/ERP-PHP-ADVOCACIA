<?php

namespace App\Core\Helpers;
use App\Core\Router;

class Redirect{

    private Router $router;
    
    public function __construct(Router $router) {
        $this->router = $router;
    }
    public function toRoute(string $name) {
        $url = $this->router->route($name);
        header("Location: $url");
        exit(); 
    }
}