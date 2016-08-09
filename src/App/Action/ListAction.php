<?php


namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Diactoros\Response\HtmlResponse;

class ListAction
{
    private $adapter;
    private $template;

    public function __construct(TemplateRendererInterface $template, $adapter)
    {
        $this->adapter = $adapter;
        $this->template = $template;
    }


    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $statement = $this->adapter->query('select * from profile');
        $users = $statement->execute();

        return new HtmlResponse($this->template->render('app::list', ['users' => $users]));
    }
}