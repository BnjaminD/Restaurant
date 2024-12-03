<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            margin: 0;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            padding: 20px;
            text-align: center;
        }
        .carousel {
            position: relative;
            max-width: 800px;
            margin: 20px auto;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .carousel-images {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .carousel img {
            max-width: 100%;
            display: block;
        }
        .carousel-buttons {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .carousel-buttons button {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
        }
        .carousel-buttons button:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenue sur Notre Site</h1>
        <nav>
            <a href="connexion.php">Connexion</a>
            <a href="inscription.php">Inscription</a>
            <a href="#carousel">Carrousel</a>
        </nav>
    </header>
    <div class="container">
        <h2>Découvrez Nos Fonctionnalités</h2>
        <div id="carousel" class="carousel">
            <div class="carousel-images">
                <img src="/php/img/caroussel 1.webp" alt="Slide 1">
                <img src="/php/img/caroussel 2.jpg" alt="Slide 2">
                <img src="/php/img/caroussel 3.webp" alt="Slide 3">
            </div>
            <div class="carousel-buttons">
                <button id="prev-btn">&lt;</button>
                <button id="next-btn">&gt;</button>
            </div>
        </div>
    </div>
    <script>
        // JavaScript pour gérer le carrousel
        const images = document.querySelector('.carousel-images');
        const totalImages = images.children.length;
        let currentIndex = 0;

        document.getElementById('next-btn').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % totalImages;
            updateCarousel();
        });

        document.getElementById('prev-btn').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + totalImages) % totalImages;
            updateCarousel();
        });

        function updateCarousel() {
            images.style.transform = `translateX(-${currentIndex * 100}%)`;
        }
    </script>
</body>
</html>
