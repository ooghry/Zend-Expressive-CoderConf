<?php


namespace App\Middleware;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class UnavailableMiddlewareFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new UnavailableMiddleware($container->get(TemplateRendererInterface::class));
    }
}