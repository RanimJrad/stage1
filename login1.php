<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST['prenom'];
    $motDePasse = $_POST['motDePasse'];

    // Utilisation de requête préparée avec PDO
    $stmt = $conn->prepare('SELECT * FROM utilisateur WHERE prenom = :prenom AND motDePasse = :motDePasse');
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':motDePasse', $motDePasse, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['idU'] = $row['idU'];
        $_SESSION['rolee'] = $row['rolee'];

        if ($row['rolee'] == 'Admin') {
            header("Location: /autoshop/ecommerce/Admin/index.html");
        } else {
            header("Location: /autoshop/ecommerce/index.html");
        }
    } else {
        $error = "Invalid username or password!";
    }
}
?>
