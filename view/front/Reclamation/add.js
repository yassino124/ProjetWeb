function verif() {
    var nom = document.getElementById('nom').value.trim();
    var email = document.getElementById('email').value.trim();
    var tel = document.getElementById('tel').value;
    var commentaire = document.getElementById('commentaire').value.trim();

    var error = "";

    if (nom === "") {
        error += "Please enter your name.\n";
    }

    if (email === "") {
        error += "Please enter your email address.\n";
    } else if (!isValidEmail(email)) {
        error += "Please enter a valid email address.\n";
    }

    if (tel == "") {
        error += "Please enter a valid phone number.\n";
    }

    if (commentaire === "") {
        error += "Please enter your comment.\n";
    }

    if (error !== "") {
        alert(error);
        return false;
    }

    return true; 
}

function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
document.getElementById('form-submit').addEventListener('click', function() {
    // Masquer le formulaire
    document.getElementById('reclamation-form').style.display = 'none';
    // Afficher le message de remerciement
    document.getElementById('thank-you-message').style.display = 'block';
});