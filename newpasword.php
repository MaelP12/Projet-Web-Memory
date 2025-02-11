<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">

<?php
session_start();
$pageTitle = 'Changer mot de passe';
include 'partials/head.php';
?>

<?php
include 'partials/header.php';
?>

<?php
require 'utils/database.php';

var_dump($_SESSION);

function isvalidemail($email) {

    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    return preg_match($pattern, $email);
}

function isvalidmdp($ancienmotdepasse) {

    $pattern = "/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

    return preg_match($pattern, $ancienmotdepasse);
}

function isvalidnewmdp($nouveaumotdepasse) {

    $pattern = "/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

    return preg_match($pattern, $nouveaumotdepasse);
}

function changepassword($user_id, $ancienmotdepasse, $nouveaumotdepasse, $pdo) {

    $sql = "SELECT * FROM utilisateurs WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

//    var_dump($user, password_verify($ancienmotdepasse, $user['mot_de_passe']), password_hash($nouveaumotdepasse, PASSWORD_DEFAULT));

    if ($user && password_verify($ancienmotdepasse, $user['mot_de_passe'])) {

        $newPasswordHash = password_hash($nouveaumotdepasse, PASSWORD_DEFAULT);
        $updateSql = "UPDATE utilisateurs SET mot_de_passe = :mot_de_passe WHERE id = :id";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([':mot_de_passe' => $newPasswordHash, ':id' => $user_id]);
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $nouveaumotdepasse = $_POST['mot_de_passe'];
    $ancienmotdepasse = $_POST['ancien_mot_de_passe'];

    $error = [];
    if (isvalidnewmdp($nouveaumotdepasse) === false) {
        $error [] = "erreur du nouveau mot de passe";
    }
    //$error [] = "erreur du nouveau mot de passe";
    if (isvalidmdp($ancienmotdepasse) === false) {
        $error [] = "erreur du mot de passe";
    }
    if (isvalidemail($email) === false) {
        $error [] = "erreur de l'email";
    }

    if (empty($error)) {

        $userId = $_SESSION['userId'];

        $pdo = new PDO('mysql:host=localhost;dbname=m', 'root', 'root'); // A adapter avec vos infos

        if (changepassword($userId, $ancienmotdepasse, $nouveaumotdepasse, $pdo)) {
            echo "Mot de passe changé avec succès!";
        } else {
            echo "Erreur : L'ancien mot de passe est incorrect.";
        }
    } else {

        foreach ($error as $err) {
            echo "<p>$err</p>";
        }
    }

    $mdphash = password_hash($ancienmotdepasse, PASSWORD_DEFAULT);
}
?>


<body>


<div class="input-box">
    <form method="POST" action="#">
        <label type="email"></label>
        <input type="text"
               name="email"
               placeholder="E-mail"/> <br />

        <label type="password"></label>
        <input type="password"
               name="ancien_mot_de_passe"
               placeholder="Ancien mot de passe"/> <br />

        <label type="password"></label>
        <input type="password"
               name="mot_de_passe"
               placeholder="Nouveau mot de passe"/> <br/>


        <button type="submit" name="submit" class="btn"> Valider </button> <br/>

    </form>

</div>


</body>
</html>
