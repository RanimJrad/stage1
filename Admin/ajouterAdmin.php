<?php

include('config.php');

// Assuming form data is sent using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];
    $sexe = $_POST['sexe'];
    $dateDeNaissance = $_POST['dateDeNaissance'];
    $codePostal = $_POST['codePostal'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];

    
    

    // Use prepared statement to insert data
    $insert_query = "INSERT INTO utilisateur (nom, prenom, rolee, telephone, email, motDePasse, sexe, dateDeNaissance, codePostal, ville, adresse, pays)
                    VALUES (:nom, :prenom, 'Admin', :telephone, :email, :motDePasse, :sexe, :dateDeNaissance, :codePostal, :ville, :adresse, :pays )";

    $stmt = $conn->prepare($insert_query);

    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':telephone', $telephone, PDO::PARAM_INT);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':motDePasse', $motDePasse, PDO::PARAM_STR);
    $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
    $stmt->bindParam(':dateDeNaissance', $dateDeNaissance, PDO::PARAM_STR);
    $stmt->bindParam(':codePostal', $codePostal, PDO::PARAM_INT);
    $stmt->bindParam(':ville', $ville, PDO::PARAM_STR);
    $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $stmt->bindParam(':pays', $pays, PDO::PARAM_STR);

    if ($stmt->execute()) {
        header("Location: index.html");
        exit();
    } else {
        die("Error executing the statement: " . $stmt->errorInfo()[2]);
    }
} else {
    die("Invalid request method.");
}

?>
