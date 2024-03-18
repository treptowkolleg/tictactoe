<?php

namespace TreptowKolleg\Tictactoe\Controller;

class GameController extends AbstractController
{

    public function index(): string
    {
        return $this->getView()->render('game/index.html.twig', [
        ]);
    }

    public function play()
    {

    }

    public function reset()
    {

    }

}

