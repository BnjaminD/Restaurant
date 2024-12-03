<?php
require_once('database.php');
require_once('functions.php');
require_once('config.php');

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize($_POST['username']);
    $mot_de_passe = $_POST['mot_de_passe'];

    if (connexionUtilisateur($username, $mot_de_passe)) {
        header("Location: espace_personnel.php");
        exit();
    } else {
        $message = "Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Connexion</h1>
            <?php if ($message): ?>
                <div class="message"><?= $message ?></div>
            <?php endif; ?>
            <form method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
                <input type="submit" value="Se connecter" class="btn">
            </form>
            <p>Pas de compte ? <a href="inscription.php">Inscrivez-vous</a></p>
        </div>
    </div>
</body>
</html>
