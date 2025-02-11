<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">

<?php
$pageTitle = 'Inscription';
include 'partials/head.php';
?>

<?php
include 'partials/header.php';
?>

<?php 
    require 'utils/database.php';
    $db = db_connect();
    function isvalidemail($email) {
            
        $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

        return preg_match($pattern, $email);
    }
    function isvalidpseudo($pseudo) {
        
        $pattern = "/^[a-zA-Z0-9_]{4,}$/";

        return preg_match($pattern, $pseudo);
    }
    function isvalidmdp($mot_de_passe) {
        
        $pattern = "/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

        return preg_match($pattern, $mot_de_passe);
    }
    $error = [];
    if (isset($_POST['submit'])) {
        // Chech
        $email = $_POST['email'];
        $mot_de_passe = $_POST['mot_de_passe'];
        $pseudo = $_POST['pseudo'];
        $confirm_mdp = $_POST['mot_de_passe_confirm'];

        if (isvalidpseudo($pseudo)===0) {
            $error [] = "erreur du pseudo";
        }
        if (isvalidmdp($mot_de_passe)===0) {
            $error [] = "erreur du mot de passe";
        }
        if (isvalidemail($email)===0) {
            $error [] = "erreur de l'email";
        }

        $req = $db->prepare('SELECT COUNT(*) FROM utilisateurs WHERE pseudo = ?');
        $req->execute([$pseudo]);
        if ($req->fetchColumn() > 0) {
            $error[] = 'Ce pseudo est déjà utilisé.';
        }

        if ($confirm_mdp != $mot_de_passe) {
            $error [] = "Vous n'avez pas écrit le même mot de passe";
        }

        $mdphash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        if (empty($error)) {
            $sql = "INSERT INTO `utilisateurs`(email,mot_de_passe,pseudo)
                    VALUES (?, ?, ?)";
            $prepare = $db->prepare($sql);
            $prepare->execute([$email, $mdphash, $pseudo]);
        }


    }
    
?>



    <body>
        

        <div class="input-box">
          <form method="POST" action="sign.php">
             <label type="email"></label>
             <input type="text"
                    name="email"
                    placeholder="E-mail"/> <br />

              <label type="name"></label>
               <input type="text"
                      name="pseudo"
                      placeholder="Pseudo"/> <br />

              <label type="password"></label>
                <input type="password"
                       id="password"
                       name="mot_de_passe"
                       oninput="checkPasswordStrength()"
                       placeholder="Mot de passe"/> <br/>
              <div class="textstrength" for="">
                  Force du mot de passe
              </div> <br/>
              <div class="power-container" id="strengthBar">
                <div  id="strengthText" > </div>
              </div>

              <label type="password"></label>
             <input type="password"
                 name="mot_de_passe_confirm"
                 placeholder="Confirmez le de passe"/> <br/>

            <?php foreach($error as $i){
                    echo "<p>".$i."</p>";
            }     
            ?>    

             <button type="submit" name="submit" class="btn">Inscription </button> <br/>
             <a href="login.php">Connectez-vous</a>

          </form>

         </div>
    </body>

<script src="passwordchecker.js">

</script>
        <?php
include 'partials/footer.php';
?>
</html>