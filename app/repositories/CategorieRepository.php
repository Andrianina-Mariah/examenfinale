<?php
require_once __DIR__ . '/../models/Categorie.php';

class CategorieRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createCategorie($nom) {
        $st = $this->pdo->prepare("INSERT INTO bngrc_categorie (nom) VALUES (?)");
        $st->execute([(string)$nom]);
        return $this->pdo->lastInsertId();
    }

    public function getAllCategories() {
        $st = $this->pdo->query("SELECT * FROM bngrc_categorie");
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        $categories = [];
        foreach ($rows as $row) {
            $categories[] = new Categorie($row['id'], $row['nom']);
        }
        return $categories;
    }
}
