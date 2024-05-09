<?php
// Start by including necessary files
include '../../../Controller/ReponseC.php';

// Ensure the user is authorized to perform this action
// If using sessions or some form of authentication, verify the user has permissions to update

// Retrieve input data - for POST requests
$id_reponse = isset($_POST['id_reponse']) ? intval($_POST['id_reponse']) : 0;
$new_reponse = isset($_POST['reponse']) ? $_POST['reponse'] : '';
$id_reclamation = isset($_POST['id_reclamation']) ? intval($_POST['id_reclamation']) : 0;
$date_r = isset($_POST['date_r']) ? $_POST['date_r'] : ''; // Ensure this is a valid date
$id_user = isset($_POST['id_user']) ? intval($_POST['id_user']) : 0;

if ($id_reponse > 0 && $new_reponse && $id_reclamation > 0 && $date_r && $id_user > 0) {
    // Valid input data
    try {
        $reponseC = new ReponseC();

        // Create a Reponse object with updated data
        $updated_reponse = new Reponse(
            $id_reponse,
            $new_reponse,
            $id_reclamation,
            $date_r,
            $id_user
        );

        // Update the record in the database
        $reponseC->updateReponse($id_reponse, $updated_reponse);

        echo "Reponse updated successfully.";
    } catch (Exception $e) {
        // If there's an error, display it
        echo "Error updating reponse: " . $e->getMessage();
    }
} else {
    echo "Invalid input data. Please check your input and try again.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Response</title>
    <!-- Link to Bootstrap for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Update Response</h2>

    <!-- Form to update the response -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- Hidden field to pass the ID of the response to update -->
        <input type="hidden" name="id_reponse" value="<?php echo htmlspecialchars($id_reponse); ?>">

        <!-- Response text input -->
        <div class="form-group">
            <label for="reponse">Response:</label>
            <input type="text" name="reponse" class="form-control" id="reponse" required>
        </div>

        <!-- Reclamation ID input -->
        <div class="form-group">
            <label for="id_reclamation">Reclamation ID:</label>
            <input type="number" name="id_reclamation" class="form-control" id="id_reclamation" required>
        </div>

        <!-- Date input -->
        <div class="form-group">
            <label for="date_r">Date:</label>
            <input type="date" name="date_r" class="form-control" id="date_r" required>
        </div>

        <!-- User ID input -->
        <div class="form-group">
            <label for="id_user">User ID:</label>
            <input type="number" name="id_user" class="form-control" id="id_user" required>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<!-- Link to Bootstrap JavaScript and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

