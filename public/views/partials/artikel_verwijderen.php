<?php
require_once __DIR__ . '/../../../src/Database.php';
$database = new Database();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form is submitted
    if (isset($_POST['delete'])) {
        // Get the article ID from the query parameters
        $artikel_nr = $_GET['id'];
        // Delete the article from the database
        $database->deleteArticle($artikel_nr);

        // Redirect to the articles page after deletion
        header('Location: /artikelen');
        exit();
    }
}

// Fetch the article details

// Get the article ID from the query parameters
$artikel_nr = $_GET['id'];

// Fetch the article from the database
$article = $database->getArticle($artikel_nr);

if (!$article) {
    // Redirect to error page or handle appropriately
    exit('Article not found');
}
?>

<div class="container mt-4">
    <h2>Artikel verwijderen</h2>
    <div class="alert alert-warning" role="alert">
        Weet je zeker dat je het artikel "<?php echo htmlspecialchars($article['Artikel_naam']); ?>" wilt verwijderen?
    </div>
    <form method="POST">
        <button type="submit" name="delete" class="btn btn-danger">Verwijderen</button>
        <a href="/artikelen" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
