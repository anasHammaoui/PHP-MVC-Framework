<?php
namespace app\core;
class Router{
    private $routes = [
        "GET" => [],
        "POST" => []
    ];
    public function __construct(){

    }
    public function add($method,$url,$controller){
        $method = strtoupper($method);
        $route = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)',$url);
        $this -> routes[$method][$url] = $controller;

    }
    public function dispatch($uri,$method){
        $path = parse_url($uri,PHP_URL_PATH);
        foreach ($this -> routes[$method] as $url => $callback){
            if (preg_match('#^' . $url . '$#', $uri, $matches)){
                array_shift($matches);
                if (is_array($callback)){
                    $controller = new $callback[0]();
                    $meth = $callback[1];
                    return call_user_func([$controller,$meth],$matches);
                }
            }
            
        }
        http_response_code(404);
        echo "error 404 page not found";;
        return;
    }
    public function getRoutes(){
        echo "salam cv";
    }
}