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
$title = $_POST['title'];
$content = $_POST['content'];

// Préparer la requête SQL
$stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
$stmt->bind_param("ss", $title, $content);

// Exécuter la requête
if ($stmt->execute()) {
    echo "Votre publication a été ajoutée avec succès !";
} else {
    echo "Une erreur est survenue lors de l'ajout de votre publication : " . $stmt->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>

