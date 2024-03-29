cd C:\xampp\mysql\bin
mysql -u root -p

create database examfinals3;
use examfinals3;

CREATE TABLE 30h_admin (
    id_admin INT auto_increment PRIMARY KEY,
    nom_admin VARCHAR(40),
    mdp_admin VARCHAR(255)
);

CREATE TABLE 30h_the (
    id_the INT auto_increment PRIMARY KEY,
    nom_the VARCHAR(40),
    occupation FLOAT,
    rendement FLOAT,

    price DECIMAL(10,2)

);

CREATE TABLE 30h_parcelle (
    id_parcelle INT auto_increment PRIMARY KEY,
    surface FLOAT,
    id_the INT,
    FOREIGN KEY (id_the) REFERENCES 30h_the(id_the)
);

CREATE TABLE 30h_cueuilleur (
    id_cueuilleur INT auto_increment PRIMARY KEY,
    nom VARCHAR(40),
    genre VARCHAR(10),
    ddn DATE
);

CREATE TABLE 30h_categorie_depense (
    id_cat_dep INT auto_increment PRIMARY KEY,
    nom_cat_dep VARCHAR(40)
);

CREATE TABLE 30h_depense (
    id_depense INT auto_increment PRIMARY KEY,
    date DATE,
    id_cat INT,
    montant FLOAT,
    FOREIGN KEY (id_cat) REFERENCES 30h_categorie_depense(id_cat_dep)
);

CREATE TABLE 30h_montant_salaire (
    id_montant_salaire INT auto_increment PRIMARY KEY,
    poids FLOAT,
    montant FLOAT,
    date_montant DATE
);

CREATE TABLE 30h_user (
    id_user INT auto_increment PRIMARY KEY,
    nom_user VARCHAR(40),
    mdp_user VARCHAR(255)
);
insert into 30h_user values(default,'fits',sha1('123'));
insert into 30h_admin values(default,'fits',sha1('123'));

CREATE TABLE 30h_cueillette (
    id_cueillette INT auto_increment PRIMARY KEY,
    date DATE,
    id_cueuilleur INT,
    id_parcelle INT,
    poids FLOAT,
    FOREIGN KEY (id_cueuilleur) REFERENCES 30h_cueuilleur(id_cueuilleur),
    FOREIGN KEY (id_parcelle) REFERENCES 30h_parcelle(id_parcelle)
);

CREATE TABLE 30h_saison (
    id_saison INT auto_increment PRIMARY KEY,
    nom_saison VARCHAR(40),
    valide BOOLEAN
);

INSERT INTO 30h_saison (nom_saison, valide) VALUES 
('Janvier', FALSE),
('Février', FALSE),
('Mars', FALSE),
('Avril', FALSE),
('Mai', FALSE),
('Juin', FALSE),
('Juillet', FALSE),
('Août', FALSE),
('Septembre', FALSE),
('Octobre', FALSE),
('Novembre', FALSE),
('Décembre', FALSE);

CREATE TABLE 30h_salaire_cueilleur(
    id_salaire_cueilleur INT auto_increment PRIMARY KEY,
    minimum FLOAT,
    mallus FLOAT,
    bonus FLOAT,
    daty date
);