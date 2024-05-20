<?php
// Paramètres de connexion à la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'community_support');
define('DB_USER', 'votre_utilisateur');
define('DB_PASS', 'votre_mot_de_passe');

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit;
}

/**
 * Exécute une requête SQL préparée et retourne le résultat
 * @param string $sql Requête SQL à exécuter
 * @param array $params Paramètres de la requête SQL
 * @return PDOStatement|false Résultat de la requête ou false en cas d'erreur
 */
function executeQuery($sql, $params = []) {
    global $pdo;
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        return $stmt;
    } else {
        return false;
    }
}

/**
 * Insère une nouvelle discussion dans la base de données
 * @param string $title Titre de la discussion
 * @param string $content Contenu de la discussion
 * @param int $userId ID de l'utilisateur qui a créé la discussion
 * @return int|false ID de la discussion insérée ou false en cas d'erreur
 */
function insertDiscussion($title, $content, $userId) {
    $sql = "INSERT INTO discussions (title, content, user_id, created_at) VALUES (:title, :content, :user_id, NOW())";
    $result = executeQuery($sql, [
        ':title' => $title,
        ':content' => $content,
        ':user_id' => $userId
    ]);
    if ($result) {
        return $pdo->lastInsertId();
    } else {
        return false;
    }
}

/**
 * Récupère la liste des discussions
 * @return array|false Tableau des discussions ou false en cas d'erreur
 */
function getDiscussions() {
    $sql = "SELECT * FROM discussions ORDER BY created_at DESC";
    $result = executeQuery($sql);
    if ($result) {
        return $result->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}

/**
 * Récupère les détails d'une discussion
 * @param int $discussionId ID de la discussion
 * @return array|false Tableau des détails de la discussion ou false en cas d'erreur
 */
function getDiscussionDetails($discussionId) {
    $sql = "SELECT * FROM discussions WHERE id = :discussion_id";
    $result = executeQuery($sql, [':discussion_id' => $discussionId]);
    if ($result) {
        return $result->fetch(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}

// Autres fonctions de gestion de la base de données...

// Liens vers le front-end
define('FRONT_END_URL', 'http://localhost/community-support');
define('DISCUSSION_LIST_PAGE', FRONT_END_URL . '/discussions.php');
define('DISCUSSION_DETAILS_PAGE', FRONT_END_URL . '/discussion.php?id=');

?>


