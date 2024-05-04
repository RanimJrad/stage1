<?php
include('config.php');

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$motDePasse = $_POST['motDePasse'];
$sexe = $_POST['sexe'];
$dateDeNaissance = $_POST['dateDeNaissance'];
$codePostal = $_POST['CodePostal'];
$adresse = $_POST['Adresse'];
$ville = $_POST['ville'];
$pays = $_POST['Pays'];


$insert_query = "INSERT INTO utilisateur (nom, prenom, rolee, telephone, email, motDePasse, sexe, dateDeNaissance, codePostal, ville,adresse, pays)
                                  VALUES ('$nom', '$prenom', 'user', '$telephone', '$email', '$motDePasse', '$sexe', '$dateDeNaissance', '$codePostal', '$ville','$adresse', '$pays')";

$stmt = $conn->prepare($insert_query);
if ($stmt === false) {
    die("Erreur de préparation de la requête : " . $conn->error);
}

if ($stmt->execute()) {

    header("Location: pages-login.html");
          
} else {
    $stmt->error;
}

?>