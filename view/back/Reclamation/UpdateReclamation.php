<?php
include '../../../Controller/ReclamationC.php';

// Initialisation des variables
$id_reclamation = $nom = $email = $etat = $tel = $commentaire = $currentEtat = '';
$error = '';
$reclamationC = new ReclamationC();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nettoyage des valeurs d'entrée
    $id_reclamation = isset($_POST['id_reclamation']) ? filter_var($_POST['id_reclamation'], FILTER_SANITIZE_NUMBER_INT) : '';
    $nom = isset($_POST['nom']) ? filter_var($_POST['nom'], FILTER_SANITIZE_STRING) : '';
    $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
    $etat = isset($_POST['etat']) ? filter_var($_POST['etat'], FILTER_SANITIZE_STRING) : '';
    $tel = isset($_POST['tel']) ? filter_var($_POST['tel'], FILTER_SANITIZE_STRING) : '';
    $commentaire = isset($_POST['commentaire']) ? filter_var($_POST['commentaire'], FILTER_SANITIZE_STRING) : '';

    // Vérification des valeurs obligatoires
    if (empty($id_reclamation) || empty($nom) || empty($email) || empty($etat) || empty($tel) || empty($commentaire)) {
        $error = "";
    } else {
        try {
            // Récupérer la réclamation
            $reclamation = $reclamationC->showReclamation($id_reclamation);

            if ($reclamation) {
                // Si la réclamation est trouvée, mettre à jour le statut
                $currentEtat = $reclamation['etat'];

                // Créer une nouvelle instance de Reclamation avec les données à mettre à jour
                $reclamation = new Reclamation($id_reclamation, $nom, $email, $etat, date('Y-m-d H:i:s'), $tel, $commentaire);

                // Mettre à jour la réclamation
                $reclamationC->updateReclamation($id_reclamation, $reclamation);

                // Rediriger vers la liste des réclamations
                header('Location: ListReclamation.php');
                exit();
            } else {
                $error = "La réclamation n'a pas été trouvée.";
            }
        } catch (Exception $e) {
            $error = "Erreur lors de la mise à jour de la réclamation : " . $e->getMessage();
        }
    }
} else {
    header('Location: ListReclamation.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Mettre à jour une réclamation</title>
    <link rel="stylesheet" href="upp.css">
    <!-- Link to CSS styles -->
    <link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="css/sb-admin-2.min.css">

</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <button><a href="ListReclamation.php">Retour à la liste</a></button>
<hr>

<div id="error">
    <?php echo htmlspecialchars($error); ?>
</div>

<h1>Mettre à jour une réclamation</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" name="id_reclamation" value="<?php echo htmlspecialchars($id_reclamation); ?>">
    
    <label pour="nom">Nom :</label>
    <input type="text" name="nom" value="<?php echo htmlspecialchars($nom); ?>" required><br><br>

    <label pour="email">E-mail :</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br><br>

    <label pour="etat">État :</label>
    <select name="etat">
        <option value="Traité" <?php echo ($currentEtat === 'Traité') ? 'selected' : ''; ?>>Traité</option>
        <option value="Non Traité" <?php echo ($currentEtat === 'Non Traité') ? 'selected' : ''; ?>>Non Traité</option>
    </select><br><br>

    <label pour="tel">Téléphone :</label>
    <input type="tel" name="tel" value="<?php echo htmlspecialchars($tel); ?>" required><br><br>

    <label pour="commentaire">Commentaire :</label>
    <textarea name="commentaire" required><?php echo htmlspecialchars($commentaire); ?></textarea><br><br>

    <input type="submit" value="Mettre à jour" name="submit">
                            <div class="text-center">
                                <a class="small" href="ListReponse.php">Voir toutes les réponses</a>
                            </div>
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