<?php

session_start();
require_once 'config.php';


$message = '';

if (isset($_POST['connexion'])) {
   

    $pseudo = trim($_POST['pseudo']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT utilisateur_id, password FROM utilisateur WHERE pseudo = ? AND email = ?");
    $stmt->execute([$pseudo, $email]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur) {

        if (password_verify($password, $utilisateur['password'])) {
            $_SESSION['utilisateur_id'] = $utilisateur['utilisateur_id'];
            header("Location: espace.php");
            exit();
        } else {
            $message = "Mot de passe incorrect";
        }
    } else {
        $message = "Aucun utilisateur trouvé avec ce pseudo et cet email.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php if (!empty($message)) : ?>
    <p style="color:red;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>


    <form action="login.php" method="POST">
  <label for="pseudo">Pseudo :</label><br>
  <input type="text" name="pseudo" id="pseudo" required><br><br>

  <label for="email">Email :</label><br>
  <input type="email" name="email" id="email" required><br><br>

  <label for="mot_de_passe">Mot de passe :</label><br>
  <input type="password" name="password" id="password" required><br><br>

  <button type="submit" name="connexion">Connexion</button>
</form>

    
</body>
</html>
