<head>

    <meta charset="UTF-8">
    <link rel="shortcut icon" href="#">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Mon Site Web'; ?></title>
    <script src="https://kit.fontawesome.com/c7f93c70ed.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pop-Up Chat Box UI Design</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <?php
    
    if ($pageTitle == 'Accueil') {
        
        ?>
        <link rel="stylesheet" href="assets/css/pagedaccueil.css">
        <?php
    }
    elseif ($pageTitle == 'contacte') {
        
        ?>
        <link rel="stylesheet" href="assets/css/noucontacter.css">
        <?php
    }
    elseif ($pageTitle == 'Connexion') {
        
        ?>
        <link rel="stylesheet" href="assets/css/styleariela.css">
        <?php
    }
    elseif ($pageTitle == 'Inscription') {
        
        ?>
        <link rel="stylesheet" href="assets/css/styleariela.css">
        <?php
    }
    elseif ($pageTitle == 'COMPTES') {
        
        ?>
        <link rel="stylesheet" href="/assets/css/stylethim.css">
        <?php
    }
    elseif ($pageTitle == 'Capybara Score') {
        
        ?>
        <link rel="stylesheet" href="../../assets/css/stylethim.css">
        <?php
    }
    elseif ($pageTitle == 'Memory Capybara') {
        
        ?>
        <link rel="stylesheet" href="../../assets/css/memoriC.css">
        <?php
    }elseif ($pageTitle == 'Changer mot de passe') {

        ?>
        <link rel="stylesheet" href="assets/css/styleariela.css">
        <?php
    }elseif ($pageTitle == 'Changer e-mail') {

        ?>
        <link rel="stylesheet" href="assets/css/styleariela.css">
        <?php
    }
?>
    

</head>