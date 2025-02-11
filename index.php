<!doctype html>
<html lang="fr">

<?php
/*
require 'utils/database.php';




$sql = "INSERT INTO `utilisateurs`( `email`, `prenom`, `nom`, `mot_de_passe`, `pseudo`)
VALUES (? , ? , ? , ?, ?) ";
//$stmt= $db->prepare($sql);
//$stmt->execute(['utilisateur10@example.com', 'Alice', 'Dupont', 'mdpAlice123', 'aliceD90']);

$sql = "SELECT * FROM `utilisateurs`";
$stmt= $db->prepare($sql);
$stmt->execute();

var_dump($stmt->fetch());die;
*/
?>


<?php
require 'utils/database.php';
session_start();
$db = db_connect();






$pseudo = 'evaL';

try {

  $sql = "
  SELECT 
      COUNT(DISTINCT utilisateurs.id) AS cont,
      COUNT(CASE WHEN utilisateurs.pseudo = :pseudo THEN score_jeux.id END) AS contpart,
      MIN(CASE WHEN utilisateurs.pseudo = :pseudo THEN score_jeux.score_jeux END) AS besttime
  FROM utilisateurs
  LEFT JOIN score_jeux ON score_jeux.id_player = utilisateurs.id
";

// Préparation de la requête
$stmt = $db->prepare($sql);
    
// Liaison du paramètre :pseudo avec la variable $pseudo
$stmt->bindParam(':pseudo', $pseudo);

// Exécution de la requête
$stmt->execute();

// Récupération du résultat
$result = $stmt->fetch(PDO::FETCH_ASSOC);


    
}catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}
?>

<?php
$pageTitle = 'Accueil';
include 'partials/head.php';
?>

<?php
include 'partials/header.php';
?>

<body>



<div class="capybara_zone">
  <div class="capybara zero"><img src="assets/images/capybara.png" height="100" width="auto"></div>
  <div class="capybara one"><img src="assets/images/capybara.png" height="100" width="auto"></div>
  <div class="capybara two"><img src="assets/images/capybara.png" height="100" width="auto"></div>
  <div class="capybara three"><img src="assets/images/capybara.png" height="100" width="auto"></div>
  <div class="capybara four"><img src="assets/images/capybara.png" height="100" width="auto"></div>
  <div class="capybara five"><img src="assets/images/capybara.png" height="100" width="auto"></div>
  <div class="capybara six"><img src="assets/images/capybara.png" height="100" width="auto"></div>
  <div class="capybara seven"><img src="assets/images/capybara.png" height="100" width="auto"></div>
  <div class="capybara height"><img src="assets/images/capybara.png" height="100" width="auto"></div>
  <div class="capybara nine"><img src="assets/images/capybara.png" height="100" width="auto"></div>
</div>



<div id="main" class="pagedaccueil">

    <div class="description">
      <div class="item one">
        <figure  class="reflexion">
            <img id="refle" src="assets/images/reflexion.png" height="300" width="auto">
        </figure>
        <span class="texte one"><img src="assets/images/puces1.png" height="40" width="auto"> <p>Amusez-vous seul, avec les membres de votre famille ou entre amis, et vivez des moments inoubliables ! Relevez des défis passionnants, et tentez de surpasser vos propres records pour devenir un véritable champion.</p></span>
      </div>
      <div class="item two">
        <figure>
          <img src="assets/images/memory_jeux.jpg" height="300" width="auto">
        </figure>
        <span class="texte"><img src="assets/images/puces2.png" height="40" width="auto"><p>Exercez votre mémoire à travers des défis captivants et stimulez votre esprit pour atteindre l’excellence. Plus vous jouez, plus vous renforcez vos capacités cognitives, jusqu'à devenir imbattable !</p></span>
      </div>
      <div class="item three">
        <figure>
          <img src="assets/images/capybara5.jpg" height="300" width="auto">
        </figure>
        <span class="texte"><img src="assets/images/puces3.png" height="40" width="auto"><p>Plongez dans ce jeu de memory unique en son genre, inspiré par le monde des capybaras. Découvrez un univers charmant et amusant la douceur de ces adorables créatures seront au rendez-vous.</p></span>
      </div>
    </div>


  <div class="stats">
    <div class = "images_stats">
      <img src="https://rachelcorbett.com.au/wp-content/uploads/2020/10/Podcast-stats-explainer.jpg" height="auto" width="300">
    </div>
    <div class = "info">
      <div class="elements">

        <p class="pp"> <?php echo $result['contpart']; ?> <br> Partis Jouées</p>
      </div>
      <div class="elements">
        <p class="pp"> 1 <br> Joueurs Connectée </p>
      </div>
      <div class="elements">
        <p class="pp"> <?php echo $result['besttime']; ?> <br> Temps Record</p>
      </div>
      <div class="elements">
        <p class="pp"> <?php echo $result['cont']; ?> <br>  Joueurs Inscrits</p>
      </div>
    </div>
  </div>

  <p class="titre_équipe">Notre Equipe</p>
  <div class="notre_equipe">
    <div class="membres">
      <div class="centre">
        <div class="images capy2">
          <img src="assets/images/capybara2.jpg" height="auto" width="200">
        </div>
        <div class="nom">
          <p>Florian</p>
        </div>
        <div class="role">
          <p>Developer</p>
        </div>
        <div class="reseau">
          <div>
            <a href="https://www.facebook.com" target="_blank">
              <i class="fa-brands fa-facebook"></i>
            </a>
          </div>
          <div>
            <a href="https://www.facebook.com" target="_blank">
              <i class="fa-brands fa-twitter"></i>
            </a>
          </div>
          <div>
            <a href="https://www.facebook.com" target="_blank">
              <i class="fa-brands fa-pinterest"></i>
            </a>
          </div>
        </div>
      </div>

    </div>
    <div class="membres">
      <div class="images capy1">
        <img src="assets/images/capybara1.jpg" height="200" width="auto">
      </div>
      <div class="nom">
        <p>Thiméo</p>
      </div>
      <div class="role">
        <p>Developer</p>
      </div>
      <div class="reseau">
        <div>
          <a href="https://www.facebook.com" target="_blank">
            <i class="fa-brands fa-facebook"></i>
          </a>
        </div>
        <div>
          <a href="https://www.facebook.com" target="_blank">
            <i class="fa-brands fa-twitter"></i>
          </a>
        </div>
        <div>
          <a href="https://www.facebook.com" target="_blank">
            <i class="fa-brands fa-pinterest"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="membres">
      <div class="images capy4">
        <img src="assets/images/capybara4.jpg" height="200" width="auto">
      </div>
      <div class="nom">
        <p>Ariela</p>
      </div>
      <div class="role">
        <p>Developer</p>
      </div>
      <div class="reseau">
        <div>
          <a href="https://www.facebook.com" target="_blank">
            <i class="fa-brands fa-facebook"></i>
          </a>
        </div>
        <div>
          <a href="https://www.facebook.com" target="_blank">
            <i class="fa-brands fa-twitter"></i>
          </a>
        </div>
        <div>
          <a href="https://www.facebook.com" target="_blank">
            <i class="fa-brands fa-pinterest"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="membres">
      <div class="images capy3">
        <img src="assets/images/capybara3.jpg" height="200" width="auto">
      </div>
      <div class="nom">
        <p>Mael</p>
      </div>
      <div class="role">
        <p>Scrum Master</p>
      </div>
      <div class="reseau">
        <div>
          <a href="https://www.facebook.com" target="_blank">
            <i class="fa-brands fa-facebook"></i>
          </a>
        </div>
        <div>
          <a href="lama.html" target="_blank">
            <i class="fa-brands fa-twitter"></i>
          </a>
        </div>
        <div>
          <a href="https://www.facebook.com" target="_blank">
            <i class="fa-brands fa-pinterest"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include 'partials/footer.php';
?>
</body>
</html>
