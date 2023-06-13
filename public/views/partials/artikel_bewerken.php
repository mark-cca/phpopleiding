<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Controleren of het formulier is verzonden
    if (isset($_POST['submit'])) {
        // Formuliergegevens ophalen
        $artikel_naam = $_POST['artikel_naam'];
        $prijs = $_POST['prijs'];

        require_once __DIR__ . '/../../../src/Database.php';

        $database = new Database();

        // Artikel-ID ophalen uit de queryparameters
        $artikel_nr = $_GET['id'];

        // Artikel bijwerken in de database
        $database->updateArticle($artikel_nr, $artikel_naam, $prijs);

        // Verberg het formulier na succesvolle indiening
        $showForm = false;

        echo '<a href="/artikelen" class="btn btn-secondary">Terug naar artikelen</a>';

        // Stop met het uitvoeren van de rest van de code
        exit();
    }
}

// Oorspronkelijke artikelgegevens ophalen
if (!isset($artikel_naam) || !isset($prijs)) {
    require_once __DIR__ . '/../../../src/Database.php';

    $database = new Database();

    // Artikel-ID ophalen uit de queryparameters
    $artikel_nr = $_GET['id'];

    // Artikel ophalen uit de database
    $article = $database->getArticle($artikel_nr);

    if ($article) {
        $artikel_naam = $article['Artikel_naam'];
        $prijs = $article['Prijs'];
    } else {
        // Redirect naar foutpagina of op passende wijze afhandelen
        exit('Artikel niet gevonden');
    }
}
?>

<div class="container mt-4">
    <h2>Artikel bewerken</h2>
    <?php if ($showForm ?? true) : ?>
        <form method="POST">
            <?php if (!isset($showForm) || $showForm) : ?>
                <div class="form-group">
                    <label for="artikel_naam">Artikelnaam</label>
                    <input type="text" class="form-control" id="artikel_naam" name="artikel_naam" value="<?php echo htmlspecialchars($artikel_naam); ?>" required>
                </div>
                <div class="form-group">
                    <label for="prijs">Prijs</label>
                    <input type="number" step="0.01" class="form-control" id="prijs" name="prijs" value="<?php echo htmlspecialchars($prijs); ?>" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Artikel bijwerken</button>
            <?php endif; ?>
        </form>
    <?php else : ?>
        <a href="/artikelen" class="btn btn-secondary">Terug naar artikelen</a>
    <?php endif; ?>

</div>
