<?php

class Database
{
    private $host = "localhost";
    private $username = "opleiding";
    private $password = "opleiding";
    private $database = "opleiding";
    private $connection;

    /**
     * Database constructor.
     * Maakt een nieuwe databaseverbinding.
     */
    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Verbinding mislukt: " . $e->getMessage());
        }
    }

    /**
     * Maakt een tabel in de database als deze nog niet bestaat.
     */
    public function createTable()
    {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS articles (
            Artikel_nr INT(11) AUTO_INCREMENT PRIMARY KEY,
            Artikel_naam VARCHAR(40),
            Prijs DECIMAL(10,2)
        )";
            $rowCount = $this->connection->exec($sql);

            if ($rowCount === false) {
                echo '<div class="alert alert-warning" role="alert">Tabelcreatie mislukt.</div>';
            } elseif ($rowCount === 0) {
                echo '<div class="alert alert-warning" role="alert">Tabel bestaat al.</div>';
            } else {
                echo '<div class="alert alert-success" role="alert">Tabel succesvol aangemaakt.</div>';
            }
        } catch (PDOException $e) {
            echo '<div class="alert alert-warning" role="alert">Tabelcreatie mislukt: ' . $e->getMessage() . '</div>';
        }
    }

    /**
     * Haalt alle artikelen op uit de database.
     *
     * @return array|false De opgehaalde artikelen of false als het ophalen mislukt.
     */
    public function getArticles()
    {
        try {
            $sql = "SELECT * FROM articles";
            $stmt = $this->connection->query($sql);
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $articles;
        } catch (PDOException $e) {
            echo "Fout bij ophalen van artikelen: " . $e->getMessage();
        }
    }

    /**
     * Voegt een nieuw artikel toe aan de database.
     *
     * @param string $artikel_naam De naam van het artikel.
     * @param float $prijs De prijs van het artikel.
     */
    public function createArticle($artikel_naam, $prijs)
    {
        // Valideer de invoer
        if (empty($artikel_naam)) {
            echo '<div class="alert alert-danger" role="alert">Artikelnaam is verplicht.</div>';
            return;
        }

        if (!is_numeric($prijs)) {
            echo '<div class="alert alert-danger" role="alert">Ongeldige prijs.</div>';
            return;
        }

        try {
            $sql = "INSERT INTO articles (Artikel_naam, Prijs) VALUES (?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$artikel_naam, $prijs]);
            echo '<div class="alert alert-success" role="alert">Artikel succesvol toegevoegd.</div>';
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger" role="alert">Fout bij het toevoegen van het artikel: ' . $e->getMessage() . '</div>';
        }
    }

    /**
     * Haalt een specifiek artikel op uit de database op basis van het artikelnummer.
     *
     * @param int $artikel_nr Het artikelnummer van het artikel.
     * @return array|false Het opgehaalde artikel of false als het artikel niet gevonden is.
     */
    public function getArticle($artikel_nr)
    {
        try {
            $sql = "SELECT * FROM articles WHERE Artikel_nr = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$artikel_nr]);
            $article = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($article) {
                return $article;
            } else {
                echo "Artikel niet gevonden.";
            }
        } catch (PDOException $e) {
            echo "Fout bij ophalen van artikel: " . $e->getMessage();
        }
    }

    /**
     * Werkt een artikel bij in de database op basis van het artikelnummer.
     *
     * @param int $artikel_nr Het artikelnummer van het artikel.
     * @param string $artikel_naam De nieuwe naam van het artikel.
     * @param float $prijs De nieuwe prijs van het artikel.
     */
    public function updateArticle($artikel_nr, $artikel_naam, $prijs)
    {
        // Valideer de invoer
        if (empty($artikel_naam)) {
            echo '<div class="alert alert-danger" role="alert">Artikelnaam is verplicht.</div>';
            return;
        }

        if (!is_numeric($prijs)) {
            echo '<div class="alert alert-danger" role="alert">Ongeldige prijs.</div>';
            return;
        }

        try {
            $sql = "UPDATE articles SET Artikel_naam = ?, Prijs = ? WHERE Artikel_nr = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$artikel_naam, $prijs, $artikel_nr]);
            echo '<div class="alert alert-success" role="alert">Artikel succesvol bewerkt.</div>';
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger" role="alert">Fout bij het bewerken van het artikel: ' . $e->getMessage() . '</div>';
        }
    }

    /**
     * Verwijdert een artikel uit de database op basis van het artikelnummer.
     *
     * @param int $artikel_nr Het artikelnummer van het artikel.
     */
    public function deleteArticle($artikel_nr)
    {
        try {
            $sql = "DELETE FROM articles WHERE Artikel_nr = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$artikel_nr]);
            echo "Artikel succesvol verwijderd.";
        } catch (PDOException $e) {
            echo "Verwijderen van artikel mislukt: " . $e->getMessage();
        }
    }
}
