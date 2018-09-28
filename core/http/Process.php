<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2018/8/29
 * Time: 14:00
 */

namespace M\http;


use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Response;

class Process {
    private static $incs;
    public static $request;
    public static $uri;
    public static $response;
    public static $router;

    public static function init($incs){
        self::$incs=$incs;
        self::$request = ServerRequest::fromGlobals();
        self::$response = new Response();
        self::$uri = self::$request->getUri();


        /*获取项目路由配置*/
        if(file_exists(APP_ROOT.'/router/http.php')){
            require APP_ROOT.'/router/http.php';
        }

        // map a route
        Router::default(self::$request);

        $response = Router::dispatch(self::$request);

        foreach ($response->getHeaders() as $header => $value) {
            header($header,$value);
        }

        echo $response->getBody();
    }


}