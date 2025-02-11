<?php
// Inclure le fichier contenant la fonction de connexion
require 'database.php';

// Démarrer la session pour récupérer les informations de l'utilisateur connecté
session_start();

if (!isset($_SESSION['userId'])) {
    echo "Erreur : utilisateur non connecté.";
    exit;
}

// Récupérer le message envoyé
// Récupérer les valeurs
$message = htmlspecialchars(trim($_POST['message']));
$userId = $_SESSION['userId']; // ID de l'utilisateur actuel, supposé être dans la session

// Vérification si le message n'est pas vide
if (!empty($message)) {
    // Préparer la requête d'insertion
    $stmt = $db->prepare("INSERT INTO message (message, date_du_score, jeux_id, joueur_id) 
                          VALUES (?, NOW(), 1, ?)");
    
    // Exécuter la requête avec les données récupérées
    if ($stmt->execute([$message, $userId])) {
        echo "Message enregistré avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement du message.";
    }
} else {
    echo "Le message est vide après nettoyage.";
}

?>
