CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom  VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL
);

CREATE TABLE matches (id_match INT AUTO_INCREMENT PRIMARY KEY,titre VARCHAR(150) NOT NULL,
equipe_home VARCHAR(100) NOT NULL,equipe_away VARCHAR(100) NOT NULL,date_match  DATETIME NOT NULL,
stade VARCHAR(150) NOT NULL,ville VARCHAR(100) NOT NULL
);

CREATE TABLE categories (id_categorie INT AUTO_INCREMENT PRIMARY KEY, id_match INT NOT NULL,
nom VARCHAR(50) NOT NULL, prix DECIMAL(10,2) NOT NULL, stock_max INT NOT NULL,
FOREIGN KEY (id_match) REFERENCES matches(id_match)
);

CREATE TABLE tickets (id_ticket INT AUTO_INCREMENT PRIMARY KEY, id_user INT NOT NULL, id_match INT NOT NULL,
id_categorie INT NOT NULL, quantite INT NOT NULL DEFAULT 1,prix_unitaire DECIMAL(10,2) NOT NULL,
date_achat DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (id_user) REFERENCES users(id_user),
FOREIGN KEY (id_match) REFERENCES matches(id_match),
FOREIGN KEY (id_categorie) REFERENCES categories(id_categorie)
);

CREATE TABLE comments (id_comment INT AUTO_INCREMENT PRIMARY KEY, id_user INT NOT NULL, id_match INT NOT NULL,
contenu TEXT NOT NULL, created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (id_user)  REFERENCES users(id_user),
FOREIGN KEY (id_match) REFERENCES matches(id_match)
);

--view
CREATE VIEW v_tickets_par_match AS SELECT m.id_match, m.titre, m.date_match, m.stade, m.ville,
COUNT(t.id_ticket) AS nb_commandes,COALESCE(SUM(t.quantite), 0) AS nb_places_vendues,
COALESCE(SUM(t.quantite * t.prix_unitaire),0) AS total_ventes FROM matches m
LEFT JOIN tickets t ON t.id_match = m.id_match
GROUP BY m.id_match, m.titre, m.date_match, m.stade, m.ville;
