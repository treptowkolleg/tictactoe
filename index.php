<?php
use TreptowKolleg\Tictactoe\Bootstrap;

const PROJECT_DIR = __DIR__ . DIRECTORY_SEPARATOR;

require PROJECT_DIR . 'vendor/autoload.php';

$app = new Bootstrap();
$app->init();