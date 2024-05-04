<?php

include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomPiece = $_POST['nomPiece'];
    $marquePiece = $_POST['marquePiece'];
    $refPiece = $_POST['refPiece'];
    $quantite = $_POST['quantite'];
    $marqueVoiture = $_POST['marque'];
    $modeleVoiture = $_POST['modele'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imagePath = 'autoshop/ecommerce/images/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        die("Error uploading image.");
    }

    $categorie = $_POST['categorie'];
    $categorie_query = "SELECT codeCategorie FROM categorie WHERE nomCategorie = :categorie";
    $result = $conn->prepare($categorie_query);
    $result->bindParam(':categorie', $categorie);
    $result->execute();

    if ($result->rowCount() > 0) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $codeCategorie = $row['codeCategorie'];

        $insert_query = "INSERT INTO piece (nomPiece, refPiece, marquePiece, quantite, marqueVoiture, modeleVoiture, prix, description,  image , codeCategorie)
                        VALUES (:nomPiece, :refPiece, :marquePiece, :quantite, :marqueVoiture, :modeleVoiture, :prix, :description, :image, :codeCategorie)";

        $stmt = $conn->prepare($insert_query);
        if ($stmt === false) {
            die("Erreur de préparation de la requête : " . $conn->error);
        }

        
        $stmt->bindParam(':nomPiece', $nomPiece);
        $stmt->bindParam(':refPiece', $refPiece);
        $stmt->bindParam(':marquePiece', $marquePiece);
        $stmt->bindParam(':quantite', $quantite);
        $stmt->bindParam(':marqueVoiture', $marqueVoiture);
        $stmt->bindParam(':modeleVoiture', $modeleVoiture);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $imagePath);
        $stmt->bindParam(':codeCategorie', $codeCategorie);

        if ($stmt->execute()) {
            header("Location: index.html");
        } else {
            echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
        }
    } else {
        echo "Catégorie non trouvée.";
    }
} else {
    echo "Méthode non autorisée.";
}

?>
