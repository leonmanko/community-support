
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
function getPostById($postId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :post_id");
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour créer un nouveau post
function createPost($userId, $title, $content) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content, created_at) VALUES (:user_id, :title, :content, NOW())");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    return $stmt->execute();
}

// Traitement des requêtes
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['post_id'])) {
        $postId = $_GET['post_id'];
        $post = getPostById($postId);
        echo json_encode($post);
    } else {
        $posts = getAllPosts();
        echo json_encode($posts);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = 1; // Remplacer par l'ID de l'utilisateur connecté
    $title = $_POST['title'];
    $content = $_POST['content'];
    $success = createPost($userId, $title, $content);
    echo json_encode(['success' => $success]);
}


