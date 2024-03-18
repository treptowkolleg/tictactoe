<?php

namespace TreptowKolleg\Tictactoe\Game;

class Row
{

    private array $cells = [];

    /**
     * @param Cell $cell
     */
    public function addCell(Cell $cell)
    {
        $this->cells[] = $cell;
    }

    /**
     * @return array
     */
    public function getCells(): array
    {
        return $this->cells;
    }

}
