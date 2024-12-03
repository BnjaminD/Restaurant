<?php
require_once ('database.php');
require_once ('functions.php');
require_once ('config.php');
$restaurants = $getRestaurants();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Restaurants</title>
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
        <h1>Nos Restaurants</h1>
        <div class="restaurants-grid">
            <?php foreach($restaurants as $restaurant): ?>
                <div class="restaurant-card">
                    <img src="images/restaurant<?= $restaurant['id'] ?>.jpg" alt="<?= $restaurant['nom'] ?>">
                    <div class="restaurant-card-content">
                        <h2><?= $restaurant['nom'] ?></h2>
                        <p><?= substr($restaurant['description'], 0, 100) ?>...</p>
                        <a href="reservation.php?id=<?= $restaurant['id'] ?>" class="btn">Réserver</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.navbar-menu').classList.toggle('active');
        });
    </script>
</body>
</html>