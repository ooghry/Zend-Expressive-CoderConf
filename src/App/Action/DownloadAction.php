<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DownloadAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $file='data'.$request->getUri()->getPath();
        if(is_readable($file)){
            return $response
                ->write(file_get_contents($file))
                ->withHeader('Content-Disposition','inline; filename="' . pathinfo($file,PATHINFO_BASENAME) . '"')
                ->withHeader('Content-type',pathinfo($file,PATHINFO_EXTENSION))
                ->withStatus(200);
        }else{
            return $next($request, $response);
        }
    }
}
