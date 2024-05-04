<?php

include('config.php');


    $idPiece = $_GET['idPiece'];
    $DelSql = "DELETE FROM piece WHERE idPiece = :idPiece";

    $stmt = $conn->prepare($DelSql);
    $stmt->bindParam(':idPiece', $idPiece, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header("Location: listeProduit.php");
    } else {
        echo "Failed to delete";
    }



?>