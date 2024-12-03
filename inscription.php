<?php
require_once ('database.php');
require_once ('functions.php');

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? sanitize($_POST['username']) : '';
    $email = isset($_POST['email']) ? sanitize($_POST['email']) : '';
    $mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';

    if ($username && $email && $mot_de_passe) {
        if (inscriptionUtilisateur($username, $email, $mot_de_passe)) {
            $message = "Inscription réussie !";
        } else {
            $message = "Une erreur s'est produite lors de l'inscription.";
        }
    } else {
        $message = "Tous les champs sont obligatoires.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Inscription</h1>
            <?php if ($message): ?>
                <div class="message"><?= $message ?></div>
            <?php endif; ?>
            <form method="POST">
                <input type="text" name="username" placeholder="Pseudo" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
                <input type="password" name="confirmation_mdp" placeholder="Confirmer le mot de passe" required>
                <input type="submit" value="S'inscrire" class="btn">
            </form>
            <p>Déjà un compte ? <a href="connexion.php">Connectez-vous</a></p>
        </div>
    </div>
</body>
</html>