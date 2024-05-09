<?php
include '../../../Controller/ReclamationC.php';

// Initialisez le contrôleur
$reclamationC = new ReclamationC();

// Critère de tri
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'date_r'; // Par défaut, trier par date
$order = isset($_GET['order']) ? $_GET['order'] : 'ASC'; // Par défaut, ordre croissant

// Récupérer la liste des réclamations triées
$list = $reclamationC->listReclamationTriée($sort_by, $order);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class=""></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <form class="user">
                                <div class="form-group row">
                                <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Liste des Réclamations</h1>
                               </div>

<!-- Liens pour trier -->
<a href="?sort_by=nom&order=ASC">Trier par nom (A-Z)</a>
<a href="?sort_by=nom&order=DESC">Trier par nom (Z-A)</a>
<a href="?sort_by=date_r&order=ASC">Trier par date (croissant)</a>
<a href="?sort_by=date_r&order=DESC">Trier par date (décroissant)</a>

<!-- Tableau des réclamations -->
<table border="1">
    <tr>
        <th>ID Réclamation</th>
        <th>Nom</th>
        <th>Email</th>
        <th>État</th>
        <th>Date</th>
        <th>Téléphone</th>
        <th>Commentaire</th>
    </tr>
    <?php
    foreach ($list as $reclamation) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($reclamation['id_reclamation'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($reclamation['nom'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($reclamation['email'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($reclamation['etat'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($reclamation['date_r'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($reclamation['tel'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($reclamation['commentaire'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "</tr>";
    }
    ?>
</table>
<p><a href="ListReclamation.php">Retour à la liste des réclamation</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>