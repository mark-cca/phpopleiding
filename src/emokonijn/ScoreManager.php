<?php

class ScoreManager {
    private $highScore;
    private $scoresOccurrences;
    private $highScoreBestand;

    /**
     * ScoreManager constructor.
     */
    public function __construct() {
        $this->highScoreBestand = __DIR__ . '/../../data/highscore.txt';
        $this->loadHighScore();
        $this->loadScoresOccurrences();
    }

    /**
     * Laad de hoogste score uit het bestand.
     */
    private function loadHighScore() {
        $this->highScore = 0;
        if (file_exists($this->highScoreBestand)) {
            $this->highScore = intval(file_get_contents($this->highScoreBestand));
        }
    }

    /**
     * Laad de scores voorkomens uit aparte tekstbestanden.
     */
    private function loadScoresOccurrences() {
        $this->scoresOccurrences = [];
        for ($i = 0; $i <= 15; $i++) {
            $scoreFile = __DIR__ . '/../../data/score_' . $i . '.txt';
            if (file_exists($scoreFile)) {
                $scoreOccurrences = intval(file_get_contents($scoreFile));
                $this->scoresOccurrences[$i] = $scoreOccurrences;
            } else {
                $this->scoresOccurrences[$i] = 0;
            }
        }
    }

    /**
     * Update de score en sla de hoogste score en scores voorkomens op.
     *
     * @param int $score De nieuwe score.
     */
    public function updateScore($score) {
        $this->updateHighScore($score);
        $this->updateScoresOccurrences($score);
        $this->saveHighScore();
        $this->saveScoresOccurrences();
    }

    /**
     * Update de hoogste score als de nieuwe score hoger is.
     *
     * @param int $score De nieuwe score.
     */
    private function updateHighScore($score) {
        if ($score > $this->highScore) {
            $this->highScore = $score;
        }
    }

    /**
     * Update de scores voorkomens voor de nieuwe score.
     *
     * @param int $score De nieuwe score.
     */
    private function updateScoresOccurrences($score) {
        $this->scoresOccurrences[$score]++;
    }

    /**
     * Sla de hoogste score op in het bestand.
     */
    private function saveHighScore() {
        file_put_contents($this->highScoreBestand, $this->highScore);
    }

    /**
     * Sla de scores voorkomens op in aparte tekstbestanden.
     */
    private function saveScoresOccurrences() {
        for ($i = 0; $i <= 15; $i++) {
            $scoreFile = __DIR__ . '/../../data/score_' . $i . '.txt';
            file_put_contents($scoreFile, $this->scoresOccurrences[$i]);
        }
    }

    /**
     * Haal de hoogste score op.
     *
     * @return int De hoogste score.
     */
    public function getHighScore() {
        return $this->highScore;
    }

    /**
     * Haal de scores voorkomens op.
     *
     * @return array De scores voorkomens.
     */
    public function getScoresOccurrences() {
        return $this->scoresOccurrences;
    }
}