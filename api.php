<?php
// Inclusion du fichier de configuration
require_once 'config.php';

// Fonction pour récupérer tous les posts
function getAllPosts() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY created_at DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour récupérer les détails d'un post
function getPostDetails($postId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :post_id");
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour créer un nouveau post
function createPost($title, $content, $userId) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, user_id, created_at) VALUES (:title, :content, :user_id, NOW())");
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    return $stmt->execute();
}

// Traitement des requêtes API
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['post_id'])) {
        $postId = $_GET['post_id'];
        $postDetails = getPostDetails($postId);
        echo json_encode($postDetails);
    } else {
        $posts = getAllPosts();
        echo json_encode($posts);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $userId = 1; // Remplacer par l'ID de l'utilisateur connecté
    $success = createPost($title, $content, $userId);
    echo json_encode(['success' => $success]);
}


