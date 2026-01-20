<?php 


require_once __DIR__ . '/Database.php';


// Crée la classe Covoiturage 
class Covoiturage
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPdo(); // connexion PDO
    }

    // Fonction ajouter un covoiturage
    public function add(array $data): bool
    {
   try {
            $sql = "INSERT INTO covoiturage 
                (utilisateur_id, lieu_depart, lieu_arrivee, date_depart, date_arrivee, heure_depart, heure_arrivee, nb_place, prix_personne, `role`) 
                VALUES 
                (:utilisateur_id, :lieu_depart, :lieu_arrivee, :date_depart, :date_arrivee, :heure_depart, :heure_arrivee, :nb_place, :prix_personne, :role)";

            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':utilisateur_id' => $data['utilisateur_id'],
                ':lieu_depart'    => $data['lieu_depart'],
                ':lieu_arrivee'   => $data['lieu_arrivee'],
                ':date_depart'    => $data['date_depart'],
                ':date_arrivee'   => $data['date_arrivee'] ?? null,
                ':heure_depart'   => $data['heure_depart'],
                ':heure_arrivee'  => $data['heure_arrivee'] ?? null,
                ':nb_place'       => $data['nb_place'],
                ':prix_personne'  => $data['prix_personne'],
                ':role'           => $data['role'],
            ]);
        } catch (PDOException $e) {
            
            return false; 
        }
    }
}