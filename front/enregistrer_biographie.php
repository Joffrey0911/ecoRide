<?php
session_start();


// Lecture brut du JSON reçu
$inputJSON = file_get_contents('php://input');
$data = json_decode($inputJSON, true);



if (isset($data['biographie']) && isset($_SESSION['utilisateur_id'])) {
    $biographie = trim($data['biographie']);
    $user_id = $_SESSION['utilisateur_id'];

    require_once 'config.php'; // Connexion PDO

    $sql = "UPDATE utilisateur SET biographie = :bio WHERE utilisateur_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':bio', $biographie);
    $stmt->bindParam(':id', $user_id);

    if ($stmt->execute()) {
        echo "OK";
    } else {
        echo "Erreur BDD";
    }
} else {
    echo "Paramètres manquants";
}

?>
