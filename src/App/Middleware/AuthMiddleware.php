<?php


namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Helper\UrlHelper;

class AuthMiddleware
{
    private $helper;

    public function __construct(UrlHelper $helper)
    {
        $this->helper=$helper;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        if($this->helper->generate('api.ping')!=$request->getUri()->getPath()) {
            $auth = $this->parseAuth($request->getHeaderLine('Authorization'));
            if (!$auth or !$this->checkUserPass($auth['user'], $auth['pass'])) {
                return $response
                    ->withHeader('WWW-Authenticate', 'Basic realm=""')
                    ->withStatus(401);
            }
        }
        $response = $next($request, $response);
        return $response;
    }

    private function parseAuth($header)
    {
        if (strpos($header, 'Basic') !== 0) {
            return false;
        }
        $header = explode(':', base64_decode(substr($header, 6)));
        return [
            'user' => $header[0],
            'pass' => isset($header[1]) ?? $header[1],
        ];
    }

    private function checkUserPass($user,$pass)
    {
        return ($user=='myuser' and $pass=='mypass');
    }
}