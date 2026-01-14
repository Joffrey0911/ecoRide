<?php

session_start(); 

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $telephone = htmlspecialchars($_POST["telephone"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    
    if (empty($nom) || empty($prenom) || empty($pseudo) || empty($telephone) || empty($email) || empty($password)){
        die('Tous les champs sont obligatoires');
    }
    
  
     require_once 'config.php'; 
    

    $sql = "INSERT INTO utilisateur(nom, prenom, pseudo, telephone, email, password, credit)
            VALUES (:nom, :prenom, :pseudo, :telephone, :email, :password, 20)";
    

    try {
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':pseudo' => $pseudo,
            ':telephone' => $telephone,
            ':email' => $email,
            ':password' => $password
            

        ])) {
            
            $id_utilisateur = $pdo->lastInsertId();
            $_SESSION['utilisateur_id'] = $id_utilisateur;
            $_SESSION['utilisateur'] = [
                'nom' => $nom,
                'prenom' => $prenom,
                'pseudo' => $pseudo,
                'email' => $email
            ];

            header("Location: espace.php");
            exit(); 

            

        } else {
            echo "Échec de l'insertion<br>"; 
        }
    } catch (PDOException $e) {
        echo 'Erreur lors de l\'inscription : ' . $e->getMessage();
    }
}
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>
<body id="register_page">
    <nav class="d-flex justify-content-end">
        <ul class="d-flex justify-content-end navbar-nav gap-1 mt-2 me-3">

                    <li class="nav-item fw-bold text-center">
                        <a class="nav-link" href="accueil.php">Accueil</a>
                    </li>

                    <li class="nav-item fw-bold text-center">
                        <a class="nav-link" href="login.php">Connexion</a>
                    </li>
        </ul>
    </nav>
<main class="d-flex justify-content-center my-5">
     <div class = 'divForm'>
        <h2 class="mb-4 text-center" style ='color:rgb(26,107,150)'>Créer un compte</h2>

        <?php if ($erreur): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
        <?php endif; ?>
           
            <form method="POST" class="p-4 shadow rounded">
                <div class="mb-3">
                    <input type="text" class="form-control" id="nom" name="nom" placeholder ='Entrez votre nom' required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder ='Entrez votre prénom' required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder ='Choisir un pseudo' required>
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" id="telephone" name="telephone" placeholder ='Entrez votre numéro de tel' required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder ='Entrez votre email' required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder = 'Choisir un mot de passe' required>
                </div>
                <div class="d-flex justify-content-center">
                <button class="btn btn-success w-75" id="btn_register" type="submit">S'inscrire</button>
            </div>
            </form>
        </div>
        </main>
</body>
</html>

