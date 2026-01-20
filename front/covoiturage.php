<?php

// Démarre une nouvelle session
session_start();
require_once __DIR__ . '/../libraries/models/CovoiturageModel.php';

header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$message = "";

// Instancie la classe Covoiturage
$covoiturage = new Covoiturage();

if (!isset($_SESSION['utilisateur_id'])) {
    $message = "<span style='color:red;'>Utilisateur non connecté</span>";
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = [
            'utilisateur_id' => $_SESSION['utilisateur_id'],
            'lieu_depart'    => $_POST['startcity'],
            'lieu_arrivee'   => $_POST['endcity'],
            'date_depart'    => $_POST['input_date_start'],
            'date_arrivee'   => $_POST['input_date_end'] ?? null,
            'heure_depart'   => $_POST['hour_start'],
            'heure_arrivee'  => $_POST['hour_end'] ?? null,
            'nb_place'       => $_POST['input_number'],
            'prix_personne'  => $_POST['price'],
            'role'           => $_POST['role']
        ];

        
        if ($covoiturage->add($data)) {
            $message = "<span>Covoiturage ajouté avec succès ✅</span>";
        } else {
            $message = "<span>Erreur lors de l'ajout ❌</span>";
        }
    }
}

echo $message;
