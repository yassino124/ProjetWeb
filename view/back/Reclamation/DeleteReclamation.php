<?php
include '../../../Controller/ReclamationC.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_reclamation'])) {
        $id_reclamation = $_POST['id_reclamation'];

        $reclamationC = new ReclamationC();
        $reclamationC->deleteReclamation($id_reclamation);

        header('Location: ListReclamation.php');
        exit();
    }
}

if (isset($_GET['id'])) {
    $id_reclamation = $_GET['id'];

    $reclamationC = new ReclamationC();

    $reclamation = $reclamationC->showReclamation($id_reclamation);

    if (!$reclamation) {
        header('Location: ListReclamation.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Delete Reclamation</title>
    <link rel="stylesheet" href="del.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css"> 
</head>

<body>

    <div class="container">
        <h2 class="mt-5 mb-3">Delete Reclamation</h2>
        <?php if (isset($reclamation)) : ?>
            <p>Are you sure you want to delete the following reclamation?</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="id_reclamation" value="<?php echo $reclamation['id_reclamation']; ?>">
                <div class="form-group">
                    <label>Nom: <?php echo $reclamation['nom']; ?></label>
                </div>
                <div class="form-group">
                    <label>Email: <?php echo $reclamation['email']; ?></label>
                </div>
                <div class="form-group">
                    <label>Etat: <?php echo $reclamation['etat']; ?></label>
                </div>
                <div class="form-group">
                    <label>Date: <?php echo $reclamation['date_r']; ?></label>
                </div>
                <div class="form-group">
                    <label>Tel: <?php echo $reclamation['tel']; ?></label>
                </div>
                <div class="form-group">
                    <label>Commentaire: <?php echo $reclamation['commentaire']; ?></label>
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
                <a href="ListReclamation.php" class="btn btn-secondary">Cancel</a>
            </form>
        <?php else : ?>
            <p>Reclamation not found.</p>
        <?php endif; ?>
    </div>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script> <!-- Adjust the path -->
</body>

</html>