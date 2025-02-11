function refreshContent() {
    // Envoie une requête GET avec fetch
    fetch("../../account.php")
        .then(response => {
            // Vérifie si la réponse est réussie
            if (!response.ok) {
                throw new Error("Erreur réseau");
            }
            return response.text(); 
        })
        .then(data => {
            // Parse le HTML reçu pour pouvoir en extraire des éléments spécifiques
            const parser = new DOMParser();
            const doc = parser.parseFromString(data, "text/html");
            
            // Sélectionne uniquement la div avec l'ID discussion
            const discussionContent = doc.querySelector("#discussion");
            
            // Vérifie si la div a été trouvée, puis met à jour la page avec son contenu
            if (discussionContent) {
                document.getElementById("discussion").innerHTML = discussionContent.innerHTML;
            } else {
                console.error("La div #discussion n'a pas été trouvée dans la réponse.");
            }
        })
        .catch(error => console.error("Erreur :", error));
}








function submitMessage() {
    const message = document.querySelector("textarea[name='message']").value.trim();
    if (!message) {
        console.log("Le champ de message est vide.");
        return; // Sortie si le message est vide
    }

    // Créez explicitement un nouvel objet FormData avec seulement le champ 'message'
    const formData = new FormData();
    formData.append("message", message);

    // Envoi de la requête POST via Fetch
    fetch("utils/test.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log("Message envoyé", data);
        document.querySelector("textarea[name='message']").value = ""; // Efface le champ de message
        refreshContent(); // Rafraîchit la boîte de messages
    })
    .catch(error => console.error("Erreur lors de l'envoi du message:", error));
}






