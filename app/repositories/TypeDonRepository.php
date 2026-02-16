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
}
