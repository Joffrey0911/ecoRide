<?php
session_start(); 


if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: accueil.php');
    exit();
}


require_once 'config.php';

$bio = '';
if (isset($_SESSION['utilisateur_id'])){
  $user_id = $_SESSION['utilisateur_id'];
  $requete = $pdo->prepare("SELECT biographie FROM utilisateur WHERE utilisateur_id = ?");
  $requete->execute([$user_id]);
  $bio = $requete->fetchcolumn();
}



$utilisateur_id = $_SESSION['utilisateur_id'];

$sql = "SELECT u.*, r.libelle AS role_libelle 
        FROM utilisateur u 
        LEFT JOIN role r ON u.role_id = r.role_id 
        WHERE u.utilisateur_id = :utilisateur_id";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);

$stmt->execute();

if($stmt->rowCount() > 0){        //Condition pour trouver l'utilisateur
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo'Utilisateur introuvable';
    exit();
}

$pdo = null;     


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon espace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
  <?php require_once 'header_espace.php'; ?>
 

 <div class="container-fluid">
  <div class="row mt-5">

    <!-- Colonne de gauche : photo + bouton -->
    <div class="col-2 text-start">
      <div id="picture_user">
  <?php
    $photo_path = (!empty($utilisateur['photo'])) 
        ? 'uploads/' . htmlspecialchars($utilisateur['photo']) 
        : 'docs/images/pexels-darina-belonogova-7541439.jpg';
  ?>
  <img src="show_photo.php" alt="photo_user" class="img-fluid rounded">
</div>

      <div>
        <button type="button" class="btn btn-primary mt-2" id="modify_profil">Profil</button>
      </div>
    </div>

    <!-- Colonne principale au centre -->
    <!-- Colonne principale au centre -->
<div class="col-10 text-center">
  <h1>Bienvenue, <?= htmlspecialchars($utilisateur['prenom']) ?> !</h1>

  <div class="row align-items-center justify-content-center">

    <div class="col-1 mt-3 d-flex align-items-center justify-content-center">
      <span class="no-wrap fs-3">Statut</span>
    </div>

    <div class="col-2 mt-3 ms-1 d-flex align-items-center justify-content-center">
      <div id="resultat_statut" class="bg-primary rounded-3 text-white  px-2 py-1">
        <?= htmlspecialchars($utilisateur['role_libelle'] ?? 'Non défini') ?>
      </div>
    </div>

    <div class="col-2 mt-3 fs-3 d-flex align-items-center justify-content-center">
      Notes
    </div>

    <div class="col-2 mt-3 fs-3 d-flex align-items-center justify-content-center">
      Crédits
    </div>
    <div class="col-2 mt-3 d-flex align-items-center justify-content-start">
  <div id="credits_value" class="bg-primary rounded-3 text-white px-2 py-1">
    <?= htmlspecialchars($utilisateur['credit'] ?? '0') ?>
  </div>
</div>


  </div>
   <!-- Biographie dans la même colonne -->
  <div class="row justify-content-center mt-4">
    <div class="text-center mb-0">
      <p class="fs-3 px-2 py-2" style="background: #425279; color: white; display: inline-block; border-radius: 4px;">
        Ma biographie
      </p>
    </div>
    <div id="bio_container" class="col-8 text-center fs-5" style="display: <?= $bio ? 'block' : 'none' ?>; border: solid 2px #425279; padding: 10px; border-radius: 4px;">
      <?= nl2br(htmlspecialchars($bio)) ?>
    </div>
  </div>

</div> 
</div>


 

  
            
       

  
  

    
<div id="global_container" class="container-fluid d-flex flex-column flex-md-row mt-3">
    <div id="zone_profil" class="col-4 mt-3 ms-0 ps-0" style="display: none;">
  <div class="row g-3 justify-content-start">
    <div class="col-12">
      <button type="button" class="btn btn-primary square-btn w-50  mb-2" id="btn_photo">Ajouter ou Modifier une photo</button>
    </div>
    <div class="col-12">
      <button type="button" class="btn btn-primary square-btn w-50  mb-2" id="btn_bio">Biographie</button>
    </div>
    
    <div class="col-12">
      <button type="button" class="btn btn-primary square-btn w-50  mb-2" id="btn_car">Ajouter un véhicule</button>
    </div>
    <div class="col-12">
      <button type="button" class="btn btn-primary square-btn w-50  mb-2" id="btn_ajouter">Ajouter un covoiturage</button>
    </div>
  </div>
</div>


<!-- Container dynamique pour les fonctions-->
<div id="zone_affichage" class="container-fluid  mt-3 mx-0">

  <!-- ZONE STATUT -->
  <div id="zone_statut" class=" col-4 mt-3" style="display: none;">
    
  </div>
  <!-- Affichage message dynamique -->

  <div id ="message_required" class ="container col-12 text-center mt-5 fs-4">
  </div>

  <!-- ZONE FORMULAIRE DYNAMIQUE VEHICULE-->

<div id="zone_vehicule" class="col-12 mt-3" style="display: none;">
  <form method="POST" action="ajouter_voiture.php" id="form_vehicule" name="form_vehicule">
    <div class="row">
      
      <!-- Colonne 1 : Saisie véhicule -->
      <div class="col-4">
        <h3>Saisie véhicule(s)</h3>
        
        <div class="mb-3">
          <label for="immat" class="form-label">Immatriculation :</label>
          <input type="text" class="form-control rounded-5" id="immat" name="immat" required>
        </div>
        
        <div class="mb-3">
          <label for="energy" class="form-label">Energie :</label>
          <select class="form-select rounded-5" id="energy" name="energy" required>
            <option value="" disabled selected>--Selectionnez--</option>
            <option value="diesel">Diesel</option>
            <option value="essence">Essence</option>
            <option value="electric">Electrique</option>
          </select>
        </div>
        
        <div class="mb-3">
          <label for="immat_date" class="form-label">Date de première immatriculation :</label>
          <input type="date" class="form-control rounded-5" id="immat_date" name="immat_date" required>
        </div>
      </div>
      <div class="col-4">
        <h3>Caractéristiques véhicule(s)</h3>
        <div class="mb-3">
          <label for="modele" class="form-label">Modèle du véhicule :</label>
          <input type="text" class="form-control rounded-5" id="modele" name="modele" required>
        </div>
        
        <div class="mb-3">
          <label for="mark" class="form-label">Marque du véhicule :</label>
          <input type="text" class="form-control rounded-5" id="mark" name="mark" required>
        </div>
        
        <div class="mb-3">
          <label for="color" class="form-label">Couleur du véhicule :</label>
          <input type="text" class="form-control rounded-5" id="color" name="color" required>
        </div>
        
        <div class="mb-3">
          <label for="nb_place" class="form-label">Nombre de places de libre :</label>
          <input type="number" class="form-control rounded-5" id="nb_place" name="nb_place" required min="1">
        </div>
      </div>
      
      
      <!-- Colonne 2 : Préférences du chauffeur -->
      <div class="col-md-4">
        <h3>Préférences du chauffeur</h3>
        
        <div class="mb-3">
          <label for="smoking" class="form-label">Fumeur :</label>
          <select class="form-select rounded-5" id="smoking" name="smoking" required>
            <option value="" disabled selected>--Selectionnez--</option>
            <option value="yes">Oui</option>
            <option value="no">Non</option>
          </select>
        </div>
        
        <div class="mb-3">
          <label for="pets" class="form-label">Animaux :</label>
          <select class="form-select rounded-5" id="pets" name="pets" required>
            <option value="" disabled selected>--Selectionnez--</option>
            <option value="yes">Oui</option>
            <option value="no">Non</option>
          </select>
        </div>
      </div>
    </div>
    
    <!-- Bouton valider centré sous les colonnes -->
    <div class="mt-4 text-center">
      <button type="submit" id="btn_valider" class="btn btn-primary px-5">Valider</button>
    </div>
    
  </form>
</div>

      

    
    




  <!-- ZONE BIOGRAPHIE -->
  <div id="zone_biographie" class="col-6 mt-3" style="display: none;">
    <form method = "POST"  action="enregistrer_biographie.php" id="form_bio" name="bio">
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Présentez-vous</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" <?= htmlspecialchars($bio) ?> name="biographie" rows="3"></textarea>
      </div>
      <button type="submit" id="btn_valider_bio" class="btn btn-primary" disabled>Valider</button>
    </form>
  </div>

  <!-- ZONE FORMULAIRE -->





<!-- Affichage du message s'il existe -->
<div id="zone_formulaire" style="display:none;" class="col-6 mt-3">
    <div class="col-12 col-sm-12 col-md-12 col-lg-4 mx-auto" id="searching">
        <div class='col-12 text-center text-success fw-bold fs-5 mb-3' id="messageCovoit"></div>
      <form method="POST" action='covoiturage.php' id="search_travel">
        <div class="mb-3 input-icon-startcity">
          <i class="fas fa-search"></i>
          <input type="text" class="form-control rounded-5" id="startcity" name="startcity" placeholder="Ville départ" required>
        </div>

        <div class="mb-3 input-icon-endcity">
          <i class="fas fa-search"></i>
          <input type="text" class="form-control rounded-5" id="endcity" name="endcity" placeholder="Ville d'arrivée" required>
        </div>

        <div class="row gx-2 mb-3">
          <div class="col-6 input-icon-date">
            <i class="fas fa-calendar-alt"></i>
            <input type="date" class="form-control rounded-5" id="input_date_start" name="input_date_start" placeholder="Date départ" required>
          </div>

          <div class="col-6 mb-3 input-icon-date">
            <i class="fas fa-calendar-alt"></i>
            <input type="date" class="form-control rounded-5" id="input_date_end" name="input_date_end" placeholder="Date arrivée">
          </div>

          <div class="col-6 mb-3 input-icon-time">
            <input type="time" class="form-control rounded-5" id="hour_start" name="hour_start" placeholder="Heure de départ" required>
          </div>

          <div class="col-6 input-icon-time">
            <input type="time" class="form-control rounded-5" id="hour_end" name="hour_end" placeholder="Heure d'arrivée">
          </div>

          <div class="col-6 input-icon-number">
            <i class="fa-solid fa-users"></i>
            <input type="number" class="form-control rounded-5" id="input_number" name="input_number" placeholder="Places disponibles" required>
          </div>

          <div class="col-6 input-icon-number">
            <i class="fa-solid fa-users"></i>
            <input type="number" class="form-control rounded-5" id="price" name="price" placeholder="Prix" required>
          </div>

          <div class="col-6 mb-3">
            <select id="role" name="role" class="form-select rounded-5" required>
              <option value="" disabled selected>Choisissez votre rôle</option>
              <option value="chauffeur">Chauffeur</option>
              <option value="passager">Passager</option>
              <option value="chauffeur_passager">Chauffeur & passager</option>
            </select>
          </div>

          <div class="col-12 mt-1">
            <button type="submit" name="submit" class="btn btn-success rounded-5" id="btn_validate">Créer un covoiturage</button>
          </div>
        </div>
      </form>

      
    </div>
</div>

  <!-- ZONE PHOTO -->
  <div id="zone_photo" style="display: none;" class="col-6 mt-3">
    <div class="col-12 col-sm-12 col-md-12 col-lg-4 mx-auto">
      <form id="form_photo" action="upload_photo.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="photo" id="photo" accept="image/*" class="form-control mb-3" required>
        <button type="submit" name="submit_photo" class="btn btn-success w-100">Ajouter une photo</button>
      </form>
      <div id="resultat_upload" class="mt-2"></div>
    </div>
  </div>

</div> <!-- Fin de zone_affichage -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
