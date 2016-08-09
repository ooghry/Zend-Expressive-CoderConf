<?php


namespace App\Middleware;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Helper\UrlHelper;

class AuthMiddlewareFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $helper=new UrlHelper($container->get(RouterInterface::class));
        return new AuthMiddleware($helper);
    }
}