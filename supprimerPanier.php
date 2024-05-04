<?php

include('config.php');


    $id = $_POST['id'];
    $DelSql = "DELETE FROM panier WHERE id = :id";

    $stmt = $conn->prepare($DelSql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header("Location: ajouterPanier.php");
        exit();
    } else {
        echo "Failed to delete";
    }



?>