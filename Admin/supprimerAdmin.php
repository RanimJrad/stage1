<?php

include('config.php');


    $idUtilisateur = $_GET['idUtilisateur'];
    $DelSql = "DELETE FROM utilisateur WHERE idUtilisateur= :idUtilisateur";

    $stmt = $conn->prepare($DelSql);
    $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header("Location: listeAdmin.php");
    } else {
        echo "Failed to delete";
    }



?>