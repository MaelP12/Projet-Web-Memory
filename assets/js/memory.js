
let bouton = document.querySelector(".bouton_lancement")
let startTime = Date.now();
let timerInterval; // Déclare ici pour qu'il soit accessible partout
let isRunning = false; // Variable pour suivre si le chronomètre fonctionne
let lastElapsedTime = 0; // Variable pour stocker le dernier temps écoulé
var choixDifficulte; // Variable global pout le choix de la difficulte
var page = document.querySelector(".page-container")
let bonus = document.querySelector(".bonus")
var cartes =[]

//si le bouton lancement de partie est appuyer appel de mes fonctions
bouton.addEventListener('click', () => {
        let taille = dif()
        let theme = gettheme()
        creation(taille, theme)
});

function creation(taille, theme){
    console.log(theme)
    console.log(taille)
    var total = document.querySelector(".total") //ma div ou est mis toutes les cartes
    var capybaras = []
    var carte_capybaras = []
    var cartesd //dos des cartes
    var cartesf //faces des cartes
    var taille2 = (taille*taille) //4->16
    var taille3 = taille2/2 //4->8 
    var carteretourne = [] //mes paires retourner
    var victoire = 0
    total.innerHTML = "";
    // créer une liste avec 50 id
    for (i=1; i<51; i++){
        capybaras.push(i)
    }
    // pioche dans ma liste d'id
    function getRandomInt(max) {
        return Math.floor(Math.random() * max);
    }
    // créer mes paires de cartes piocher grace a ma liste d'id
    for (i=0; i<taille3; i++){
        aleatoire = getRandomInt(capybaras.length)
        carte_choisi = capybaras[aleatoire]
        
        carte_capybaras.push(carte_choisi)
        carte_capybaras.push(carte_choisi)
        capybaras.splice(aleatoire, 1)
    }
    // mélange toute mes paires
    shuffle(carte_capybaras);
    function shuffle(array) {
        let currentIndex = array.length;
        while (currentIndex != 0) {
        let randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex--;
        [array[currentIndex], array[randomIndex]] = [
            array[randomIndex], array[currentIndex]];
        }
    }
    //création de toute mes div 
    for (i=0; i<taille2; i++) {
        var carte = document.createElement('div');
        carte.className = "carte";

        //dos de la carte s'adapte au theme choisi
        cartesd = document.createElement('div');
        cartesd.innerHTML= `<img src="../../assets/image/carte_${theme}.png" height=160px width=130px></img>` 
        cartesd.className = "dos"
        carte.appendChild(cartesd)

        //face de la carte s'adapte au theme choisi
        cartesf = document.createElement('div');
        carte.data_id = carte_capybaras[i]
        cartesf.innerHTML= `<img src="../../assets/image/${theme}/${theme}${carte_capybaras[i]}.png" height=200px width=auto></img>` 
        cartesf.className = "face"
        carte.appendChild(cartesf)

        //ajout de ma div carte dans le total
        total.appendChild(carte)

        //ajout l'évenement cliquable sur chaque carte
        carte.addEventListener('click', flipcard);
    }
    
    //permet de revenir a la ligne en fonction de la taille
    total.style.gridTemplateColumns = `repeat(${taille}, auto)`;

    //adapte la taille de la page pour faciliter le jeux
    if (taille ==   4){
        page.style.width = "40%"
    }
    if(taille == 8){
        page.style.width = "80%"
    }
    if(taille == 10){
        page.style.width = "100%"
    }

    //fonction pour retourner mes cartes
    function flipcard() {
        if (!isRunning) {
            startChrono();
            isRunning = true;
        }

        if (!isRunning) {
            startChrono();
            isRunning = true;
        }

        //mes conditions pour le non retournement des cartes
        if (this.classList.contains('trouve') || carteretourne.includes(this) || carteretourne.length>=2) return;
        // retourne la carte
        this.classList.toggle('flipped');
        // carteretourne qui stocke mes 2 derniere cartes retourner
        carteretourne.push(this)
        console.log(carteretourne)

        if (carteretourne.length==2){
            const [carte1, carte2] = carteretourne;
            var id1 = carte1.data_id
            var id2 = carte2.data_id
        
            console.log(victoire)
            //si les 2 cartes retourner sont différentes on les retourne avec un délai
            if (id1!==id2){
                setTimeout(() => {
                carte1.classList.toggle('flipped')
                carte2.classList.toggle('flipped')
                },500)
            }
            //si les 2 cartes sont valide on empeche le faite de les retourner a nouveau
            else{
                carte1.classList.add('trouve')
                carte2.classList.add('trouve')
                victoire++
            }
            carteretourne=[]

        }
        //condition de victoire si toutes les pairs sont retournés 
        if (victoire === (taille * taille) / 2) { // Assurez-vous que taille est bien utilisé ici et pas taille_
            stopChrono(); // Arrête le chrono
            showPopup();  // Affiche le popup de victoire

    }
}

}


function startChrono() {
startTime = Date.now();
timerInterval = setInterval(updateChrono, 1000); // Met à jour toutes les secondes
}

function showPopup() {
document.getElementById("popup").style.display = "flex"; // Assurez-vous que "popup" est bien l'ID de votre popup dans le HTML
}
function closePopup() {
document.getElementById("popup").style.display = "none";
}
document.querySelector(".popup-overlay button").addEventListener("click", closePopup);


bonus.addEventListener('click', retournement)
function retournement() {
    // for (i=0; i<taille2; i++) {
    //     cartes[i].classList.toggle('flipped')
    // }    

    cartes.forEach(carte => {
        carte.classList.toggle('flipped');
    });
}

//ma fonction pour récupérer la difficulté saisie par l'utilisateur
function dif () {
    // var grilles = document.getby(.total)
    let difficulte = document.getElementById("difficulte").value 
    var taille 
    switch (difficulte) {
        case "4x4":
            taille = 4
            break
        case "8x8": 
            taille = 8
            break
        case "10x10":
            taille = 10
            break
    }
    return taille
}

//ma fonction pour récupérer les themes saisie par l'utilisateur
function gettheme () {
    
    let themes = document.getElementById("theme").value 
    let theme 
    switch (themes) {
        case "theme1":
            theme = "capybara"
            break
        case "theme3":
            theme = "axolotl"
            break
        case "theme2":
            theme = "lama"
            break
    }
    return theme
}

/* chrono */

function updateChrono() {
    const now = Date.now();
    const elapsedTime = now - startTime;

    const hours = Math.floor(elapsedTime / (1000 * 60 * 60));
    const minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);

    document.getElementById("chrono").textContent =
        "   " + String(hours).padStart(2, '0') + ":" +
        String(minutes).padStart(2, '0') + ":" +
        String(seconds).padStart(2, '0');
}

/* permet d'afficher la valeur en alerte */

function formatElapsedTime(elapsedTime) {
    const hours = Math.floor(elapsedTime / (1000 * 60 * 60));
    const minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);


    return (
        "   " + String(hours).padStart(2, '0') + ":" +
        String(minutes).padStart(2, '0') + ":" +
        String(seconds).padStart(2, '0')

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
        document.getElementById("popupScore").textContent = "Score : " + formattedTime; // Mettre à jour le score dans le popup
        isRunning = false;

        // Envoi du score par AJAX
        ajaxPost({
            score: formattedTime,
            difficulte: choixDifficulte
        });
    } else {
        startTime = Date.now() - lastElapsedTime;
        timerInterval = setInterval(updateChrono, 1000); // Démarre l'intervalle
        document.getElementById("stopBtn").textContent = "Arrêter";
        isRunning = true;
    }
}

function ajaxPost(postData) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/ajax/saveScore.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                console.log(data);
            } else {
                console.error("Erreur AJAX :", xhr.status, xhr.statusText);
            }
        }
    };

    xhr.send(JSON.stringify(postData));
}

document.getElementById("stopBtn").addEventListener("click", stopChrono);

document.getElementById('pop_up').addEventListener('click', function() {
    document.getElementById('popup').style.display = 'flex';
});

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

document.getElementById("rejouerBtn").addEventListener("click", function () {
    closePopup(); // Ferme le popup
    resetGame();  // Réinitialise le jeu
});

function resetGame() {
    isRunning = false; // Réinitialise l'état du chronomètre
    lastElapsedTime = 0; // Réinitialise le temps écoulé
    document.getElementById("chrono").textContent = "  00:00:00"; // Réinitialise le chrono
    document.getElementById("score").textContent = "Score :    00:00:00"; // Réinitialise le score

    let taille = dif(); // Récupère la difficulté sélectionnée
    creation(taille); // Relance la création de la grille
}