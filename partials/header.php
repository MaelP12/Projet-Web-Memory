
<?php
    $current_page = dirname($_SERVER['PHP_SELF']) . '/' . basename($_SERVER['PHP_SELF']);
    
    

?>

<header>
<link rel="stylesheet" href="/assets/css/header.css">
  <div class="en-tete">
    <div class="en-tete-gauche">
      <li><a href="#"><strong>Capybara memory</strong></a></li>
    </div>
    <div class="en-tete-droit">
    <div class="colorbuttomheader">
      <li><a href="/index.php" class="boutonheader <?php echo ($current_page == '\/index.php') ? 'active' : ''; ?>"><strong>ACCUEIL</strong></a></li>
    </div>
    <div class="colorbuttomheader">
      <li><a href="/games/memory/score.php" class="boutonheader <?php echo ($current_page == '/games/memory/score.php') ? 'active' : ''; ?>"><div>SCORE</div></a></li>
    </div>
    <div class="colorbuttomheader">
      <li><a href="/games/memory/memori.php" class="boutonheader <?php echo ($current_page == '/games/memory/memori.php') ? 'active' : ''; ?>"><div>JEU</div></a></li>
    </div>
    <div class="colorbuttomheader">
      <li><a href="/mail.php" class="boutonheader <?php echo ($current_page == '\/mail.php') ? 'active' : ''; ?>"><div>NOUS CONTACTER</div></a></li>
    </div>
    <?php if (!isset($_SESSION['userId'])){ ?>
    <div class="colorbuttomheader">
      <li><a href="/login.php" class="boutonheader <?php echo ($current_page == '\/login.php') ? 'active' : ''; ?>"><div>CONNEXION</div></a></li>
    </div>
    <div class="colorbuttomheader">
      <li><a href="/sign.php" class="boutonheader <?php echo ($current_page == '\/sign.php') ? 'active' : ''; ?>">INSCRIPTION</a></li>
    </div>
      <?php }else { ?>
        <div class="colorbuttomheader">
      <li><a href="/account.php" class="boutonheader <?php echo ($current_page == '\/account.php') ? 'active' : ''; ?>"><div>COMPTES</div></a></li>
    </div>
    <?php } ?>
  </div>

  </div>
  <div class="text-de-parti">
    <h1>Capybara</h1>
  </div>

  <img src="/src/images/capybara.png" class="moving-capybara1" alt="Capybara" />
  <img src="/src/images/capybara2.png" class="moving-capybara2" alt="Capybara2" />

</header>