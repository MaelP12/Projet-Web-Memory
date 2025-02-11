CREATE TABLE utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT, 
    email VARCHAR(100) UNIQUE NOT NULL,
    prenom VARCHAR(50) NOT NULL, 
    nom VARCHAR(50) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    pseudo VARCHAR(50) NOT NULL,
    date_heure_inscription DATETIME , 
    date_heure_derniere_connexion DATETIME
);

CREATE TABLE jeux ( 
    id INT PRIMARY KEY AUTO_INCREMENT, 
    nom_jeux VARCHAR(200) NOT NULL 
);

CREATE TABLE difficulte (
    id INT PRIMARY KEY AUTO_INCREMENT,
    niveau INT(2) NOT NULL,
    jeux_id INT,
    FOREIGN KEY (jeux_id) REFERENCES jeux(id)
);

CREATE TABLE score_jeux (
    id INT PRIMARY KEY AUTO_INCREMENT, 
    score_jeux TIME NOT NULL,
    date_jeux DATE NOT NULL,
    id_player INT,
    id_jeux INT,
    id_difficulte INT,
    FOREIGN KEY (id_player) REFERENCES utilisateurs(id),
    FOREIGN KEY (id_jeux) REFERENCES jeux(id)
    FOREIGN KEY (id_difficulte) REFERENCES difficulte(id)
); 

CREATE TABLE message (
    id INT PRIMARY KEY AUTO_INCREMENT,
    message VARCHAR(1000),
    date_du_message DATETIME,
    jeux_id INT,
    joueur_id INT,
    FOREIGN KEY (joueur_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (jeux_id) REFERENCES jeux(id)
);

INSERT INTO `utilisateurs`(`id`, `email`, `prenom`, `nom`, `mot_de_passe`, `pseudo`, `date_heure_inscription`, `date_heure_derniere_connexion`)
VALUES
('1','utilisateur1@example.com', 'Alice', 'Dupont', 'mdpAlice123', 'aliceD', NOW(), NOW()),
('2','utilisateur2@example.com', 'Bob', 'Martin', 'mdpBob456', 'bobM', NOW(), NOW()),
('3','utilisateur3@example.com', 'Charlie', 'Durand', 'mdpCharlie789', 'charlieD', NOW(), NOW()),
('4','utilisateur4@example.com', 'David', 'Petit', 'mdpDavid101', 'davidP', NOW(), NOW()),
('5','utilisateur5@example.com', 'Eva', 'Lemoine', 'mdpEva112', 'evaL', NOW(), NOW());

INSERT INTO `jeux`(`id`,`nom_jeux`)
VALUES
('1','capybara'),
('2','capybara2');

INSERT INTO `score_jeux`(`id`, `id_jeux`, `id_player`, `id_difficulte`, `score_time`)
VALUES ('1','2','2','1','00:00:45'),
('2','2','3','3','00:04:52'),
('3','3','4','2','00:01:45'),
('4','3','5','1','00:01:23'),
('5','2','6','3','00:08:01')
('5','00:00:58','2024-10-27','5','2');

INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('Salut tout le monde!', '2024-10-30 09:15:00', 1, 1);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('Comment ça va?', '2024-10-31 11:45:00', 1, 2);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ("Superbe journée aujourd'hui!", '2024-11-01 08:30:00', 1, 3);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ("Prêt pour l'aventure!", '2024-11-02 14:10:00', 1, 4);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('Vive le week-end!', '2024-11-03 19:00:00', 1, 5);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('YOOOOOOOOOOOOOOOOOO', '2024-11-04 16:45:00', 1, 1);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('En plein travail...', '2024-11-05 10:20:00', 1, 2);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('Un bon café pour commencer la journée', '2024-11-06 07:50:00', 1, 3);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('Le projet avance bien!', '2024-11-07 13:35:00', 1, 4);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('Presque le week-end!', '2024-11-08 18:10:00', 1, 5);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('En route pour de nouvelles aventures!', '2024-11-09 09:25:00', 1, 1);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('Bon dimanche à tous!', '2024-11-10 11:00:00', 1, 2);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ("C'est l'heure du sport!", '2024-11-11 15:45:00', 1, 3);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('Peu de travail cette semaine!', '2024-11-12 12:30:00', 1, 4);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('Petit moment de détente...', '2024-11-13 19:50:00', 1, 5);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('Salut les amis!', '2024-11-14 08:05:00', 1, 1);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('Le soleil brille!', '2024-11-15 14:25:00', 1, 2);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('De retour au travail!', '2024-11-16 10:15:00', 1, 3);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('Enfin terminé!', '2024-11-17 17:30:00', 1, 4);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('Rendez-vous avec des amis ce soir!', '2024-11-18 20:45:00', 1, 5);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ("C'était une journée bien remplie", '2024-11-19 21:20:00', 1, 1);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('Bonne nuit à tous!', '2024-11-20 22:00:00', 1, 2);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ("Je me sens plein d'énergie!", '2024-11-21 06:30:00', 1, 3);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('Prêt pour le prochain défi!', '2024-11-22 13:55:00', 1, 4);
INSERT INTO `message`(`message`, `date_du_score`, `jeux_id`, `joueur_id`) VALUES ('À demain tout le monde!', '2024-11-23 23:10:00', 1, 5);


-----story 4
UPDATE `utilisateurs`
SET `mot_de_passe` = ''
WHERE id = ;

UPDATE `utilisateurs`
SET `email`=''
WHERE id =  AND `mot_de_passe` = '';

UPDATE `utilisateurs`
SET `email`='bobby@gmail.com'
WHERE id = 3 AND `mot_de_passe` = 'mdpBob456';


---story 5

SELECT pseudo
FROM `utilisateurs`
WHERE `email`='' AND `mot_de_passe`=''

SELECT pseudo
FROM `utilisateurs`
WHERE `email`='utilisateur3@example.com' AND `mot_de_passe`='mdpCharlie789'

--story 7 8 9
SELECT score_time, utilisateurs.pseudo, jeux.nom_jeux, difficulte.niveau
FROM score_jeux

JOIN utilisateurs ON score_jeux.id_player= utilisateurs.id
JOIN jeux ON score_jeux.id_jeux = jeux.id
JOIN difficulte ON score_jeux.id_difficulte = difficulte.id

ORDER BY jeux.nom_jeux ASC




--selection meilleur score  story 12
SELECT utilisateurs.pseudo, score_jeux.score_jeux
FROM score_jeux
JOIN utilisateurs ON score_jeux.id_player = utilisateurs.id
WHERE utilisateurs.pseudo = 'aliceD'
ORDER BY score_jeux.score_jeux;








--selection score generale  story 18 coriger
SELECT 
    stats_par_jeu.Annee,
    stats_par_jeu.Mois,
    stats_par_jeu.Jeu_le_plus_joue,
    stats_par_jeu.Total_parties,
    SEC_TO_TIME(stats_par_jeu.AVG_Score_moyen) AS Score_moyen
FROM (
    SELECT 
        YEAR(score_jeux.date_jeux) AS Annee,
        MONTH(score_jeux.date_jeux) AS Mois,
        jeux.nom_jeux AS Jeu_le_plus_joue,
        COUNT(score_jeux.id) AS Total_parties,
        AVG(TIME_TO_SEC(score_jeux.score_jeux)) AS AVG_Score_moyen
    FROM 
        score_jeux
    JOIN 
        utilisateurs ON score_jeux.id_player = utilisateurs.id
    JOIN 
        jeux ON score_jeux.id_jeux = jeux.id
    WHERE 
        utilisateurs.pseudo = 'aliceD'
        AND YEAR(score_jeux.date_jeux) = 2023
    GROUP BY 
        Annee, Mois, jeux.nom_jeux
) AS stats_par_jeu
JOIN (
    SELECT 
        Annee,
        Mois,
        MAX(Total_parties) AS Max_total_parties
    FROM (
        SELECT 
            YEAR(score_jeux.date_jeux) AS Annee,
            MONTH(score_jeux.date_jeux) AS Mois,
            jeux.nom_jeux AS Jeu_le_plus_joue,
            COUNT(score_jeux.id) AS Total_parties
        FROM 
            score_jeux
        JOIN 
            utilisateurs ON score_jeux.id_player = utilisateurs.id
        JOIN 
            jeux ON score_jeux.id_jeux = jeux.id
        WHERE 
            utilisateurs.pseudo = 'aliceD'
            AND YEAR(score_jeux.date_jeux) = 2023
        GROUP BY 
            Annee, Mois, jeux.nom_jeux
    ) AS total_par_jeu
    GROUP BY 
        Annee, Mois
) AS max_parties_par_mois 
ON stats_par_jeu.Annee = max_parties_par_mois.Annee
   AND stats_par_jeu.Mois = max_parties_par_mois.Mois
   AND stats_par_jeu.Total_parties = max_parties_par_mois.Max_total_parties
ORDER BY 
    stats_par_jeu.Mois;







--selection score generale  story 17 a coriger
SELECT
    stats_par_jeu.Annee,
    stats_par_jeu.Mois,
    
    (SELECT utilisateurs.pseudo
     FROM utilisateurs
     JOIN score_jeux ON utilisateurs.id = score_jeux.id_player
     WHERE YEAR(score_jeux.date_jeux) = 2024
     AND MONTH (score_jeux.date_jeux) = stats_par_jeu.Mois
     ORDER BY score_jeux.score_jeux
     LIMIT 1 OFFSET 0) AS top_1,
     
     (SELECT utilisateurs.pseudo
     FROM utilisateurs
     JOIN score_jeux ON utilisateurs.id = score_jeux.id_player
     WHERE YEAR(score_jeux.date_jeux) = 2024
     AND MONTH (score_jeux.date_jeux) = stats_par_jeu.Mois
     ORDER BY score_jeux.score_jeux
     LIMIT 1 OFFSET 1) AS top_1,
     
     (SELECT utilisateurs.pseudo
     FROM utilisateurs
     JOIN score_jeux ON utilisateurs.id = score_jeux.id_player
     WHERE YEAR(score_jeux.date_jeux) = 2024
     AND MONTH (score_jeux.date_jeux) = stats_par_jeu.Mois
     ORDER BY score_jeux.score_jeux
     LIMIT 1 OFFSET 2) AS top_1,

    stats_par_jeu.Total_parties,
    stats_par_jeu.Jeu_le_plus_joue
    
FROM
    (
    SELECT
        YEAR(score_jeux.date_jeux) AS Annee,
        MONTH(score_jeux.date_jeux) AS Mois,
        jeux.nom_jeux AS Jeu_le_plus_joue,
        COUNT(score_jeux.id) AS Total_parties
    FROM
        score_jeux
    JOIN jeux ON score_jeux.id_jeux = jeux.id
    WHERE
        YEAR(score_jeux.date_jeux) = 2024
    GROUP BY
        Annee,
        Mois,
        jeux.nom_jeux
) AS stats_par_jeu
JOIN(
    SELECT
        Annee,
        Mois,
        MAX(Total_parties) AS Max_total_parties
    FROM
        (
        SELECT
            YEAR(score_jeux.date_jeux) AS Annee,
            MONTH(score_jeux.date_jeux) AS Mois,
            jeux.nom_jeux AS Jeu_le_plus_joue,
            COUNT(score_jeux.id) AS Total_parties
        FROM
            score_jeux
        JOIN jeux ON score_jeux.id_jeux = jeux.id
        WHERE
            YEAR(score_jeux.date_jeux) = 2024
        GROUP BY
            Annee,
            Mois,
            jeux.nom_jeux
    ) AS total_par_jeu
GROUP BY
    Annee,
    Mois
) AS max_parties_par_mois



ON
    stats_par_jeu.Annee = max_parties_par_mois.Annee AND stats_par_jeu.Mois = max_parties_par_mois.Mois AND stats_par_jeu.Total_parties = max_parties_par_mois.Max_total_parties
    

ORDER BY
    stats_par_jeu.Annee,
    stats_par_jeu.Mois;