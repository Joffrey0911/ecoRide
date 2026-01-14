<?php
session_start();
require_once 'config.php';

// Récupérer la donnée envoyée
$voiture = $_POST['voiture'] ?? null;

if (!$voiture) {
    echo json_encode(['success' => false, 'message' => 'Donnée manquante']);
    exit;
}

// Préparer et exécuter la requête
$req = $bdd->prepare('SELECT id FROM utilisateur WHERE voiture = :voiture');
$req->execute(['voiture' => $voiture]);

// Vérification du résultat
if ($req->rowCount() > 0) {
    echo json_encode(['success' => true, 'voiture_existe' => true]);
} else {
    echo json_encode(['success' => true, 'voiture_existe' => false]);
}

$req->closeCursor();
