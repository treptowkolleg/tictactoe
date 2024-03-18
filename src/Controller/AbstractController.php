<?php
namespace TreptowKolleg\Tictactoe\Controller;

use TreptowKolleg\Api\Session;
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

        //$link = $this->server->generateUrlFromString(GameController::class,'index');
        $this->view->addGlobal('game_link', '');
    }

    public function getView()
    {
        return $this->view;
    }
}

