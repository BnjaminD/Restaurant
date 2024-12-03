<?php
require_once ('config.php');

// Fonction de connexion à la base de données
function connectDB() {
    try {
        // Construction de la chaîne de connexion DSN
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        
        // Options de connexion PDO
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        // Création de la connexion PDO
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        
        return $pdo;
    } catch (PDOException $e) {
        // Gestion des erreurs de connexion
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}

// Connexion globale à la base de données
try {
    $db = connectDB();
} catch (Exception $e) {
    // Gestion des erreurs si la connexion échoue
    error_log($e->getMessage());
    die("Impossible de se connecter à la base de données.");
}
?>
