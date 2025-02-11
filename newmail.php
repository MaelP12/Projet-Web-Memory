<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">

<?php
session_start();
$pageTitle = 'Changer e-mail';
include 'partials/head.php';
?>

<?php
include 'partials/header.php';
?>

<?php
require 'utils/database.php';

var_dump($_SESSION);

function isvalidancienemail($ancienemail) {

    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    return preg_match($pattern, $ancienemail);
}

function isvalidmdp($motdepasse) {

    $pattern = "/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

    return preg_match($pattern, $motdepasse);
}

function isvalidnewemail($nouvelemail) {

    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    return preg_match($pattern, $nouvelemail);
}

function changeemail($user_id, $motdepasse, $nouvelemail, $pdo) {

    $sql = "SELECT * FROM utilisateurs WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

//    var_dump($user, password_verify($ancienmotdepasse, $user['mot_de_passe']), password_hash($nouveaumotdepasse, PASSWORD_DEFAULT));

    if ($user && password_verify($motdepasse, $user['mot_de_passe'])) {

        $updateSql = "UPDATE utilisateurs SET email = :email WHERE id = :id";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([':email' => $nouvelemail, ':id' => $user_id]);
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['submit'])) {

    $ancienemail = $_POST['ancien_email'];
    $motdepasse = $_POST['mot_de_passe'];
    $nouvelemail = $_POST['nouvel_email'];

    $error = [];
    if (isvalidnewemail($nouvelemail) === false) {
        $error [] = "erreur du nouvel email";
    }
    //$error [] = "erreur du nouveau mot de passe";
    if (isvalidancienemail($ancienemail) === false) {
        $error [] = "erreur d'email";
    }
    if (isvalidmdp($motdepasse) === false) {
        $error [] = "erreur du mot de passe";
    }

    if (empty($error)) {

        $userId = $_SESSION['userId'];

        $pdo = new PDO('mysql:host=localhost;dbname=m', 'root', 'root'); // A adapter avec vos infos

        if (changeemail($userId, $motdepasse, $nouvelemail, $pdo)) {
            echo "Email changé avec succès!";
        } else {
            echo "Erreur : L'ancien email est incorrect.";
        }
    } else {

        foreach ($error as $err) {
            echo "<p>$err</p>";
        }
    }
    $mdphash = password_hash($motdepasse, PASSWORD_DEFAULT);
}
?>


<body>


<div class="input-box">
    <form method="POST" action="#">
        <label type="password"></label>
        <input type="password"
               name="mot_de_passe"
               placeholder="mot de passe"/> <br />

        <label type="email"></label>
        <input type="text"
               name="ancien_email"
               placeholder="Ancien email"/> <br />

        <label type="email"></label>
        <input type="text"
               name="nouvel_email"
               placeholder="Nouvel email"/> <br />


        <button type="submit" name="submit" class="btn"> Valider </button> <br/>

    </form>

</div>


</body>
</html>
