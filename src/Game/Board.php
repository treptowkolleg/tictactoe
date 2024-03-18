<?php

namespace TreptowKolleg\Tictactoe\Game;

class Board
{

    private array $rows = [];

    /**
     * @param int $rows
     * @param int $columns
     */
    public function __construct(int $rows = 3, int $columns = 3)
    {
        for ($y = 1; $y <= $rows; $y++) {
            $row = new Row();
            for ($x = 1; $x <= $columns; $x++) {
                $row->addCell(new Cell());
            }
            $this->rows[] = $row;
        }
    }

    /**
     * @return array
     */
    public function getRows(): array
    {
        return $this->rows;
    }

}
