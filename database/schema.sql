
CREATE TABLE  users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('client', 'livreur', 'admin') NOT NULL DEFAULT 'client',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT ;


CREATE TABLE  commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    livreur_id INT NULL, 
    description TEXT NOT NULL,
    adresse_livraison VARCHAR(255) NOT NULL,
    statut ENUM('en_attente', 'acceptee', 'livree', 'terminee') NOT NULL DEFAULT 'en_attente',
    prix_final DECIMAL(10,2) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (livreur_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB ;


CREATE TABLE  offres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT NOT NULL,
    livreur_id INT NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    duree INT NOT NULL COMMENT 'Duration in minutes',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (commande_id) REFERENCES commandes(id) ON DELETE CASCADE,
    FOREIGN KEY (livreur_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_offre (commande_id, livreur_id) 
) ENGINE=InnoDB ;


-- INSERT INTO users (name, email, password, role) VALUES
-- ('Admin', 'admin@delivry.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin')
-- ON DUPLICATE KEY UPDATE email=email;

