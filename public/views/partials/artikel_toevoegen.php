<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Controleren of het formulier is verzonden
    if (isset($_POST['submit'])) {
        // Formuliergegevens ophalen
        $artikel_naam = $_POST['artikel_naam'];
        $prijs = $_POST['prijs'];

        require_once __DIR__ . '/../../../src/Database.php';

        $database = new Database();

        // Artikel toevoegen aan de database
        $database->createArticle($artikel_naam, $prijs);

        // Verberg het formulier na succesvolle indiening
        $showForm = false;

        echo '<a href="/artikelen" class="btn btn-secondary">Terug naar artikelen</a>';

        // Stop met het uitvoeren van de rest van de code
        exit();
    }
}
?>

<div class="container mt-4">
    <h2>Artikel toevoegen</h2>
    <?php if ($showForm ?? true) : ?>
        <form method="POST">
            <?php if (!isset($showForm) || $showForm) : ?>
                <div class="form-group">
                    <label for="artikel_naam">Artikelnaam</label>
                    <input type="text" class="form-control" id="artikel_naam" name="artikel_naam" required>
                </div>
                <div class="form-group">
                    <label for="prijs">Prijs</label>
                    <input type="number" step="0.01" class="form-control" id="prijs" name="prijs" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Artikel toevoegen</button>
            <?php endif; ?>
        </form>
    <?php else : ?>
        <a href="/artikelen" class="btn btn-secondary">Terug naar artikelen</a>
    <?php endif; ?>
</div>
