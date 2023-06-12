<?php
class EmoKonijnGenerator {
    private $emoties = ["^_^", "-_-", "o_o", "O_O", "T_T", ";_;", ">_<", ">:)", "<3_<3", "^_^"];

    /**
     * Genereer een willekeurig EmoKonijn-object.
     *
     * @return EmoKonijn Het gegenereerde EmoKonijn-object.
     */
    public function generateRandomEmoKonijn() {
        $randomEmotieIndex = array_rand($this->emoties);
        return new EmoKonijn($this->emoties[$randomEmotieIndex]);
    }
}

