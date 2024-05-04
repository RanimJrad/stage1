use AutoShop;

create table utilisateur(
    idUtilisateur int AUTO_INCREMENT primary key ,
    nom varchar(30) ,
    prenom varchar(30),
    rolee varchar(30),
    telephone int ,
    email varchar(50),
    motDePasse varchar(30),
    sexe varchar(30),
    dateDeNaissance Date,
    codePostal int , 
    ville varchar(50),
    adresse varchar(100),
    pays varchar(50)
);

create table categorie (
    codeCategorie int primary key ,
    nomCategorie varchar(50),
    familleCat varchar(50)
);

create table piece (
    idPiece int AUTO_INCREMENT primary key,
    nomPiece varchar(40),
    refPiece int ,
    marquePiece varchar(40),
    quantite int ,
    marqueVoiture varchar(50),
    modeleVoiture varchar(50),
    prix float(8,2),
    description varchar(500),
    image varchar(500),
    codeCategorie int,
     FOREIGN KEY (codeCategorie) REFERENCES categorie(codeCategorie)

);

create table commande (
    refCommande int primary key ,
    etatCommande varchar(50),
    dateLiv date ,
    idUtilisateur int,
    idPiece int,
    FOREIGN KEY (idUtilisateur) REFERENCES utilisateur(idUtilisateur),
     FOREIGN KEY (idPiece) REFERENCES piece(idPiece)
);

create table panier (
    idPanier int AUTO_INCREMENT primary key ,
    idpiece int ,
    FOREIGN KEY (idPiece) REFERENCES piece(idPiece)
);

create table paiement (
    idpaiement int AUTO_INCREMENT primary key,
    totale float(8,2),
    fraisDeLiv float(8,2),
    idPiece int ,
    FOREIGN KEY (idPiece) REFERENCES piece(idPiece)
);

create table contact(
    idContact int AUTO_INCREMENT primary key , 
    idUtilisateur int ,
    FOREIGN KEY (idUtilisateur) REFERENCES utilisateur(idUtilisateur),
    message varchar(500)
);

