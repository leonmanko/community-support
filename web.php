<?php
// Inclusion du fichier de configuration
require_once 'config.php';

// Fonction pour afficher la page d'accueil
function showHomePage() {
    require_once 'views/home.php';
}

// Fonction pour afficher la page des posts
function showPostsPage() {
    require_once 'views/posts.php';
}

// Fonction pour afficher la page des détails d'un post
function showPostDetailsPage($postId) {
    require_once 'views/post_details.php';
}

// Fonction pour afficher la page de création d'un post
function showCreatePostPage() {
    require_once 'views/create_post.php';
}

// Définition des routes
$routes = [
    '/' => 'showHomePage',
    '/posts' => 'showPostsPage',
    '/post/{id}' => 'showPostDetailsPage',
    '/create-post' => 'showCreatePostPage'
];

// Traitement de la requête
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
foreach ($routes as $route => $callback) {
    if (preg_match('#^' . str_replace('/{id}', '/?(\d+)?', $route) . '$#', $requestUri, $matches)) {
        $postId = isset($matches[1]) ? $matches[1] : null;
        call_user_func($callback, $postId);
        exit;
    }
}

// Affichage de la page 404 si aucune route ne correspond
http_response_code(404);
require_once 'views/404.php';


