<!DOCTYPE html>

<!-- $_SESSION['userId'] = $user['id']; -->
<html lang="fr" xmlns="http://www.w3.org/1999/html">

<?php
$pageTitle = 'Connexion';
include 'partials/head.php';
?>

<?php
include 'partials/header.php';
?>

    <?php




    require 'utils/database.php';
    $db = db_connect();
    session_start();
    $verif_co=false;
    if(isset($_POST["submit"])){
        $email = $_POST["email"];
        $password = $_POST["mot_de_passe"];

        
        

        $sql = "SELECT id, email, mot_de_passe, pseudo FROM `utilisateurs` ";
        $stmt= $db->prepare($sql);
        $stmt->execute();
        $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($utilisateurs as $ligne){
            if ($ligne["email"] == $email && password_verify($password, $ligne["mot_de_passe"])) {
                $verif_co =  true;
                $_SESSION['userId'] = $ligne['id'];
                $_SESSION['pseudo'] = $ligne['pseudo'];
                break;
            }
            else{
                $verif_co = false;
            }
        }
        
    }

    ?>

    <body>
        <div class="input-box">
          <form action="login.php" method="POST">
                <label type="email"></label>
                <input type="email" name="email"
                        placeholder="E-mail"/> <br />

                <label type="password"> </label>
                <input type="password" name="mot_de_passe" placeholder="Mot de Passe"/> <br/>

                <?php 
                if (isset($_SESSION['userId'])) {
                  // Utilisateur connecté
                  $pseudo = $_SESSION['pseudo'];
                  echo "<p class='verication'>Connexion réussie</p>" ;
                  echo "Bienvenue, " . htmlspecialchars($pseudo);
              } else {
                  // Redirection ou message pour les utilisateurs non connectés
                  echo"<p class='verification'>Connexion refusé</p>";
              }
                ?>
            
                <button type="submit" name="submit" class="btn">Connexion </button> <br/>
                <a href="sign.php">Inscrivez-vous</a>
            </form>
        </div>


    </body>
    
    <?php
include 'partials/footer.php';
?>
</html>