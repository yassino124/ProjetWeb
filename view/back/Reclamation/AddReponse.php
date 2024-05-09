<?php
// Include the controller and response model
include '../../../controller/ReponseC.php';

// Initialize an error variable for error messages
$error = "";

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Validate that the necessary data is provided
    if (isset($_POST['reponse']) && isset($_POST['id_reclamation']) && isset($_POST['id_user'])) {
        // Sanitize inputs
        $reponseText = htmlspecialchars($_POST['reponse'], ENT_QUOTES, 'UTF-8');
        $idReclamation = intval($_POST['id_reclamation']);
        $idUser = intval($_POST['id_user']);

        // Create a new response object with the form data
        $reponse = new Reponse(
            null, // Automatic ID
            $reponseText, // The text of the response
            $idReclamation, // Associated reclamation ID
            date('Y-m-d H:i:s'), // Date of the response
            $idUser // User ID who responds
        );

        // Initialize the controller
        $reponseC = new ReponseC();

        try {
            // Add the response to the database
            $reponseC->addReponse($reponse);

            // Redirect to a page showing all responses
            header('Location: ListReponse.php');
            exit;
        } catch (PDOException $e) {
            // Capture the exception and display an error message
            $error = 'Erreur lors de l\'ajout de la réponse : ' . $e->getMessage();
        }
    } else {
        // If required data is missing, set an error message
        $error = 'Certaines données sont manquantes pour ajouter une réponse.';
    }
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
    <script src="Add.js"></script>
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Ajouter une réponse à une réclamation</h1>
                            </div>
                            <!-- Display error messages -->
                            <div id="error">
                                <?php echo $error; ?>
                            </div>
                            <!-- Form to add a response -->
                            <form action="" method="POST" onsubmit="return verif()">
                                <div class="form-group">
                                    <label for="reponse">Réponse</label>
                                    <textarea name="reponse" class="form-control" rows="3" ><?php echo isset($_POST['reponse']) ? htmlspecialchars($_POST['reponse'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="id_reclamation">ID de la réclamation</label>
                                    <input type="number" name="id_reclamation" class="form-control"<?php echo isset($_POST['id_reclamation']) ? htmlspecialchars($_POST['id_reclamation'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label pour="id_user">ID de l'utilisateur</label>
                                    <input type="number" name="id_user" class="form-control"<?php echo isset($_POST['id_user']) ? htmlspecialchars($_POST['id_user'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                                </div>

                                <!-- Submit button -->
                                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                    Ajouter la réponse
                                </button>
                            </form>

                            <!-- Link to view all responses -->
                            <hr>
                            <div class="text-center">
                                <a class="small" href="ListReponse.php">Voir toutes les réponses</a>
                                <p><a href="ListReclamation.php">Retour à la liste des réclamation</a></p>
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