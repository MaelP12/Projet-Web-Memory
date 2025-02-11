let startTime = Date.now();
let timerInterval; // Déclare ici pour qu'il soit accessible partout
let isRunning = true; // Variable pour suivre si le chronomètre fonctionne
let lastElapsedTime = 0; // Variable pour stocker le dernier temps écoulé

/* chrono */

function updateChrono() {
    const now = Date.now();
    const elapsedTime = now - startTime;

    const hours = Math.floor(elapsedTime / (1000 * 60 * 60));
    const minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);
    const milliseconds = elapsedTime % 1000;

    document.getElementById("chrono").textContent =
        String(hours).padStart(2, '0') + ":" +
        String(minutes).padStart(2, '0') + ":" +
        String(seconds).padStart(2, '0') + ":" +
        String(milliseconds).padStart(3, '0');
}

/* permet d'afficher la valeur en alerte */

function formatElapsedTime(elapsedTime) {
    const hours = Math.floor(elapsedTime / (1000 * 60 * 60));
    const minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);
    const milliseconds = elapsedTime % 1000;

    return (
        String(hours).padStart(2, '0') + ":" +
        String(minutes).padStart(2, '0') + ":" +
        String(seconds).padStart(2, '0') + ":" +
        String(milliseconds).padStart(3, '0')
    );
}

/* stop chrono - reprendre */

function stopChrono() {
    var formattedTime;

    if (isRunning) {
        clearInterval(timerInterval); // Arrêter le chronomètre
        lastElapsedTime = Date.now() - startTime; // Enregistrer le temps écoulé
        formattedTime = formatElapsedTime(lastElapsedTime);
        document.getElementById("score").textContent = "Score : " + formattedTime; // Mettre à jour l'affichage du score
        document.getElementById("stopBtn").textContent = "Reprendre"; // Changer le texte du bouton
        isRunning = false; // Mettre à jour l'état pour indiquer que le chrono est arrêté

        ajaxPost({
            score: formattedTime
        })
    } else {
        startTime = Date.now() - lastElapsedTime;
        timerInterval = setInterval(updateChrono, 10);
        document.getElementById("stopBtn").textContent = "Arrêter";
        isRunning = true;
    }
}

function ajaxPost(postData) {
    // Créer un objet XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Ouvrir une connexion POST vers une URL spécifique
    xhr.open("POST", "/ajax/saveScore.php", true);

    // Définir le type de contenu envoyé
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    // Définir ce qui doit se passer lorsque la réponse est prête
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Traiter la réponse JSON
            var data = JSON.parse(xhr.responseText);
            console.log(data); // Afficher les données de la réponse
        }
    };

    // Envoyer la requête avec les données en JSON
    xhr.send(JSON.stringify(postData));
}


timerInterval = setInterval(updateChrono, 10);

document.getElementById("stopBtn").addEventListener("click", stopChrono);

