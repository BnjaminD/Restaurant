<?php
require_once ('database.php');
require_once ('functions.php');

$restaurant_id = $_GET['id'] ?? null;
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = sanitize($_POST['date']);
    $heure = sanitize($_POST['heure']);
    $personnes = sanitize($_POST['personnes']);
    $nom = sanitize($_POST['nom']);
    $email = sanitize($_POST['email']);

    if ($reserverTable($restaurant_id, $date, $heure, $personnes, $nom, $email)) {
        $message = "Réservation confirmée !";
    } else {
        $message = "Erreur lors de la réservation.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">RestoBook</div>
        <div class="menu-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <ul class="navbar-menu">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="restaurants.php">Restaurants</a></li>
            <li><a href="reservation.php">Réserver</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="form-container">
            <h1>Formulaire de Réservation</h1>
            <?php if($message): ?>
                <p><?= $message ?></p>
            <?php endif; ?>
            <form method="POST">
                <input type="date" name="date" required>
                <input type="time" name="heure" required>
                <input type="number" name="personnes" placeholder="Nombre de personnes" min="1" max="10" required>
                <input type="text" name="nom" placeholder="Votre nom" required>
                <input type="email" name="email" placeholder="Votre email" required>
                <input type="submit" value="Réserver" class="btn">
            </form>
        </div>
    </div>

    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.navbar-menu').classList.toggle('active');
        });
    </script>
</body>
</html>