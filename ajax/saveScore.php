<?php
session_start();
require '../utils/database.php';

// Lire les données JSON du corps de la requête
$json = file_get_contents("php://input");
$data = json_decode($json, true);

if (isset($data['score']) && isset($data['difficulte']) && isset($_SESSION['userId'])) {
    $score = $data['score'];  // Le score en tant que chaîne de caractères (format HH:MM:SS)
    $difficulte = $data['difficulte'];
    $userId = $_SESSION['userId'];

    // Préparer et exécuter la requête pour insérer le score dans la base de données
    $query = $db->prepare("INSERT INTO score_jeux (score_jeux, date_jeux, id_player, id_jeux, id_difficulte)
                           VALUES (:score, NOW(), :id_player, :id_jeux, :id_difficulte)");

    $query->execute([
        ':score' => $score,
        ':id_player' => $userId,
        ':id_jeux' => 1,
        ':id_difficulte' => $difficulte
    ]);

    echo json_encode(["status" => "success", "message" => "Score saved successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Data missing or user not logged in"]);
}
?>