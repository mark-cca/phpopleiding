<?php
class EmoKonijnMatcher {
    /**
     * Zoek overeenkomende emoties tussen twee rijen EmoKonijn-objecten.
     *
     * @param EmoKonijn[] $row1 De eerste rij van EmoKonijn-objecten.
     * @param EmoKonijn[] $row2 De tweede rij van EmoKonijn-objecten.
     *
     * @return int[] Een array met de indexen van de overeenkomende emoties.
     */
    public function match($row1, $row2) {
        $matches = [];
        for ($i = 0; $i < count($row1); $i++) {
            if ($row1[$i]->getEmotie() === $row2[$i]->getEmotie()) {
                $matches[] = $i;
            }
        }
        return $matches;
    }
}

