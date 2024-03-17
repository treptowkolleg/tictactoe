<?php
namespace TreptowKolleg\Tictactoe;

use TreptowKolleg\Tictactoe\Controller\AbstractController;

class Bootstrap
{

    const DEFAULT_CONTROLLER = 'default';

    const DEFAULT_METHOD = 'index';

    private AbstractController $controllerClass;

    public function init()
    {
        $controller = $_GET['controller'] ?? self::DEFAULT_CONTROLLER;
        $method = $_GET['action'] ?? self::DEFAULT_METHOD;
        $this->getClass($controller);
        $this->runMethod($method);
    }

    protected function getClass($controller): Bootstrap
    {
        $controllerClass = "TreptowKolleg\\Tictactoe\\Controller\\" . ucfirst($controller) . "Controller";

        if (! class_exists($controllerClass))
            die("Controller {$controllerClass} existiert nicht!");
        $this->controller = new $controllerClass();

        return $this;
    }

    protected function runMethod($method): void
    {
        if (! method_exists($this->controller, $method))
            die("Methode {$method} existiert nicht!");

        echo $this->controller->$method();
    }
}

