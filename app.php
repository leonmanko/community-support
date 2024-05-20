<?php
// Inclusion du fichier de connexion à la base de données
require_once 'database.php';

// Vérification de la méthode HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Traitement des différentes actions
switch ($method) {
    case 'GET':
        // Récupération de la liste des discussions
        $discussions = getDiscussions();
        if ($discussions) {
            // Envoi de la liste des discussions au front-end
            header('Content-Type: application/json');
            echo json_encode($discussions);
        } else {
            // Erreur lors de la récupération des discussions
            http_response_code(500);
            echo 'Erreur lors de la récupération des discussions.';
        }
        break;

    case 'POST':
        // Récupération des données de la nouvelle discussion
        $title ='];
        $userId = $_POST['user_id'];

         $_POST['title'];
        $content = $_POST['content// Insertion de la nouvelle discussion dans la base de données
        $newDiscussionId = insertDiscussion($title, $content, $userId);
        if ($newDiscussionId) {
            // Redirection vers la page de détails de la nouvelle discussion
            header('Location: ' . DISCUSSION_DETAILS_PAGE . $newDiscussionId);
        } else {
            // Erreur lors de l'insertion de la nouvelle discussion
            http_response_code(500);
            echo 'Erreur lors de l\'insertion de la nouvelle discussion.';
        }
        break;

    case 'GET':
        // Récupération de l'ID de la discussion à afficher
        $discussionId = $_GET['id'];

        // Récupération des détails de la discussion
        $discussionDetails = getDiscussionDetails($discussionId);
        if ($discussionDetails) {
            // Envoi des détails de la discussion au front-end
            header('Content-Type: application/json');
            echo json_encode($discussionDetails);
        } else {
            // Erreur lors de la récupération des détails de la discussion
            http_response_code(404);
            echo 'Discussion non trouvée.';
        }
        break;

    default:
        // Méthode HTTP non prise en charge
        http_response_code(405);
        echo 'Méthode HTTP non prise en charge.';
        break;
}
?>



