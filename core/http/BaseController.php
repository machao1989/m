<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2018/9/3
 * Time: 15:13
 */

namespace M\http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

abstract class BaseController implements RequestHandlerInterface{

    public $requst;
    public $response;

    /**
     * HttpMessage依赖注入
     * BaseController constructor.
     * @param ServerRequestInterface $requst
     * @param $response
     */
    public function __construct(ServerRequestInterface $requst,ResponseInterface $response){
        $this->requst = $requst;
        $this->response = $response;

        if(method_exists($this,'_construct')){
            $this->_construct();
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    final public function handle(ServerRequestInterface $request): ResponseInterface{

    }
}