<?php
declare(strict_types=1);
namespace App;

use App\Exceptions\NoRouterException;

class Router{
    private array $routes;
    //* HTTP - Methods
    public function get(string $route, callable|array $action){
        return $this->register('GET',$route,$action);
    }
    public function post(string $route, callable|array $action ){
        return $this->register('POST',$route,$action);
    }
    public function put(string $route, callable|array $action ){
        return $this->register('PUT',$route,$action);
    }
    public function patch(string $route, callable|array $action ){
        return $this->register('PATCH',$route,$action);
    }
    public function delete(string $route, callable|array $action ){
        return $this->register('DELETE',$route,$action);
    }
    //* Routes handler
    private function register(string $method, string $route, callable|array $action):self{
        $this->routes[$method][$route]=$action;
        return $this;
    }
    public function resolve(string $reqURI, string $reqMethod) {
    
        $route = explode('?', $reqURI)[0];
        $routes = $this->routes[$reqMethod] ?? [];
        foreach ($routes as $routePattern => $action) {
            $pattern = preg_replace('#\{:[^}]+\}#', '([^/]+)', $routePattern);
            $pattern = "#^" . $pattern . "$#";
            if (preg_match($pattern, $route, $params)) {
                array_shift($params); 
                 if (! $action) {
                throw new NoRouterException();
                }
                if (is_callable($action)) {
                    return call_user_func_array($action, $params);
                }
                if (is_array($action)) {
                    [$class, $method] = $action;
                    if (class_exists($class)) {
                        $class = new $class();
                        return $class->callMethod($method, $params);
                    }
                }
            }
        }
        throw new NoRouterException();
    }

}