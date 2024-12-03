<?php
require_once 'database.php';
require_once 'functions.php';

// Vérification de connexion
if (!estConnecte()) {
    header("Location: connexion.php");
    exit();
}

// Annulation de réservation
if (isset($_GET['annuler']) && isset($_GET['id'])) {
    $id_reservation = intval($_GET['id']);
    if (annulerReservation($id_reservation, $_SESSION['utilisateur_id'])) {
        $message = "Réservation annulée avec succès.";
    } else {
        $message = "Erreur lors de l'annulation de la réservation.";
    }
}

// Récupération des réservations
$reservations = getMesReservations($_SESSION['utilisateur_id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace Personnel</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Bonjour <?= $_SESSION['prenom'] ?> <?= $_SESSION['nom'] ?></h1>
        
        <?php if (isset($message)): ?>
            <div class="message"><?= $message ?></div>
        <?php endif; ?>

        <h2>Mes Réservations</h2>
        <?php if (empty($reservations)): ?>
            <p>Vous n'avez pas de réservations en cours.</p>
        <?php else: ?>
            <div class="reservations-liste">
                <?php foreach ($reservations as $reservation): ?>
                    <div class="reservation-card">
                        <h3><?= $reservation['nom_restaurant'] ?></h3>
                        <p>Date : <?= date('d/m/Y', strtotime($reservation['date_reservation'])) ?></p>
                        <p>Heure : <?= $reservation['heure_reservation'] ?></p>
                        <p>Personnes : <?= $reservation['nombre_personnes'] ?></p>
                        <a href="espace_personnel.php?annuler=1&id=<?= $reservation['id'] ?>" class="btn btn-annuler">Annuler</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <a href="deconnexion.php" class="btn btn-deconnexion">Déconnexion</a>
    </div>
</body>
</html>
