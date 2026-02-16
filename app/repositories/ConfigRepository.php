<?php
require_once __DIR__ . '/../models/Config.php';

class ConfigRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getFraisPourcentage() {
        $st = $this->pdo->query("SELECT frais_pourcentage FROM bngrc_config LIMIT 1");
        return (float)$st->fetchColumn();
    }

    public function updateFrais($nouveau_frais) {
        $st = $this->pdo->prepare("
            UPDATE bngrc_config
            SET frais_pourcentage = ?
            WHERE id = 1
        ");
        $st->execute([(float)$nouveau_frais]);
    }
}
