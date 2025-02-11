function checkPasswordStrength() {
    const password = document.getElementById('password').value;
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');

    let strength = 0;

    // Conditions pour la force du mot de passe
    if (password.length >= 8) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;

    // Mise à jour de la barre de force
    switch (strength) {
        case 1:
            strengthBar.style.width = '33%'; // update de la largeur de la barre
            strengthBar.style.backgroundColor = 'red'; // update de la couleur de la barre
            strengthText.textContent = 'Mot de passe faible'; // update du texte en dessous de la barre
            break;
        case 2:
            strengthBar.style.width = '66%';
            strengthBar.style.backgroundColor = "orange";
            strengthText.textContent = 'Mot de passe moyen';
            break;
        case 3:
            strengthBar.style.width = '100%';
            strengthBar.style.backgroundColor = 'green';
            strengthText.textContent = 'Mot de passe fort';
            break;
        default:
            strengthBar.style.width = '30%';
            strengthText.textContent = 'Mot de passe faible';
            strengthBar.style.backgroundColor = 'red';
    }
}