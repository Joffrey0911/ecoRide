<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['utilisateur_id'])) {
    exit('Non connecté');
}

$id = $_SESSION['utilisateur_id'];

$sql = "SELECT photo FROM utilisateur WHERE utilisateur_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$user = $stmt->fetch();

if ($user && !empty($user['photo'])) {
    header("Content-Type: image/jpeg"); // ou "image/png" si besoin
    echo $user['photo'];
} else {
    header("Content-Type: image/jpeg");
    readfile("images/profils/default.jpg");
}
