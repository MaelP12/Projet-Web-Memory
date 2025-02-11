<!DOCTYPE html>
<html lang="fr">

<?php
require '../../utils/database.php';
session_start();
$db = db_connect();

?>

<?php
$pageTitle = 'Capybara Score';
include '../../partials/head.php';
?>

<?php
include '../../partials/header.php';
?>



<body>




<div class="scorepage">
    <h3>Record personnel &#129338;</h3>
    <table class="scoreperso">
        <thead class="colonnescoreperso">
        <tr>
            <th>Nom du jeu</th>
            <th>Pseudo</th>
            <th>Niveau de difficulté</th>
            <th>Score</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Requête SQL avec jointures pour obtenir les noms des jeux, joueurs et niveaux de difficulté
        $req = $db->prepare("
            SELECT 
            jeux.nom_jeux,
            utilisateurs.pseudo AS player,
            difficulte.niveau AS niveau,
            score_jeux.score_jeux,
            score_jeux.date_jeux AS date
            FROM score_jeux
            JOIN utilisateurs ON score_jeux.id_player = utilisateurs.id
            JOIN jeux ON score_jeux.id_jeux = jeux.id
            JOIN difficulte ON score_jeux.id_difficulte = difficulte.id
            ORDER BY score_jeux
        ");

        $req->execute();


        while ($data = $req->fetch()) { ?>
            <tr class="lignescoreperso">
                <td><?php echo htmlspecialchars($data['nom_jeux']); ?></td>
                <td><?php echo htmlspecialchars($data['player']); ?></td>
                <td><?php echo htmlspecialchars($data['niveau']); ?></td>
                <td><?php echo htmlspecialchars($data['score_jeux']); ?></td>
                <td><?php echo htmlspecialchars($data['date']); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>



<span>
    <div class="scorepage">
        <h3>Record global &#127760</h3>
        <table class="scoreperso">
            <thead class="colonnescoreperso">
                <tr>

                    <th>Pseudo</th>
                    <th>Niveau de difficulté</th>
                    <th>Score</th>
                    <th>date</th>
                </tr>
            </thead>

            <?php

            $scoreglob = $db->prepare("
            SELECT 
            
            utilisateurs.pseudo AS player,
            difficulte.niveau AS niveau,
            score_jeux.score_jeux,
            score_jeux.date_jeux AS date
            FROM score_jeux
            JOIN utilisateurs ON score_jeux.id_player = utilisateurs.id
            JOIN jeux ON score_jeux.id_jeux = jeux.id
            JOIN difficulte ON score_jeux.id_difficulte = difficulte.id
            ORDER BY score_jeux
        ");

            $scoreglob->execute();


            while ($sc = $scoreglob->fetch()) { ?>
                <tr class="lignescoreperso">
                <td><?php echo htmlspecialchars($sc['niveau']); ?></td>
                <td><?php echo htmlspecialchars($sc['player']); ?></td>
                <td><?php echo htmlspecialchars($sc['score_jeux']); ?></td>
                <td><?php echo htmlspecialchars($sc['date']); ?></td>
            </tr>
            <?php } ?>


            </tbody>
        </table>

<span>
            <br>
            <br>
            <br>
            <br>
            <br>
        </span>
</div>
</span>

<?php
include '../../partials/footer.php';
?>
</body>
</html>
