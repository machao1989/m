<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2018/9/3
 * Time: 15:32
 */

namespace M\http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router {

    private static $rules;
    private static $routers;
    private $path;
    private $middleware;

    private static function controllerHandle(){
        $Uri = Process::$request->getUri();
        $method = Process::$request->getMethod();
        $path = $Uri->getPath();
        $controllerName =  ($ctmp = str_replace('/','\\',$path))=='\\'?'\\'.config('defaultController'):$ctmp;
        if(class_exists($ctrl = APP_SPACE.'\\controller'.$controllerName.'Controller')){
            //restful
            return [$ctrl,$method];
        }else{
            print_r(new $ctrl) ;
            $subPath = substr($controllerName,0,strrpos($controllerName,'\\'));
            $ctrlMethod = substr($controllerName,strrpos($controllerName,'\\'));
            if(class_exists($ctrl = APP_SPACE.'\\controller'.$subPath) ){
                return [$ctrl,$ctrlMethod];
            }else{
                return false;
            }
        }
    }

    public static function default(){
        $path = Process::$uri->getPath();
    }

    public static function controll(ServerRequestInterface $request) : ResponseInterface{
        list($controller,$method) = self::restful();
        $result = (new $controller($request,Process::$response))->$method();
        Process::$response->getBody()->write($result);
        return Process::$response;
    }

    public static function group($path){
        self::$rules[]=$path;
        $router = new self($path);
        self::$routers[$path]=$router;
        return $router;
    }

    public static function dispatch(RequestInterface $request){
        /*匹配分派*/
        $Uri = Process::$request->getUri();
        $path = $Uri->getPath();
        $matchedMiddleware=[];
        foreach (self::$rules as $rule) {
            if(strpos($path,$rule)===0){
                $router=self::$routers[$rule];
                $matchedMiddleware = array_merge($matchedMiddleware,$router->middleware);
            }
        }

        /*执行中间件*/
        foreach ($matchedMiddleware as &$middleware) {
            $middleware = new $middleware();
        }

        if($ctrlMethod = self::controllerHandle()){
            $httpMessageHandle = (new $ctrlMethod[0](Process::$request,Process::$response));
        }

        foreach ($httpMessageHandle as $v) {
            $v->process();
        }

        $matchedMiddlewares = array_reverse($matchedMiddleware);
        $handle=null;
        foreach ($matchedMiddlewares as $k=>$matchedMiddleware) {
            if($k==0){
                $handle = $httpMessageHandle;
            }else{
                $handle = new $matchedMiddleware(Process::$request,$handle);
            }
            $matchedMiddleware->process(Process::$request,$handle);
        }

    }

    public function __construct($path){
        $this->path = $path;
    }

    /**
     * 为当前规则添加中间件
     * @param $className
     * @return $this
     */
    public function middleware($className){
        $this->middleware[]=$className;
        return $this;
    }
}