<?php
session_start();
require_once 'config.php';

header('Content-Type: text/html; charset=UTF-8');

// Empêche l'affichage brut des erreurs SQL
error_reporting(E_ALL);
ini_set('display_errors', 1);

$message = ""; // Initialisation

if (!isset($_SESSION['utilisateur_id'])) {
    $message = "<span style='color:red;'>Utilisateur non connecté</span>";
} else {
    $utilisateur_id = $_SESSION['utilisateur_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Champs du formulaire
        $depart       = $_POST['startcity'] ?? null;
        $arrivee      = $_POST['endcity'] ?? null;
        $dateDepart   = $_POST['input_date_start'] ?? null;
        $dateArrivee  = $_POST['input_date_end'] ?? null;   // optionnel
        $heureDepart  = $_POST['hour_start'] ?? null;
        $heureArrivee = $_POST['hour_end'] ?? null;         // optionnel
        $nbPlace      = $_POST['input_number'] ?? null;
        $price        = $_POST['price'] ?? null;
        $role         = $_POST['role'] ?? null;

        // Si optionnels sont vides, on met null
        $dateArrivee  = empty($dateArrivee)  ? null : $dateArrivee;
        $heureArrivee = empty($heureArrivee) ? null : $heureArrivee;

        try {
            $sql = "INSERT INTO covoiturage 
                (utilisateur_id, lieu_depart, lieu_arrivee, date_depart, date_arrivee, heure_depart, heure_arrivee, nb_place, prix_personne, role)
                VALUES 
                (:utilisateur_id, :lieu_depart, :lieu_arrivee, :date_depart, :date_arrivee, :heure_depart, :heure_arrivee, :nb_place, :prix_personne, :role)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':utilisateur_id' => $utilisateur_id,
                ':lieu_depart'    => $depart,
                ':lieu_arrivee'   => $arrivee,
                ':date_depart'    => $dateDepart,
                ':date_arrivee'   => $dateArrivee,
                ':heure_depart'   => $heureDepart,
                ':heure_arrivee'  => $heureArrivee,
                ':nb_place'       => $nbPlace,
                ':prix_personne'  => $price,
                ':role'           => $role
            ]);

            // Message de succès
            $message = "<span>Covoiturage ajouté avec succès ✅</span>";

        } catch (PDOException $e) {
            $message = "<span>Erreur : " . htmlspecialchars($e->getMessage()) . "</span>";
        }
    }
}

// Renvoie le message pour JS

echo $message;
