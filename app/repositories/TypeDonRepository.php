<?php
require_once __DIR__ . '/../models/TypeDon.php';

class TypeDonRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createTypeDon($nom, $id_categorie) {
        $st = $this->pdo->prepare("INSERT INTO bngrc_type_don (nom, id_categorie) VALUES (?, ?)");
        $st->execute([(string)$nom, (int)$id_categorie]);
        return $this->pdo->lastInsertId();
    }

    public function getAllTypes() {
        $st = $this->pdo->query("SELECT * FROM bngrc_type_don");
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        $types = [];
        foreach ($rows as $row) {
            $types[] = new TypeDon($row['id'], $row['nom'], $row['id_categorie']);
        }
        return $types;
    }

    public function getTypesByCategorie($id_categorie) {
        $st = $this->pdo->prepare("SELECT * FROM bngrc_type_don WHERE id_categorie = ?");
        $st->execute([(int)$id_categorie]);
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        $types = [];
        foreach ($rows as $row) {
            $types[] = new TypeDon($row['id'], $row['nom'], $row['id_categorie']);
        }
        return $types;
    }

    // Récupérer ou créer un type "Argent" par défaut pour la catégorie Argent
    public function getOrCreateTypeArgent($id_categorie_argent) {
        // Chercher si un type "Argent" existe déjà
        $st = $this->pdo->prepare("SELECT id FROM bngrc_type_don WHERE id_categorie = ? LIMIT 1");
        $st->execute([(int)$id_categorie_argent]);
        $row = $st->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return $row['id'];
        }
        
        // Sinon créer un type par défaut
        return $this->createTypeDon('Don en argent', $id_categorie_argent);
    }
}
