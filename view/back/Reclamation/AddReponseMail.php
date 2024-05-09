<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Chemin vers autoload.php
require __DIR__ . '/../../../vendor/autoload.php';

// Vérifiez que PHPMailer est correctement chargé
if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    die("PHPMailer n'a pas pu être chargé. Assurez-vous que Composer a été installé et que le répertoire vendor existe.");
}

include '../../../Controller/ReponseC.php';

// Initialisation des variables
$error = "";
$reponseC = new ReponseC();

// Vérifiez si toutes les données nécessaires sont présentes
if (
    !empty($_POST["reponse"]) &&
    !empty($_POST["id_reclamation"]) &&
    !empty($_POST["date_r"]) &&
    !empty($_POST["id_user"]) &&
    !empty($_POST["email"]) // Assurez-vous que le courriel est fourni
) {
    // Nettoyez les données d'entrée
    $reponse = filter_var($_POST["reponse"], FILTER_SANITIZE_STRING);
    $id_reclamation = filter_var($_POST["id_reclamation"], FILTER_SANITIZE_NUMBER_INT);
    $date_r = filter_var($_POST["date_r"], FILTER_SANITIZE_STRING);
    $id_user = filter_var($_POST["id_user"], FILTER_SANITIZE_NUMBER_INT);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Créez un objet Reponse
    $nouvelle_reponse = new Reponse(
        null, 
        $reponse, 
        $id_reclamation, 
        $date_r, 
        $id_user
    );

    // Ajoutez la réponse à la base de données
    $reponseC->addReponse($nouvelle_reponse);

    // Envoyer un e-mail de confirmation
    $mail = new PHPMailer(true); // Instanciez PHPMailer
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'yassinewertani09@gmail.com'; // Modifiez selon vos besoins
        $mail->Password = 'gswl becp mkdg ydqn'; // Assurez-vous d'utiliser un mot de passe d'application
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Paramètres de l'e-mail
        $mail->setFrom('OpexTeam@example.com', 'OPEX TEAM'); 
        $mail->addAddress($email); // Envoyer à l'adresse fournie

        // Corps de l'e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Confirmation de réponse';
        $mail->Body = "Votre réponse a été enregistrée avec succès. Voici le contenu de votre réponse: <p style='color:red'>$reponse</p> <p>Merci, <br>OPEX Team</p>";

        // Envoyer l'e-mail
        $mail->send(); 
    } catch (Exception $e) {
        $error = "Erreur lors de l'envoi de l'e-mail : " . htmlspecialchars($mail->ErrorInfo, ENT_QUOTES, 'UTF-8');
    }
} else {
    // Gestion des erreurs si des champs obligatoires manquent
    $error = "";
}

if (!empty($error)) {
    echo "<p class='error'>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Ajouter une réponse</title>
    <!-- Link to CSS styles -->
    <link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="css/sb-admin-2.min.css">
    <title>Ajouter une Réponse</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assurez-vous d'inclure vos fichiers CSS -->
    <link rel="stylesheet" href="addr.css">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Ajouter une réponse par mail</h1>
                            </div>
                            <?php if (!empty($error)): ?>
        <p class='error'><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>

    <!-- Formulaire pour ajouter une réponse -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset>
            <legend>Formulaire d'Ajout de Réponse</legend>

            <!-- Réponse -->
            <div>
                <label pour="reponse">Réponse:</label>
                <input type="text" id="reponse" name="reponse" required>
            </div>

            <!-- ID Réclamation -->
            <div>
                <label pour="id_reclamation">ID Réclamation:</label>
                <input type="number" id="id_reclamation" name="id_reclamation" required>
            </div>

            <!-- Date de la Réponse -->
            <div>
                <label pour="date_r">Date:</label>
                <input type="date" id="date_r" name="date_r" required>
            </div>

            <!-- ID Utilisateur -->
            <div>
                <label pour="id_user">ID Utilisateur:</label>
                <input type="number" id="id_user" name="id_user" required>
            </div>

            <!-- Email -->
            <div>
                <label pour="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <!-- Bouton de soumission -->
            <div>
                <button type="submit">Ajouter la Réponse</button>
            </div>
        </fieldset>
    </form>

    <!-- Lien pour retourner à la liste des réponses -->
    <p><a href="ListReponse.php">Retour à la liste des réponses</a></p>
    <p><a href="ListReclamation.php">Retour à la liste des réclamation</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include JavaScript files -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>



