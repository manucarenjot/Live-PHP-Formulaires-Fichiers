let password = document.getElementById("id-password");
let passwordConfirm = document.getElementById("id-password-repeat");

/**
 * Check the validity between the two user provided passwords.
 */
function checkPassword(){
    if(password.value !== passwordConfirm.value) {
        // Si les deux valeurs sont différentes, alors on envoie pas le formulaire !
        passwordConfirm.setCustomValidity("Les mots de passe ne correspondent pas !");
    }
    else {
        // On retire l'avertissement, le formulaire peut à nouveau être envoyé !
        passwordConfirm.setCustomValidity('');
    }
}

password.addEventListener('change', checkPassword);
passwordConfirm.addEventListener('keyup', checkPassword);



