DROP DATABASE IF EXISTS asteroidMiningDB;

SET SQL_MODE = 'TRADITIONAL';

-- Adatbázis létrehozása
CREATE DATABASE asteroidMiningDB
    CHARACTER SET utf8
    COLLATE utf8_hungarian_ci;

-- Set default database
USE asteroidMiningDB;

DROP TABLE IF EXISTS mining_corporations;
-- 'mining_corporations' tábla létrehozása
CREATE TABLE mining_corporations (
    _id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    headquarters VARCHAR(100),
    founded YEAR
)
ENGINE = INNODB;

DROP TABLE IF EXISTS asteroids;
-- 'asteroids' tábla létrehozása (1:N kapcsolat a mining_corporations táblával)
CREATE TABLE asteroids (
    _id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    corporation_id INT NOT NULL,
    discovered_date DATE,
    mineral_content TEXT,
    FOREIGN KEY (corporation_id) REFERENCES mining_corporations(_id) ON DELETE RESTRICT
)
ENGINE = INNODB;

DROP TABLE IF EXISTS operation_leaders;
-- 'operation_leaders' tábla létrehozása (1:1 kapcsolat az asteroids táblával)
CREATE TABLE operation_leaders (
    asteroid_id INT PRIMARY KEY,
    leader_name VARCHAR(100),
    experience_years INT,
    FOREIGN KEY (asteroid_id) REFERENCES asteroids(_id) ON DELETE RESTRICT
)
ENGINE = INNODB;

-- Adatok beszúrása a 'mining_corporations' táblába
INSERT INTO mining_corporations (_id, name, headquarters, founded) VALUES
    (1, 'AstroMiner Corp', 'Lunar Base Alpha', 2075),
    (2, 'Deep Space Extractors', 'Mars Colony', 2090),
    (3, 'NeoResources Ltd', 'Europa Orbital Station', 2085),
    (4, 'Cosmic Drillers', 'Titan Outpost', 2102),
    (5, 'Galactic Mining Inc', 'Earth Orbit HQ', 2050);

-- Adatok beszúrása az 'asteroids' táblába (legalább 20 aszteroida)
INSERT INTO asteroids (_id, name, corporation_id, discovered_date, mineral_content) VALUES
    (1, 'Eros 433', 1, '2080-05-14', 'Nickel, Iron, Cobalt'),
    (2, 'Pallas 2', 2, '2092-11-30', 'Platinum, Gold'),
    (3, 'Vesta 4', 3, '2088-07-22', 'Titanium, Silicon'),
    (4, 'Psyche 16', 4, '2105-03-10', 'Iron, Nickel, Rare Earth Metals'),
    (5, 'Ceres 1', 5, '2078-09-05', 'Water Ice, Ammonia'),
    (6, 'Bennu 101955', 1, '2081-12-25', 'Carbonaceous Minerals'),
    (7, 'Ryugu 162173', 2, '2095-04-14', 'Hydrated Silicates'),
    (8, 'Hygiea 10', 3, '2099-06-18', 'Organic Compounds'),
    (9, 'Davida 511', 4, '2103-01-07', 'Nickel, Chromium'),
    (10, 'Interamnia 704', 5, '2065-02-20', 'Iron, Water Ice'),
    (11, 'Icarus 1566', 1, '2084-08-01', 'Silicon, Magnesium'),
    (12, 'Euphrosyne 31', 2, '2098-03-15', 'Platinum, Titanium'),
    (13, 'Hebe 6', 3, '2093-10-11', 'Nickel, Water'),
    (14, 'Parthenope 11', 4, '2100-12-08', 'Cobalt, Silver'),
    (15, 'Metis 9', 5, '2071-07-21', 'Zinc, Lead'),
    (16, 'Psyche 16-B', 1, '2106-09-30', 'Gold, Uranium'),
    (17, 'Juno 3', 2, '2087-02-17', 'Carbonaceous Material'),
    (18, 'Amor 1221', 3, '2096-05-04', 'Nickel, Palladium'),
    (19, 'Hathor 2340', 4, '2091-06-25', 'Silicon, Cobalt'),
    (20, 'Apollo 1862', 5, '2060-01-13', 'Iron, Magnesium');

-- Adatok beszúrása az 'operation_leaders' táblába
INSERT INTO operation_leaders (asteroid_id, leader_name, experience_years) VALUES
    (1, 'Dr. Alex Carter', 12),
    (2, 'Commander Hiro Tanaka', 18),
    (3, 'Dr. Maria Velasquez', 15),
    (4, 'Colonel Ivan Petrov', 20),
    (5, 'Chief Engineer Zhang Wei', 10),
    (6, 'Dr. Samantha Hughes', 14),
    (7, 'Captain Lars Bjorn', 16),
    (8, 'Dr. Nadia Kovalenko', 13),
    (9, 'Major Tom Sinclair', 17),
    (10, 'Chief Miner Diego Martinez', 12),
    (11, 'Dr. Helena Rousseau', 11),
    (12, 'Commander Felix Novak', 19),
    (13, 'Dr. Li Wei', 14),
    (14, 'Major Yusuf Khan', 10),
    (15, 'Dr. Emily Hartman', 12),
    (16, 'Captain Oliver Drake', 16),
    (17, 'Chief Technician Aria Malik', 13),
    (18, 'Colonel Sebastian Holt', 18),
    (19, 'Commander Ethan Sawyer', 15),
    (20, 'Dr. Aisha Rahman', 20);

-- Idegen kulcs hozzáadása az 'corporation_id' mezőhöz
ALTER TABLE asteroids
ADD CONSTRAINT fk_corporation FOREIGN KEY (corporation_id) REFERENCES mining_corporations(_id);
