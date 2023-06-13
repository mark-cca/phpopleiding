<?php
require_once __DIR__ . '/../../src/Database.php';
$database = new Database();

// Maak de tabel als deze nog niet bestaat
$database->createTable();

$articles = $database->getArticles();

?>

<div class="container mt-4">
    <h2>Artikelbeheer</h2>
    <a href="/toevoegen/" class="btn btn-primary my-3">Nieuw artikel toevoegen</a>
    <table class="table">
        <thead>
        <tr>
            <th>Artikelnummer</th>
            <th>Artikelnaam</th>
            <th>Prijs</th>
            <th>Acties</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($articles as $article) : ?>
            <tr>
                <td><?php echo $article['Artikel_nr']; ?></td>
                <td><?php echo $article['Artikel_naam']; ?></td>
                <td><?php echo $article['Prijs']; ?></td>
                <td>
                    <a href="/bewerken/?id=<?php echo $article['Artikel_nr']; ?>" class="btn btn-primary btn-sm">Bewerken</a>
                    <a href="/verwijderen/?id=<?php echo $article['Artikel_nr']; ?>" class="btn btn-danger btn-sm">Verwijderen</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
