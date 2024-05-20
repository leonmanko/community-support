Voici le code pour le fichier comment.php qui gère les fonctionnalités liées aux commentaires dans notre application de support communautaire, ainsi que la partie front-end correspondante :

php
<?php
// Inclusion du fichier de configuration
require_once 'config.php';

// Fonction pour récupérer tous les commentaires d'un post
function getCommentsByPostId($postId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM comments WHERE post_id = :post_id ORDER BY created_at DESC");
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour créer un nouveau commentaire
function createComment($postId, $userId, $content) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, content, created_at) VALUES (:post_id, :user_id, :content, NOW())");
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    return $stmt->execute();
}

// Traitement des requêtes
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $postId = $_GET['post_id'];
    $comments = getCommentsByPostId($postId);
    echo json_encode($comments);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['post_id'];
    $userId = 1; // Remplacer par l'ID de l'utilisateur connecté
    $content = $_POST['content'];
    $success = createComment($postId, $userId, $content);
    echo json_encode(['success' => $success]);
}


