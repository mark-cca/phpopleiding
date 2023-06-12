<?php
class EmoKonijn {
    private $emotie;

    /**
     * EmoKonijn constructor.
     *
     * @param string $emotie De emotie van het konijn.
     */
    public function __construct($emotie) {
        $this->emotie = $emotie;
    }

    /**
     * Genereer de ASCII-kunstweergave van het konijn.
     *
     * @return string De ASCII-kunstweergave.
     */
    public function toAsciiArt() {
        $ears = "(\_/)";
        $face = "<span class='konijn-face'>(".$this->emotie.")</span>";
        $body = "(' ')";
        return $ears . "\n" . $face . "\n" . $body;
    }

    /**
     * Haal de emotie van het konijn op.
     *
     * @return string De emotie van het konijn.
     */
    public function getEmotie() {
        return $this->emotie;
    }
}

