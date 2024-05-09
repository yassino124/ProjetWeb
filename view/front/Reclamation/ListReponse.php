<?php
// Import the controller
include '../../../controller/ReponseC.php';

// Initialize the controller
$reponseC = new ReponseC();

// Retrieve the list of responses
$list = $reponseC->ListReponse();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Liste des réponses">
    <meta name="author" content="Votre Nom">

    <title>Liste des Réponses</title>

    <!-- CSS Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="text-center">Réponses</h1>
    
    <!-- Table to display responses -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Réponse</th>
                    <th>Réclamation associée</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <!-- Check if the list is empty -->
                <?php if (empty($list)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Aucune réponse trouvée.</td>
                    </tr>
                <?php else: ?>
                    <!-- Loop through each response to display them -->
                    <?php foreach ($list as $reponse): ?>
                        <tr>
                        <td><?php echo htmlspecialchars($reponse['id_reponse'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($reponse['reponse'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($reponse['id_reclamation'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($reponse['date_r'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap and jQuery Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>