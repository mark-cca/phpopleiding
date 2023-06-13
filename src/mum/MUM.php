<?php

include __DIR__ . '/html.php';

/**
 * De MUM (Most Useless Machine) klasse.
 */
class MUM {
    private $html;
    private $states = [
        'start' => 'begin',
        'begin' => 'open',
        'open' => 'close',
        'close' => 'start',
    ];

    /**
     * Constructor voor de MUM klasse.
     * Start de sessie en initialiseert de machine in zijn starttoestand als deze nog niet is ingesteld.
     * Maakt ook een nieuw HTML object aan.
     */
    public function __construct() {
        // Start de sessie.
        session_start();

        // Initialiseer de machine in zijn starttoestand als deze nog niet is ingesteld.
        if (!isset($_SESSION['state'])) {
            $_SESSION['state'] = 'start';
        }

        // Verwerk POST verzoeken.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['action'] === 'start') {
                $_SESSION['state'] = $this->states[$_SESSION['state']];
            }
        }

        // Maak een nieuw HTML object aan.
        $this->html = new HTML();
    }

    /**
     * Toont de huidige pagina op basis van de huidige toestand van de machine.
     */
    public function toon() {
        // Gebruik het HTML object om de juiste pagina weer te geven op basis van de huidige toestand van de machine.
        $this->html->toon($_SESSION['state']);

        // Maak de overgang naar de volgende pagina, maar alleen als de huidige toestand niet 'start' is.
        if ($_SESSION['state'] !== 'start') {
            $_SESSION['state'] = $this->states[$_SESSION['state']];
        }
    }
}