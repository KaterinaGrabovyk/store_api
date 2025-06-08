<?php
namespace App;

use App\Exceptions\NoRouterException;

class App{
    private static Config $conf;
    public function __construct(protected Router $router,protected array $request)
    {
        static::$conf=new Config();
    }
    public static function db():Config{
        return static::$conf;
    }
     public function run(){
        try{
            $this->router->resolve($this->request['uri'],$this->request['method']);
        }catch(NoRouterException $e){
            http_response_code(404);
     }
    }
}