<?php

namespace Core;

class Router{
    protected $routes=[];

    public function add($method, $uri, $controller){
        $this->routes[]=[
            'uri'=>$uri,
            'controller'=>$controller,
            'method'=>$method
        ];
        return $this;
    }

    public function get($uri, $controller){
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller){
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller){
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller){
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller){
    }

    public function route($uri, $method){
        foreach($this->routes as $route){
            if($route['uri']===$uri && $route['method']===strtoupper($method)){
                return require base_path('controllers/'.$route['controller']);
            }
        }
    }
}