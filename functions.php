<?php
session_start();

function inscriptionUtilisateur($username, $email, $mot_de_passe) {
    $db = connectDB();
    
    // Vérifier si l'email existe déjà
    $stmt = $db->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        return false;
    }
    
    // Hachage du mot de passe
    $password_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    
    // Insertion du nouvel utilisateur
    $stmt = $db->prepare("INSERT INTO user (username, email, password_hash) VALUES (?, ?, ?)");
    return $stmt->execute([$username, $email, $password_hash]);
}

function connexionUtilisateur($email, $password) {
    global $pdo;
    try {
        $requete = $pdo->prepare('SELECT * FROM user WHERE email = ?');
        $requete->execute([$email]);
        $user = $requete->fetch();

        // Vérifiez si un utilisateur est trouvé et si le mot de passe est correct
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user; // Succès
        }
        return false; // Échec
    } catch (PDOException $e) {
        die('Erreur SQL : ' . $e->getMessage());
    }
}

function estConnecte() {
    return isset($_SESSION['user_id']);
}

function deconnexion() {
    session_destroy();
    $_SESSION = array();
}

function getMesReservations($user_id) {
    $db = connectDB();
    $stmt = $db->prepare("
        SELECT r.*, rest.nom AS nom_restaurant
        FROM reservations r
        JOIN restaurants rest ON r.restaurant_id = rest.id
        WHERE r.utilisateur_id = ?
        ORDER BY r.date_reservation DESC
    ");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function annulerReservation($reservation_id, $user_id) {
    $db = connectDB();
    $stmt = $db->prepare("DELETE FROM reservations WHERE id = ? AND user_id = ?");
    return $stmt->execute([$reservation_id, $user_id]);
}

function sanitize($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}
?>
