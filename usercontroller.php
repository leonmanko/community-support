
<?php
// Inclusion du fichier de connexion à la base de données
require_once 'database.php';

// Vérification de la méthode HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Traitement des différentes actions
switch ($method) {
    case 'POST':
        // Récupération des données de l'utilisateur
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Vérification si l'utilisateur existe déjà
        $existingUser = getUserByEmail($email);
        if ($existingUser) {
            // L'utilisateur existe déjà
            http_response_code(409);
            echo 'Un compte avec cet e-mail existe déjà.';
        } else {
            // Création du nouvel utilisateur
            $newUserId = createUser($username, $email, $password);
            if ($newUserId) {
                // Redirection vers la page de connexion
                header('Location: ' . LOGIN_PAGE);
            } else {
                // Erreur lors de la création de l'utilisateur
                http_response_code(500);
                echo 'Erreur lors de la création du compte.';
            }
        }
        break;

    case 'POST':
        // Récupération des données de connexion
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Vérification des identifiants de l'utilisateur
        $user = getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            // Connexion réussie, redirection vers la page d'accueil
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: ' . HOME_PAGE);
        } else {
            // Identifiants incorrects
            http_response_code(401);
            echo 'Identifiants incorrects.';
        }
        break;

    case 'GET':
        // Récupération de l'ID de l'utilisateur
        $userId = $_GET['id'];

        // Récupération des informations de l'utilisateur
        $user = getUserById($userId);
        if ($user) {
            // Envoi des informations de l'utilisateur au front-end
            header('Content-Type: application/json');
            echo json_encode($user);
        } else {
            // Utilisateur non trouvé
            http_response_code(404);
            echo 'Utilisateur non trouvé.';
        }
        break;

    default:
        // Méthode HTTP non prise en charge
        http_response_code(405);
        echo 'Méthode HTTP non prise en charge.';
        break;
}

/**
 * Récupère un utilisateur par son e-mail
 * @param string $email E-mail de l'utilisateur
 * @return array|false Tableau des informations de l'utilisateur ou false en cas d'erreur
 */
function getUserByEmail($email) {
    $sql = "SELECT * FROM users WHERE email = :email";
    $result = executeQuery($sql, [':email' => $email]);
    if ($result) {
        return $result->fetch(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}

/**
 * Crée un nouvel utilisateur
 * @param string $username Nom d'utilisateur
 * @param string $email E-mail de l'utilisateur
 * @param string $password Mot de passe de l'utilisateur
 * @return int|false ID du nouvel utilisateur ou false en cas d'erreur
 */
function createUser($username, $email, $password) {
    $sql = "INSERT INTO users (username, email, password, created_at) VALUES (:username, :email, :password, NOW())";
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $result = executeQuery($sql, [
        ':username' => $username,
        ':email' => $email,
        ':password' => $hashedPassword
    ]);
    if ($result) {
        return $result->lastInsertId();
    } else {
        return false;
    }
}

/**
 * Récupère un utilisateur par son ID
 * @param int $userId ID de l'utilisateur
 * @return array|false Tableau des informations de l'utilisateur ou false en cas d'erreur
 */
function getUserById($userId) {
    $sql = "SELECT * FROM users WHERE id = :userId";
    $result = executeQuery($sql, [':userId' => $userId]);
    if ($result) {
        return $result->fetch(PDO::FETCH_ASSOC);
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


