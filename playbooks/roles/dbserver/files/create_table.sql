CREATE DATABASE IF NOT EXISTS kasutajatugi;

USE kasutajatugi;

CREATE TABLE IF NOT EXISTS probleemid (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nimi VARCHAR(100) NOT NULL,
    osakond VARCHAR(100) NOT NULL,
    kontakt VARCHAR(100) NOT NULL,
    probleem TEXT NOT NULL,
    staatus ENUM('lahendamata', 'lahendatud') DEFAULT 'lahendamata',
    loodud TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

