-- 1️⃣ Créer la base et l'utiliser
DROP DATABASE IF EXISTS bngrc;
CREATE DATABASE IF NOT EXISTS bngrc;
USE bngrc;

-- 2️⃣ Créer les tables

CREATE TABLE bngrc_region (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

CREATE TABLE bngrc_ville (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    id_region INT NOT NULL,
    FOREIGN KEY (id_region) REFERENCES bngrc_region(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE bngrc_categorie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

CREATE TABLE bngrc_type_don (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    id_categorie INT NOT NULL,
    FOREIGN KEY (id_categorie) REFERENCES bngrc_categorie(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE bngrc_besoin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_ville INT NOT NULL,
    id_type_don INT NOT NULL,
    quantite INT NOT NULL,
    prix_unitaire DECIMAL(10,2),
    date_saisie DATE NOT NULL,
    FOREIGN KEY (id_ville) REFERENCES bngrc_ville(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_type_don) REFERENCES bngrc_type_don(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE bngrc_don (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_type_don INT NOT NULL,
    quantite INT NOT NULL,
    date_saisie DATE NOT NULL,
    FOREIGN KEY (id_type_don) REFERENCES bngrc_type_don(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE bngrc_dispatch (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_don INT NOT NULL,
    id_ville INT NOT NULL,
    quantite_attribuee INT NOT NULL,
    date_dispatch DATE NOT NULL,
    FOREIGN KEY (id_don) REFERENCES bngrc_don(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_ville) REFERENCES bngrc_ville(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- 3️⃣ Insérer des données test

INSERT INTO bngrc_region (nom) VALUES 
('Analamanga'),
('Atsinanana'),
('Bongolava');

INSERT INTO bngrc_ville (nom, id_region) VALUES
('Antananarivo', 1),
('Toamasina', 2),
('Bongolava Ville', 3);

INSERT INTO bngrc_categorie (nom) VALUES
('Nature'),
('Materiaux'),
('Argent');

INSERT INTO bngrc_type_don (nom, id_categorie) VALUES
('Riz', 1),
('Pâtes', 1),
('Paracétamol', 2),
('Masques', 2);

INSERT INTO bngrc_besoin (id_ville, id_type_don, quantite, prix_unitaire, date_saisie) VALUES
(1, 1, 100, 2.50, '2026-02-16'),
(2, 3, 50, 1.20, '2026-02-16'),
(3, 4, 30, 5.00, '2026-02-16');

INSERT INTO bngrc_don (id_type_don, quantite, date_saisie) VALUES
(1, 50, '2026-02-16'),
(3, 20, '2026-02-16'),
(4, 10, '2026-02-16');

INSERT INTO bngrc_dispatch (id_don, id_ville, quantite_attribuee, date_dispatch) VALUES
(1, 1, 30, '2026-02-16'),
(2, 2, 10, '2026-02-16'),
(3, 3, 5, '2026-02-16');
