<?php
session_start();
require_once 'config.php'; // Connexion PDO

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
  echo "Utilisateur non connecté.";
  exit;
}

$utilisateur_id = $_SESSION['utilisateur_id'];

// Sécurise les entrées
$immat = htmlspecialchars($_POST['immat']);
$energy = $_POST['energy'];
$immat_date = $_POST['immat_date'];
$modele = htmlspecialchars($_POST['modele']);
$mark = htmlspecialchars($_POST['mark']);
$color = htmlspecialchars($_POST['color']);
$nb_place = (int) $_POST['nb_place'];
$smoking = $_POST['smoking'];
$pets = $_POST['pets'];

try {
  $sql = "INSERT INTO voiture 
          (utilisateur_id, immatriculation, energie, date_premiere_immatriculation, modele, marque, couleur, nb_place, fumeur, animaux)
          VALUES 
          (:utilisateur_id, :immat, :energy, :immat_date, :modele, :mark, :color, :nb_place, :smoking, :pets)";
        

  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ':utilisateur_id' => $utilisateur_id,
    ':immat' => $immat,
    ':energy' => $energy,
    ':immat_date' => $immat_date,
    ':modele' => $modele,
    ':mark' => $mark,
    ':color' => $color,
    ':nb_place' => $nb_place,
    ':smoking' => $smoking,
    ':pets' => $pets
  ]);

 echo "Véhicule enregistré avec succès.";
} catch (PDOException $e) {
  echo "Erreur lors de l'enregistrement : " . $e->getMessage();
}

?>
