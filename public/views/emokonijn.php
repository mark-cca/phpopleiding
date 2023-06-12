<?php

include __DIR__ . '/../../src/emokonijn/EmoKonijn.php';
include __DIR__ . '/../../src/emokonijn/EmoKonijnGenerator.php';
include __DIR__ . '/../../src/emokonijn/EmoKonijnMatcher.php';
include __DIR__ . '/../../src/emokonijn/ScoreManager.php';

$konijnGenerator = new EmoKonijnGenerator();
$konijnMatcher = new EmoKonijnMatcher();
$scoreManager = new ScoreManager();

$row1 = [];
$row2 = [];

for ($i = 0; $i < 15; $i++) {
    $row1[] = $konijnGenerator->generateRandomEmoKonijn();
    $row2[] = $konijnGenerator->generateRandomEmoKonijn();
}

$matches = $konijnMatcher->match($row1, $row2);

$score = count($matches);
$scoreManager->updateScore($score);

echo '<div class="d-flex">';
foreach ($row1 as $index => $konijn) {
    echo '<div class="emo-konijn-col m-1"><pre class="font-monospace">' . $konijn->toAsciiArt() . '</pre></div>';
}
echo '</div>';

echo '<div class="d-flex">';
foreach ($row2 as $index => $konijn) {
    $matchClass = in_array($index, $matches) ? 'bg-success-light' : 'bg-danger-light';
    echo '<div class="emo-konijn-col m-1 ' . $matchClass . '"><pre class="font-monospace">' . $konijn->toAsciiArt() . '</pre></div>';
}
echo '</div>';

$highScore = $scoreManager->getHighScore();
$scoresOccurrences = $scoreManager->getScoresOccurrences();

echo '<div>Huidige Score: ' . $score . '</div>';
echo '<div>Highscore: ' . $highScore . '</div>';

echo '<div class="row">';
echo '<div class="col">';
echo '<table class="table">';
echo '<thead><tr><th>Hoe vaak komen scores voor?</th></tr></thead>';
echo '<tbody>';
for ($i = 0; $i <= 15; $i++) {
    echo '<tr>';
    echo '<td>Score ' . $i . ' komt ' . $scoresOccurrences[$i] . ' keer voor</td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
echo '</div>';
echo '</div>';