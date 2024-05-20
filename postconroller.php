
<?php
// Inclusion du fichier de connexion à la base de données
require_once 'database.php';

// Vérification de la méthode HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Traitement des différentes actions
switch ($method) {
    case 'POST':
        // Récupération des données du nouveau post
        $title = $_POST['title'];
        $content = $_POST['content'];
        $userId = $_SESSION['user_id'];

        // Création du nouveau post
        $newPostId = createPost($title, $content, $userId);
        if ($newPostId) {
            // Redirection vers la page d'affichage du post
            header('Location: ' . POST_PAGE . '?id=' . $newPostId);
        } else {
            // Erreur lors de la création du post
            http_response_code(500);
            echo 'Erreur lors de la création du post.';
        }
        break;

    case 'GET':
        // Récupération de l'ID du post
        $postId = $_GET['id'];

        // Récupération des informations du post
        $post = getPostById($postId);
        if ($post) {
            // Envoi des informations du post au front-end
            header('Content-Type: application/json');
            echo json_encode($post);
        } else {
            // Post non trouvé
            http_response_code(404);
            echo 'Post non trouvé.';
        }
        break;

    case 'GET':
        // Récupération de l'ID de l'utilisateur
        $userId = $_GET['user_id'];

        // Récupération des posts de l'utilisateur
        $posts = getPostsByUserId($userId);
        if ($posts) {
            // Envoi des posts de l'utilisateur au front-end
            header('Content-Type: application/json');
            echo json_encode($posts);
        } else {
            // Aucun post trouvé
            http_response_code(404);
            echo 'Aucun post trouvé pour cet utilisateur.';
        }
        break;

    default:
        // Méthode HTTP non prise en charge
        http_response_code(405);
        echo 'Méthode HTTP non prise en charge.';
        break;
}

/**
 * Cr post
 * @param string $content Contenu du post
 *ée un nouveau post
 * @param string $title Titre du @param int $userId ID de l'utilisateur
 * @return int|false ID du nouveau post ou false en cas d'erreur
 */
function createPost($title, $content, $userId) {
    $sql = "INSERT INTO posts (title, content, user_id, created_at) VALUES (:title, :content, :user_id, NOW())";
    $result = executeQuery($sql, [
        ':title' => $title,
        ':content' => $content,
        ':user_id' => $userId
    ]);
    if ($result) {
        return $result->lastInsertId();
    } else {
        return false;
    }
}

/**
 * Récupère un post par son ID
 * @param int $postId ID du post
 * @return array|false Tableau des informations du post($postId) {
    $sql = "SELECT * FROM posts WHERE id ou false en cas d'erreur
 */
function getPostById = :postId";
    $result = executeQuery($sql, [':postId' => $postId]);
    if ($result) {
        return $result->fetch(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}

/**
 * Récupère les posts d'un utilisateur
 * @param int $userId ID de l'utilisateur
 * @return array|false Tableau des posts de l'utilisateur ou false en cas d'erreur
 */
function getPostsByUserId($userId) {
    $sql = "SELECT * FROM posts WHERE user_id = :userId ORDER BY created_at DESC";
    $result = executeQuery($sql, [':userId' => $userId]);
    if ($result) {
        return $result->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}

/**
 * Exécute une requête SQL
 * @param string $sql Requête SQL
 * @param array $params Paramètres de la requête
 * @return PDOStatement|false Objet PDOStatement ou false en cas d'erreur
 */
function executeQuery($sql, $params = []) {
    try {
        $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } catch (PDOException $e) {
        error_log('Erreur SQL : ' . $e->getMessage());
        return false;
    }
}


