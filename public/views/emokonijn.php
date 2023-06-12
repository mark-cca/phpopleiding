<?php

require_once __DIR__ . '/../../src/BMICalculator.php';

$length = $_POST['length'] ?? null;
$weight = $_POST['weight'] ?? null;
$status = '';
$bmi = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (is_numeric($length) && is_numeric($weight)) {
        $calculator = new BMICalculator($length, $weight);
        $bmi = $calculator->calculate();
        $status = $calculator->getStatus();
    } else {
        $status = 'Voer geldige getallen in voor lengte en gewicht.';
    }
}
?>

<form method="post" action="/bmi">
    <label for="length">Lengte (in meters):</label><br>
    <input type="text" id="length" name="length" value="<?= htmlspecialchars($length) ?>"><br>
    <label for="weight">Gewicht (in kg):</label><br>
    <input type="text" id="weight" name="weight" value="<?= htmlspecialchars($weight) ?>"><br>
    <input type="submit" value="Bereken BMI">
</form>

<?php
if ($bmi && $status) {
    echo "Uw BMI is " . $bmi . ", " . $status;
}
?>
