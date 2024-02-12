cd C:\xampp\mysql\bin
mysql -u root -p

create database examfinals3;
use examfinals3;

CREATE TABLE admin (
    id_admin INT auto_increment PRIMARY KEY,
    nom_admin VARCHAR(40),
    mdp_admin VARCHAR(255)
);

CREATE TABLE the (
    id_the INT auto_increment PRIMARY KEY,
    nom_the VARCHAR(40),
    occupation VARCHAR(255),
    rendement FLOAT
);

CREATE TABLE parcelle (
    id_parcelle INT auto_increment PRIMARY KEY,
    surface FLOAT,
    id_the INT,
    FOREIGN KEY (id_the) REFERENCES the(id_the)
);

CREATE TABLE cueuilleur (
    id_cueuilleur INT auto_increment PRIMARY KEY,
    nom VARCHAR(40),
    genre VARCHAR(10),
    ddn DATE
);

CREATE TABLE categorie_depense (
    id_cat_dep INT auto_increment PRIMARY KEY,
    nom_cat_dep VARCHAR(40)
);

CREATE TABLE depense (
    id_depense INT auto_increment PRIMARY KEY,
    date DATE,
    id_cat INT,
    montant FLOAT,
    FOREIGN KEY (id_cat) REFERENCES categorie_depense(id_cat_dep)
);

CREATE TABLE montant_salaire (
    id_montant_salaire INT auto_increment PRIMARY KEY,
    poid FLOAT,
    montant FLOAT
);

CREATE TABLE user (
    id_user INT auto_increment PRIMARY KEY,
    nom_user VARCHAR(40),
    mdp_user VARCHAR(255)
);

CREATE TABLE cueillette (
    id_cueillette INT auto_increment PRIMARY KEY,
    date DATE,
    id_cueuilleur INT,
    id_parcelle INT,
    poids FLOAT,
    FOREIGN KEY (id_cueuilleur) REFERENCES cueuilleur(id_cueuilleur),
    FOREIGN KEY (id_parcelle) REFERENCES parcelle(id_parcelle)
);