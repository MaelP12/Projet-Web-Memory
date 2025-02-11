<!DOCTYPE html>
<html lang="fr">

<?php
require 'utils/database.php';
session_start();
$db = db_connect();

?>

<?php
$pageTitle = 'contacte';
include 'partials/head.php';
?>

<?php
include 'partials/header.php';
?>



<body>
<div class="page-container">




<div class="contacte">
    <div class="telephone" >
<img src="assets/image/tlephone.png" height="50" width="auto"/>
<p>06 05 04 03 02</p>
    </div>
    <div class="mail">
<img src="assets/image/mail.png" height="50" width="auto"/>
<p>Capybara@gmail.com</p>
    </div>
    <div class="ping">
<img src="assets/image/ping.png" height="50" width="auto"/>
<p>paris</p>
    </div>
</div>

    <?php
    if(isset($_POST['ok'])){
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $sujet = $_POST['sujet'];
        $message = $_POST['message'];

        if (!empty($nom) && !empty($email) && !empty($sujet) && !empty($message)) {
            $to  = "capybara@gmail.com";
            $subject = "Formulaire de contact";
            $message = "";
            $headers  = "From: capybara@gmail.com";
             'Reply-To: capybara@gmail.com';
             'X-Mailer: PHP/' . phpversion();
             mail($to, $subject, $message, $headers);
        }
    }
    ?>

    <form>
        <div class="ligne-input">
            <input type="text"
                   name="nom"
                   placeholder="nom"
                   class="input-champ" />

            <input type="email"
                   name="e-mail"
                   placeholder="Email"
                   class="input-champ" />
        </div>

        <br />

        <input type="text"
               name="sujet"
               placeholder="sujet"
               class="input-champ"/> <br />

        <textarea name="message"
                  placeholder="Message"
                  class="input-champ textarea-message"></textarea> <br />

        <br>
        <input type="button" value="envoyer" class="btn-envoyer"/>
    </form>

    <?php
include 'partials/footer.php';
?>
</div>
</body>
</html>
