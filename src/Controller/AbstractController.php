<?php
namespace TreptowKolleg\Tictactoe\Controller;

use TreptowKolleg\Api\Session;
use TreptowKolleg\Tictactoe\Extension\LinkExtension;
use TreptowKolleg\Tictactoe\Server\Response;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{

    private Environment $view;

    protected Response $server;

    protected Session $session;

    public function __construct()
    {
        $this->session = new Session();
        $loader = new FilesystemLoader(PROJECT_DIR . 'templates');
        $this->view = new Environment($loader, [
            'cache' => PROJECT_DIR . 'var/cache',
            'debug' => true
        ]);
        $this->view->addExtension(new DebugExtension());
        $this->server = new Response();
        $this->view->addGlobal('root', $this->server->generateLink(''));
        $this->view->addExtension(new LinkExtension());
    }

    public function getView(): Environment
    {
        return $this->view;
    }
}

