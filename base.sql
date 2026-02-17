-- 1️⃣ Créer la base et l'utiliser
CREATE DATABASE IF NOT EXISTS bngrc;
USE bngrc;

-- 2️⃣ Créer les tables (Structure Finale sans ALTER)

CREATE TABLE bngrc_region (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

CREATE TABLE bngrc_ville (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    id_region INT NOT NULL,
    FOREIGN KEY (id_region) REFERENCES bngrc_region(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE bngrc_categorie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

CREATE TABLE bngrc_type_don (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    id_categorie INT NOT NULL,
    FOREIGN KEY (id_categorie) REFERENCES bngrc_categorie(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE bngrc_besoin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_ville INT NOT NULL,
    id_type_don INT NOT NULL,
    quantite INT DEFAULT NULL, -- Modifié directement ici
    prix_unitaire DECIMAL(10,2) DEFAULT NULL, -- Modifié directement ici
    montant DECIMAL(12,2) DEFAULT NULL, -- Ajouté directement ici
    date_saisie DATE NOT NULL,
    FOREIGN KEY (id_ville) REFERENCES bngrc_ville(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_type_don) REFERENCES bngrc_type_don(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE bngrc_don (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_type_don INT NOT NULL,
    quantite INT DEFAULT NULL, -- Modifié directement ici
    montant DECIMAL(12,2) DEFAULT NULL, -- Ajouté directement ici
    montant_restant DECIMAL(12,2) DEFAULT NULL, -- Ajouté directement ici
    date_saisie DATE NOT NULL,
    FOREIGN KEY (id_type_don) REFERENCES bngrc_type_don(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE bngrc_dispatch (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_don INT NOT NULL,
    id_ville INT NOT NULL,
    quantite_attribuee INT NOT NULL,
    date_dispatch DATE NOT NULL,
    FOREIGN KEY (id_don) REFERENCES bngrc_don(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_ville) REFERENCES bngrc_ville(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE bngrc_achat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_ville INT NOT NULL,
    id_type_don INT NOT NULL,
    quantite_achetee INT NOT NULL,
    prix_unitaire DECIMAL(10,2) NOT NULL,
    frais_pourcentage DECIMAL(5,2) NOT NULL,
    montant_total DECIMAL(12,2) NOT NULL,
    date_achat DATE NOT NULL,
    FOREIGN KEY (id_ville) REFERENCES bngrc_ville(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_type_don) REFERENCES bngrc_type_don(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE bngrc_config (
    id INT AUTO_INCREMENT PRIMARY KEY,
    frais_pourcentage DECIMAL(5,2) NOT NULL
);

-- 3️⃣ Insérer les données (Ordre logique : Catégories -> Régions -> Villes -> Types)

INSERT INTO bngrc_config (frais_pourcentage) VALUES (10.00);

INSERT INTO bngrc_region (id, nom) VALUES
(1, 'Atsinanana'),
(2, 'Vatovavy'),
(3, 'Fitovinany'),
(4, 'Diana'),
(5, 'Menabe');

-- Villes
INSERT INTO bngrc_ville (id, nom, id_region) VALUES
(1, 'Toamasina', 1),
(2, 'Mananjary', 2),
(3, 'Farafangana', 3),
(4, 'Nosy Be', 4),
(5, 'Morondava', 5);

-- Categories
INSERT INTO bngrc_categorie (id, nom) VALUES
(1, 'nature'),
(2, 'materiel'),
(3, 'argent');

-- Types de don
INSERT INTO bngrc_type_don (id, nom, id_categorie) VALUES
(1, 'Riz (kg)', 1),
(2, 'Eau (L)', 1),
(3, 'Huile (L)', 1),
(4, 'Haricots', 1),
(5, 'Tôle', 2),
(6, 'Bâche', 2),
(7, 'Clous (kg)', 2),
(8, 'Bois', 2),
(9, 'groupe', 2),
(10, 'Argent', 3);

-- Besoins (ordre = id)
INSERT INTO bngrc_besoin
(id, id_ville, id_type_don, quantite, prix_unitaire, montant, date_saisie)
VALUES
(17, 1, 1, 800, 3000, 2400000, '2026-02-16'),
(4, 1, 2, 1500, 1000, 1500000, '2026-02-15'),
(23, 1, 5, 120, 25000, 3000000, '2026-02-16'),
(1, 1, 6, 200, 15000, 3000000, '2026-02-15'),
(12, 1, 10, 12000000, 1, 12000000, '2026-02-16'),

(9, 2, 1, 500, 3000, 1500000, '2026-02-15'),
(25, 2, 3, 120, 6000, 720000, '2026-02-16'),
(6, 2, 5, 80, 25000, 2000000, '2026-02-15'),
(19, 2, 7, 60, 8000, 480000, '2026-02-16'),
(3, 2, 10, 6000000, 1, 6000000, '2026-02-15'),

(21, 3, 1, 600, 3000, 1800000, '2026-02-16'),
(14, 3, 2, 1000, 1000, 1000000, '2026-02-15'),
(8, 3, 6, 150, 15000, 2250000, '2026-02-16'),
(26, 3, 8, 100, 10000, 1000000, '2026-02-15'),
(10, 3, 10, 8000000, 1, 8000000, '2026-02-16'),

(5, 4, 1, 300, 3000, 900000, '2026-02-15'),
(18, 4, 4, 200, 4000, 800000, '2026-02-16'),
(2, 4, 5, 40, 25000, 1000000, '2026-02-15'),
(24, 4, 7, 30, 8000, 240000, '2026-02-16'),
(7, 4, 10, 4000000, 1, 4000000, '2026-02-15'),

(11, 5, 1, 700, 3000, 2100000, '2026-02-16'),
(20, 5, 2, 1200, 1000, 1200000, '2026-02-15'),
(15, 5, 6, 180, 15000, 2700000, '2026-02-16'),
(22, 5, 8, 150, 10000, 1500000, '2026-02-15'),
(13, 5, 10, 10000000, 1, 10000000, '2026-02-16'),

(16, 1, 9, 3, 6750000, 20250000, '2026-02-15');
