<?php

namespace App\Action;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ListActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $template = ($container->has(TemplateRendererInterface::class))
            ? $container->get(TemplateRendererInterface::class)
            : null;

        $adapter = ($container->has(AdapterInterface::class))
            ? $container->get(AdapterInterface::class)
            : null;

        return new ListAction($template,$adapter);
    }
}
