<?php
// Inclusion du fichier de configuration
require_once 'config.php';

// Fonction pour récupérer les informations d'un utilisateur
function getUserById($userId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour créer un nouvel utilisateur
function createUser($name, $email, $password) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, created_at) VALUES (:name, :email, :password, NOW())");
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    return $stmt->execute();
}

// Fonction pour authentifier un utilisateur
function authenticateUser($email, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        return false;
    }
}

// Traitement des requêtes
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userId = $_GET['user_id'];
    $user = getUserById($userId);
    echo json_encode($user);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'register') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $success = createUser($name, $email, $password);
        echo json_encode(['success' => $success]);
    } elseif (isset($_POST['action']) && $_POST['action'] === 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = authenticateUser($email, $password);
        if ($user) {
            // Démarrer une session et stocker les informations de l'utilisateur
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            echo json_encode(['success' => true, 'user' => $user]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Identifiants invalides']);
        }
    }
}


