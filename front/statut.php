<?php
/* require 'config.php';
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['role'])) {
    $libelle = $_POST['role'];

    // Récupère l'id du rôle à partir de son libellé
    $stmt = $pdo->prepare("SELECT role_id FROM role WHERE libelle = :libelle");
    $stmt->execute(['libelle' => $libelle]);
    $role = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($role) {
        $role_id = $role['role_id'];

        if (!isset($_SESSION['utilisateur_id'])) {
            echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté.']);
            exit();
        }

        $utilisateur_id = $_SESSION['utilisateur_id'];

        // Mise à jour en base
        $stmt = $pdo->prepare("UPDATE utilisateur SET role_id = :role_id WHERE utilisateur_id = :id");
        $stmt->execute([
            'role_id' => $role_id,
            'id' => $utilisateur_id
        ]);

        // Succès
        echo json_encode(['success' => true, 'role' => $libelle]);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Rôle non trouvé.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Requête invalide.']);
}
*/