<?php
namespace TreptowKolleg\Tictactoe\Controller;

class DefaultController extends AbstractController
{

    // Symbol für Spieler 1
    private const PLAYER_1 = 'circle';

    // Symbol für Spieler 2
    private const PLAYER_2 = 'x-lg';

    public function index()
    {
        // Links für Reset und Spielen generieren
        $resetLink = $this->server->generateUrlFromString(DefaultController::class, 'reset');
        $playLink = $this->server->generateUrlFromString(DefaultController::class, 'play');

        // Falls Spieler noch nicht festgelegt wurde, Spieler 1 festlegen
        if (! $this->session->get('player'))
            $this->session->set('player', self::PLAYER_1);

        // Spielfeld ausgeben
        return $this->getView()->render('default/index.html.twig', [
            'reset' => $resetLink,
            'play' => $playLink,
            'current_player' => $this->session->get('player'),
            'filled_fields' => $this->session->get('fields'),
            'session' => $_SESSION
        ]);
    }

    public function reset()
    {
        // Spiel zurücksetzen und zur Methode zum Anzeigen des Spielfeldes weiterleiten
        $this->session->destroy($this->server->generateUrlFromString(DefaultController::class, 'index'));
    }

    public function play()
    {
        // Feld eintragen
        if (array_key_exists('field', $_GET)) {
            $field = $_GET['field'];
            if ($this->session->get('player') == self::PLAYER_1) {
                $this->session->set('fields', self::PLAYER_1, $field);
            } else {
                $this->session->set('fields', self::PLAYER_2, $field);
            }
        }

        // Spieler wechseln
        if ($this->session->get('player') == self::PLAYER_1) {
            $this->session->set('player', self::PLAYER_2);
        } else {
            $this->session->set('player', self::PLAYER_1);
        }

        // Zur Methode zum Anzeigen des Spielfeldes weiterleiten
        $redirectUrl = $this->server->generateUrlFromString(DefaultController::class, 'index');
        header("Location: $redirectUrl", true, 302);
        exit();
    }
}

