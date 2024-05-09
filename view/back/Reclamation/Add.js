// Fonction de contrôle de saisie
function verif() {
    // Récupérer les valeurs des champs du formulaire
    var reponse = document.forms[0]['reponse'].value.trim();
    var id_reclamation = parseInt(document.forms[0]['id_reclamation'].value, 10);
    var id_user = parseInt(document.forms[0]['id_user'].value, 10);

    // Stocker les messages d'erreur
    var error = [];

    // Vérifier que le champ de réponse n'est pas vide et a une longueur minimale
    if (reponse === "") {
        error.push("Le champ Réponse ne peut pas être vide.");
    } else if (reponse.length < 10) {
        error.push("Le champ Réponse doit contenir au moins 10 caractères.");
    }

    // Vérifier que l'ID de la réclamation est un nombre positif
    if (isNaN(id_reclamation) || id_reclamation <= 0) {
        error.push("L'ID de la réclamation doit être un nombre positif.");
    }

    // Vérifier que l'ID de l'utilisateur est un nombre positif
    if (isNaN(id_user) || id_user <= 0) {
        error.push("L'ID de l'utilisateur doit être un nombre positif.");
    }

    // Si des erreurs sont trouvées, les afficher et empêcher la soumission
    if (error.length > 0) {
        alert(error.join("\n")); // Utiliser alert() pour montrer les erreurs
        return false; // Empêcher la soumission du formulaire
    }

    return true; // Autoriser la soumission du formulaire
}
