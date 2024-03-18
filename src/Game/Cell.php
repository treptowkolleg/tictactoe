<?php

namespace TreptowKolleg\Tictactoe\Game;

class Cell
{

    private Player $player;

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @param Player $player
     */
    public function setPlayer(Player $player): void
    {
        $this->player = $player;
    }

}