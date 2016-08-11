<?php


namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class UnavailableMiddleware
{
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        if (date('G') == '23' || (date('G') == '0' && date('i') < '30')) {
            return new HtmlResponse($this->template->render('app::unavailable'));
        }
        $response = $next($request, $response);
        return $response;
    }

}