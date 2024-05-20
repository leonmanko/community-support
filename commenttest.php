<?php
// Connexion à la base de données
$servername = "localhost";
$username = "votre_utilisateur";
$password = "votre_mot_de_passe";
$dbname = "community_support";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupérer les données du formulaire
$post_id = $_POST['post_id'];
$author = $_POST['author'];
$comment = $_POST['comment'];

// Préparer la requête SQL
$stmt = $conn->prepare("INSERT INTO comments (post_id, author, comment) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $post_id, $author, $comment);

// Exécuter la requête
if ($stmt->execute()) {
    echo "Votre commentaire a été ajouté avec succès !";
} else {
    echo "Une erreur est survenue lors de l'ajout de votre commentaire : " . $stmt->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>

