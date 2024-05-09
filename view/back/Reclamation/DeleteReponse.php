<?php
require_once '../../../Controller/ReponseC.php'; // Use require_once to avoid silent errors and double inclusions.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the incoming POST data.
    if (isset($_POST['id_reponse']) && is_numeric($_POST['id_reponse'])) {
        $id_reponse = intval($_POST['id_reponse']); // Sanitize the ID.

        $reponseC = new ReponseC();
        $reponseC->deleteReponse($id_reponse);

        header('Location: ListReponse.php'); // Redirect after deletion.
        exit(); // Always call exit() after header() to stop further execution.
    } else {
        // If there's no valid ID, redirect with feedback or show an error message.
        header('Location: ListReponse.php');
        exit();
    }
}

$id_reponse = 0;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_reponse = intval($_GET['id']); // Sanitize the ID.
}

$reponseC = new ReponseC();
$reponse = $reponseC->showReponse($id_reponse);

if (!$reponse) {
    header('Location: ListReponse.php'); // Redirect if reponse not found.
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Reponse</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="dels.css">
</head>

<body>
    <div class="container">
        <h2>Delete Reponse</h2>
        <?php if ($reponse) : ?>
            <p>Are you sure you want to delete the following response?</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="id_reponse" value="<?php echo $id_reponse; ?>">

                <div>
                    <label>Response: <?php echo htmlspecialchars($reponse['reponse']); ?></label>
                </div>
                <div>
                    <label>Reclamation ID: <?php echo htmlspecialchars($reponse['id_reclamation']); ?></label>
                </div>
                <div>
                    <label>Date: <?php echo htmlspecialchars($reponse['date_r']); ?></label>
                </div>
                <div>
                    <label>User ID: <?php echo htmlspecialchars($reponse['id_user']); ?></label>
                </div>

                <button type="submit" class="btn btn-danger">Delete</button>
                <a href="ListReponse.php" class="btn btn-secondary">Cancel</a>
            </form>
        <?php else : ?>
            <p>Response not found.</p>
        <?php endif; ?>
    </div>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>