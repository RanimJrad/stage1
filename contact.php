<?php

include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $utilisateur_query = "SELECT idUtilisateur
    
    
     FROM utilisateur WHERE prenom= :prenom AND email= :email ";
    $result = $conn->prepare($utilisateur_query);
    $result->bindParam(':prenom', $prenom);
    $result->bindParam(':email', $email);
    $result->execute();

    if ($result->rowCount() > 0) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $idUtilisateur = $row['idUtilisateur'];

        $insert_query = "INSERT INTO contact (idUtilisateur, message)
                VALUES (:idUtilisateur, :message)";

        $stmt = $conn->prepare($insert_query);
        if ($stmt === false) {
            die("Erreur de préparation de la requête : " . $conn->error);
        }

        $stmt->bindParam(':idUtilisateur', $idUtilisateur);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            header("Location: index.html");
        } else {
            echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
        }
    } else {
        echo "message non trouvée.";
    }
} else {
    echo "Méthode non autorisée.";
}

?>