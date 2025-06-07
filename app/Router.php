<?php
namespace App;

use App\Exceptions\NoRouterException;

class Router{
    private array $routes;

    public function get(string $route, callable|array $action){
        return $this->register('GET',$route,$action);
    }
    public function post(string $route, callable|array $action){
        return $this->register('POST',$route,$action);
    }
    private function register(string $method, string $route, callable|array $action):self{
        $this->routes[$method][$route]=$action;
        return $this;
    }
    public function resolve(string $reqURI,string $reqMethod){
        $route=explode('?',$reqURI)[0];
        $action=$this->routes[$reqMethod][$route] ?? null;
        if(! $action){
            throw new NoRouterException();
        }
        if(is_callable($action)){
            call_user_func($action);
        }
        if(is_array($action)){
            [$class,$method,$variable]=$action;
            if(class_exists($class)){
                $class=new $class($variable);
            }
            if(method_exists($class,$method)){
                return call_user_func_array([$class,$method],[]);
            }
        }

    }
}