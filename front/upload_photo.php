<?php
session_start();
require_once 'config.php'; // fichier avec ta connexion PDO ($pdo)

if (!isset($_SESSION['utilisateur_id'])) {
    exit('Non connecté');
}
$id = $_SESSION['utilisateur_id'];


if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
    $id = $_SESSION['utilisateur_id'];

    $tmp_name = $_FILES['photo']['tmp_name'];

    // Lire le fichier en binaire
    $imageData = file_get_contents($tmp_name);

    // Sauvegarder dans la base
    $sql = "UPDATE utilisateur SET photo = ? WHERE utilisateur_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $imageData, PDO::PARAM_LOB);
    $stmt->bindParam(2, $id, PDO::PARAM_INT);
    $stmt->execute();

    echo "Photo enregistrée avec succès.";
} else {
    echo "Erreur : aucune photo envoyée.";
}
