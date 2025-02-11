<!DOCTYPE html>
<html lang="fr">

<?php
require 'utils/database.php';




session_start();
$db = db_connect();


if (!isset($_SESSION['userId'])){
    header("Location: /sign.php");
    exit();
}



$db = db_connect();





$sql = "SELECT * FROM `message`
WHERE `date_du_score` <= NOW() + INTERVAL 24 HOUR  
ORDER BY `date_du_score` ASC";


$stmt= $db->prepare($sql);
$stmt->execute();

$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);



$json = file_get_contents("https://api.thecatapi.com/v1/images/search?mime_types=gif");
$parse = json_decode($json, true);
$url = $parse[0]["url"];

?>

<?php
$pageTitle = 'COMPTES';
include 'partials/head.php';

?>

<?php
include 'partials/header.php';
?>

<body>

<?php
$dossier_images = "assets/userFiles/";
$extensions = ['jpg', 'png', 'jpeg', 'gif'];
$image_path = null;
foreach ($extensions as $extension) {
    $fichier_image = $dossier_images . htmlspecialchars($_SESSION['pseudo']) . '.' . $extension;
    
    // Vérifier si le fichier avec cette extension existe
    if (file_exists($fichier_image)) {
        $image_path = $fichier_image;
        break; // Sort de la boucle si l'image est trouvée
    }
}
?>
<div class="pp_size">
<?php
if(!is_null($image_path)){


    echo "<img src='" . htmlspecialchars($image_path) . "' alt='Image de $pseudo'  />";
}
?>

    <button onclick="alert('Bouton cliqué !')" style="position: absolute; top: 0; left: 0; width: 10%; height: 62%; opacity: 0; border: none; cursor: pointer;"></button>
</div>



<input type="checkbox" id="click">
<label for="click">
<img src="src/images/logochatbox.png" style="height: 50px; width: auto;">
</label>





<div class="page">
    <div class="head-text">
        capybara - chatbox
    </div>


    <div class="chat-box">
    <div class="discussion" id="discussion">
        <?php
        
            foreach ($messages as $message) {
               
                if($message['joueur_id'] ===  $_SESSION['userId'] ){
                    echo"
                        <div class='user'>
                            <p>" . $message['message'] . "</p>
                        </div>
                    ";
                }
                else{
                    echo "
                    <div class='useronline'>
                        <div class='message'>
                            <p>". $message["message"] . "</p>
                        </div>   
                    </div>";
                }

            }

            
            echo"<img src=$url>";
        ?>
    </div>
    <form  method="POST">
      <div class="field">
        <textarea rows="5" cols="5" name="message" placeholder="Entrez votre message"></textarea>
      </div>
      <div class="field">
        <button type="button" onclick="submitMessage()">Cliquez ici</button>

      </div>
    </form>
  </div>
</div>




<span>
  <div class="tablename">
    <h3>informations personnelles &#129489;&#8205;&#128187 </h3>
      <table class="infoperso">
            <thead class="colonneinfoperso">
                <tr>
                    <th>prenom</th>
                    <th>nom</th>
                </tr>
            </thead>

            <tbody>
                <!-- Ligne du tableau qui sera par la suite dans une boucle pour afficher les données de la bdd -->
                <tr class="ligneinfoperso">
                    <td>thimeo</td>
                    <td>ozaneaux</td>
                </tr>
            </tbody>
        </table>

      <br>
      <br>

    <table class="infoperso">
            <thead class="colonneinfoperso">
                <tr>
                    <th>date de naissance</th>

                </tr>
            </thead>

            <tbody>
                <!-- Ligne du tableau qui sera par la suite dans une boucle pour afficher les données de la bdd -->
                <tr class="ligneinfoperso">
                    <td>27/12/2005</td>

                </tr>
            </tbody>
        </table>

    <br>
      <br>

    <table class="infoperso">
            <thead class="colonneinfoperso">
                <tr>
                    <th>email</th>

                </tr>
            </thead>

            <tbody>
                <!-- Ligne du tableau qui sera par la suite dans une boucle pour afficher les données de la bdd -->
                <tr class="ligneinfoperso">
                    <td>xxxxxxxxx@gmail.com</td>

                </tr>
            </tbody>
        </table>

    <br>
      <br>
    <h3>mot de passe et sécurité &#128274</h3>
    <table class="infoperso">
            <thead class="colonneinfoperso">
                <tr>
                    <th>email de recuperation</th>

                </tr>
            </thead>

            <tbody>
                <!-- Ligne du tableau qui sera par la suite dans une boucle pour afficher les données de la bdd -->
                <tr class="ligneinfoperso">
                    <td>xxxxxxxxx@gmail.com</td>

                </tr>
            </tbody>
        </table>

    <br>
      <br>
    <table class="infoperso">
            <thead class="colonneinfoperso">
                <tr>
                    <th>mot de passe</th>

                </tr>
            </thead>

            <tbody>
                <!-- Ligne du tableau qui sera par la suite dans une boucle pour afficher les données de la bdd -->
                <tr class="ligneinfoperso">
                    <td>xxxxxxxxxxxxx</td>

                </tr>
            </tbody>
        </table>

    <br>
                </tr>
            </thead>

        </table>

    <br>
      <br>
    <table class="infoperso">
            <thead class="colonneinfoperso">
                <tr>
                    <th>lieu de connexion</th>


                </tr>
            </thead>

            <tbody>
                <!-- Ligne du tableau qui sera par la suite dans une boucle pour afficher les données de la bdd -->
                <tr class="ligneinfoperso">
                    <td>_________________</td>

                </tr>
            </tbody>
        </table>

    <br>
      <br>
    <table class="infoperso">
            <thead class="colonneinfoperso">
                <tr>
                    <th>charte utilisateur</th>


                </tr>

             <table class="infoperso">
            <thead class="colonneinfoperso">
                <tr>
                    <br>
                    <a href="newpasword.php">
                        <button class="change">changer de mot de passe</button>
                    </a>
                </tr>
            </thead>
        <thead class="colonneinfoperso">
                <tr>
                    <a href="newmail.php">
                        <button class="change">changer d' email</button>
                    </a>
                    <thead class="colonneinfoperso">
                </thead>
                    <a href="utils/disconnect.php">
                        <button type="button" class="change" action="utils/disconnect.php">déconnexion</button>
                    </a>
                </tr>
            </thead>
        </table>
            </thead>
        </table>

    <br>
      <br>

    </div>
    </span>



    <br>

    <script src="/assets/js/chat_box.js"></script>

    <?php
include 'partials/footer.php';
?>

</body>
</html>