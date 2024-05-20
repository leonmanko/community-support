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
$name = $_POST['name'];
$email = $_POST['email'];
$feedback = $_POST['feedback'];

// Préparer la requête SQL
$stmt = $conn->prepare("INSERT INTO user_feedback (name, email, feedback) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $feedback);

// Exécuter la requête
if ($stmt->execute()) {
    echo "Merci pour votre feedback !";
} else {
    echo "Une erreur est survenue lors de l'envoi de votre feedback : " . $stmt->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>

