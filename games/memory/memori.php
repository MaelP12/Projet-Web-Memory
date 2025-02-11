<!DOCTYPE html>
<html lang="fr">

<?php
require '../../utils/database.php';
session_start();

if (isset($_POST['message'])) {
    $message = $_POST['message'];
    echo''. $message .'';

    $sql = "INSERT INTO `message`( message , date_du_score, joueur_id)
    VALUES (? , ?, ?) ";
    $stmt= $db->prepare($sql);
    $stmt->execute([$message, date("Y/m/d h:i:s"),  $_SESSION['userId']]);
    header("Location: memori.php?message");
    exit();
}

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
$pageTitle = 'Memory Capybara';
include '../../partials/head.php';
?>

<?php
include '../../partials/header.php';
?>

<body>

<div class="page-container">



<div class="optionjeux">
    <div class="menu_deroulant_difficulte" >
        <select id="difficulte" class="dif" onchange="dif()">
        <option value="4x4" selected> 4 x 4 </option>
        <option value="8x8" > 8 x 8 </option>
        <option value="10x10" > 10 x 10 </option>
        </select>
    </div>

    <div class="menu_deroulant_theme" >
        <select id="theme" class="theme" onchange="gettheme()"> 
        <option value="theme1" selected> Capybara </option>
        <option value="theme2" > Lama </option>
        <option value="theme3" > Axolotl </option>
        </select>
    </div>
    <button class="bouton_lancement">Lancer la partie</button>
</div>
<!-- 
<button class="bonus">
    <i class="fa-solid fa-gift"></i>
</button> -->

<div class="test">
    <div class="chrono" id="chrono">  00:00:00</div>
</div>
    <button id="stopBtn">Arrêter</button>
    <button id="pop_up">pop-up fin de partie</button>
    <p id="score">Score :    00:00:00</p>

    <div id="popup" class="popup-overlay">
        <div class="popup-content">
            <h2>Fin de la partie</h2>
            <p>Bravo, voici votre Score :</p>
            <p id="popupScore">Score : 00:00:00</p>
            <button onclick="closePopup()">Fermer</button>
            <button id="rejouerBtn">Rejouer</button>
        </div>
    </div>

<div class="total">

</div>




</div>
<input type="checkbox" id="click">
<label for="click">
    <img src="../../src/images/logochatbox.png" style="height: 50px; width: auto;">
</label>

<div class="page">
    <div class="head-text">
        capybara - chatbox
    </div>

    <div class="chat-box">
    <div class="discussion">
        <?php
            $userConnected = 1;
        
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
        <!-- <div class="useronline">
            <p>mael</p>
            <div class="message">
            </div>

        </div>


        <div class="user">
            <p>Coucou, en effet, ça fait longtemps, je vais super et j'espère que pour toi aussi. Non le memory je galère honnetement</p>
        </div> -->
    </div>
    <form action="memori.php" method="POST">
      <div class="field">
        <textarea rows="5" cols="5" name="message" placeholder="Entrez votre message"></textarea>
      </div>
      <div class="field">
        <button id="mess" type="submit">Envoyer</button>
      </div>
    </form>
  </div>
</div>

<div class="page-container">

<?php
//if (!isset($_SESSION['userId'])){
//
//}
//?>









<div class="not_conect">
    <p>connecter vous pour jouer</p>
</div>


<div class="total">

</div>









<?php
include '../../partials/footer.php';
?>
</div>
<script src="../../assets/js/memory.js"></script>
</body>
</html>