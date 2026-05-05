-- ========================================================
-- Script de création de la base de données
-- Basé sur le diagramme de classes fourni
-- ========================================================
-- Supprimer les tables si elles existent (pour éviter les conflits)
DROP TABLE IF EXISTS Notification;
DROP TABLE IF EXISTS Facture;
DROP TABLE IF EXISTS Panier_Produit;
DROP TABLE IF EXISTS Commande_Produit;
DROP TABLE IF EXISTS Panier;
DROP TABLE IF EXISTS Commande;
DROP TABLE IF EXISTS Produit;
DROP TABLE IF EXISTS Fournisseur;
DROP TABLE IF EXISTS Client;

-- ========================================================
-- Table: Client
-- ========================================================
CREATE TABLE Client (
    idClient INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    motDePasse VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'client',
    adresse TEXT
);

-- ========================================================
-- Table: Fournisseur
-- ========================================================
CREATE TABLE Fournisseur (
    idFournisseur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    motDePasse VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'fournisseur'
);

-- ========================================================
-- Table: Produit
-- ========================================================
CREATE TABLE Produit (
    idProduit INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    fournisseur_id INT NULL,
    FOREIGN KEY (fournisseur_id) REFERENCES Fournisseur(idFournisseur) ON DELETE SET NULL
);

-- ========================================================
-- Table: Commande
-- ========================================================
CREATE TABLE Commande (
    idCommande INT PRIMARY KEY AUTO_INCREMENT,
    dateCommande DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut VARCHAR(50) DEFAULT 'en attente',
    total DECIMAL(10, 2) DEFAULT 0.00,
    client_id INT NOT NULL,
    FOREIGN KEY (client_id) REFERENCES Client(idClient) ON DELETE CASCADE
);

-- ========================================================
-- Table de liaison: Commande_Produit
-- ========================================================
CREATE TABLE Commande_Produit (
    id INT PRIMARY KEY AUTO_INCREMENT,
    commande_id INT NOT NULL,
    produit_id INT NOT NULL,
    quantite INT NOT NULL DEFAULT 1,
    prix_unitaire DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (commande_id) REFERENCES Commande(idCommande) ON DELETE CASCADE,
    FOREIGN KEY (produit_id) REFERENCES Produit(idProduit) ON DELETE CASCADE
);

-- ========================================================
-- Table: Panier
-- ========================================================
CREATE TABLE Panier (
    idPanier INT PRIMARY KEY AUTO_INCREMENT,
    total DECIMAL(10, 2) DEFAULT 0.00,
    client_id INT UNIQUE NOT NULL,
    FOREIGN KEY (client_id) REFERENCES Client(idClient) ON DELETE CASCADE
);

-- ========================================================
-- Table de liaison: Panier_Produit
-- ========================================================
CREATE TABLE Panier_Produit (
    id INT PRIMARY KEY AUTO_INCREMENT,
    panier_id INT NOT NULL,
    produit_id INT NOT NULL,
    quantite INT NOT NULL DEFAULT 1,
    FOREIGN KEY (panier_id) REFERENCES Panier(idPanier) ON DELETE CASCADE,
    FOREIGN KEY (produit_id) REFERENCES Produit(idProduit) ON DELETE CASCADE
);

-- ========================================================
-- Table: Facture
-- ========================================================
CREATE TABLE Facture (
    idFacture INT PRIMARY KEY AUTO_INCREMENT,
    dateFacture DATETIME DEFAULT CURRENT_TIMESTAMP,
    montant DECIMAL(10, 2) NOT NULL,
    commande_id INT UNIQUE NOT NULL,
    FOREIGN KEY (commande_id) REFERENCES Commande(idCommande) ON DELETE CASCADE
);

-- ========================================================
-- Table: Notification
-- ========================================================
CREATE TABLE Notification (
    id INT PRIMARY KEY AUTO_INCREMENT,
    message TEXT NOT NULL,
    date_envoi DATETIME DEFAULT CURRENT_TIMESTAMP,
    lu BOOLEAN DEFAULT FALSE,
    client_id INT NULL,
    fournisseur_id INT NULL,
    FOREIGN KEY (client_id) REFERENCES Client(idClient) ON DELETE CASCADE,
    FOREIGN KEY (fournisseur_id) REFERENCES Fournisseur(idFournisseur) ON DELETE CASCADE,
    CONSTRAINT chk_notification_recipient CHECK (
        (client_id IS NOT NULL AND fournisseur_id IS NULL) OR
        (client_id IS NULL AND fournisseur_id IS NOT NULL)
    )
);

-- ========================================================
-- Insertion de quelques données de test (optionnel)
-- ========================================================

-- Clients
INSERT INTO Client (nom, email, motDePasse, adresse) VALUES
('Jean Dupont', 'jean.dupont@email.com', 'password123', '12 rue de Paris, 75001 Paris'),
('Marie Martin', 'marie.martin@email.com', 'securepass', '8 avenue des Fleurs, 69002 Lyon');

-- Fournisseurs
INSERT INTO Fournisseur (nom, email, motDePasse) VALUES
('Fournitures Pro', 'contact@fourniturespro.com', 'fournisseur123'),
('Electro Distribution', 'ventes@electrodistrib.com', 'electro456');

-- Produits
INSERT INTO Produit (nom, prix, fournisseur_id) VALUES
('Ordinateur Portable', 899.99, 2),
('Souris sans fil', 29.99, 2),
('Chaise de bureau', 199.99, 1),
('Cahier A4', 3.99, 1);

-- Commandes
INSERT INTO Commande (client_id, statut, total) VALUES
(1, 'livrée', 929.98),
(2, 'en préparation', 203.98);

-- Détails des commandes
INSERT INTO Commande_Produit (commande_id, produit_id, quantite, prix_unitaire) VALUES
(1, 1, 1, 899.99),
(1, 2, 1, 29.99),
(2, 3, 1, 199.99),
(2, 4, 1, 3.99);

-- Paniers
INSERT INTO Panier (client_id, total) VALUES
(1, 0.00),
(2, 0.00);

-- Factures
INSERT INTO Facture (commande_id, montant) VALUES
(1, 929.98),
(2, 203.98);

-- Notifications
INSERT INTO Notification (message, client_id) VALUES
('Votre commande #1 a été livrée', 1),
('Votre commande #2 est en cours de préparation', 2),
('Nouveau produit disponible : Tablette Graphique', 2);

-- ========================================================
-- Fin du script
-- ========================================================
