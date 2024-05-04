<?php

include('config.php');

// Récupérer les informations nécessaires à partir du formulaire de commande
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$adresse = $_POST['adresse'];
$pays = $_POST['pays'];
$ville = $_POST['ville'];
$codePostal = $_POST['codePostal'];
$modePaiement = $_POST['modePaiement'];
$nomCarte = $_POST['nomCarte'];
$numeroCarte = $_POST['numCarte'];
$codeCarte = $_POST['codeCarte'];

// Récupérer les informations du panier
$select_query = "SELECT nomPiece, quantite, total FROM panier";
$stmt = $conn->prepare($select_query);
$stmt->execute();
$panierItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculer le total final et récupérer les noms des produits et leurs quantités
$totalFinal = 0;
$produitsQuantites = "";
foreach ($panierItems as $item) {
    $totalFinal += $item['total'];
    // Ajouter le nom du produit et sa quantité à la chaîne des produits et quantités
    $produitsQuantites .= $item['nomPiece'] . " (Quantité: " . $item['quantite'] . "), ";
}

// Supprimer la virgule en trop à la fin de la chaîne des produits et quantités
$produitsQuantites = rtrim($produitsQuantites, ", ");

// Insérer les informations dans la table de commande
$insert_query = "INSERT INTO commande (nomC, prenomC, emailC, telephone, adresse, pays, ville, codePostal, modePaiement, nomCarte, numeroCarte, codeCarte, produitsQuantites, totalFinal) 
        VALUES (:nom, :prenom, :email, :telephone, :adresse, :pays, :ville, :codePostal, :modePaiement, :nomCarte, :numeroCarte, :codeCarte, :produitsQuantites, :totalFinal)";
$stmt = $conn->prepare($insert_query);

$stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
$stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':telephone', $telephone, PDO::PARAM_INT);
$stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
$stmt->bindParam(':pays', $pays, PDO::PARAM_STR);
$stmt->bindParam(':ville', $ville, PDO::PARAM_STR);
$stmt->bindParam(':codePostal', $codePostal, PDO::PARAM_INT);
$stmt->bindParam(':modePaiement', $modePaiement, PDO::PARAM_STR);
$stmt->bindParam(':nomCarte', $nomCarte, PDO::PARAM_STR);
$stmt->bindParam(':numeroCarte', $numeroCarte, PDO::PARAM_STR);
$stmt->bindParam(':codeCarte', $codeCarte, PDO::PARAM_STR);
$stmt->bindParam(':produitsQuantites', $produitsQuantites, PDO::PARAM_STR);
$stmt->bindParam(':totalFinal', $totalFinal, PDO::PARAM_INT);

if ($stmt->execute()) {

    header("Location: index.html");
    exit();
} else {
    die("Error executing the statement: " . $stmt->error);
}
?>
