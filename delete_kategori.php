<?php
include 'config.php';

if(isset($_GET['id_kategori'])){
    $id_kategori = $_GET['id_kategori'];
    
    // Fetch the category details to display
    $sql = "SELECT * FROM kategori_berita WHERE id_kategori = $id_kategori";
    $result = mysqli_query($conn, $sql);
    $category = mysqli_fetch_assoc($result);
    
    if (!$category) {
        echo "<p>Category not found.</p>";
        exit();
    }
    
    if(isset($_POST['confirm_delete'])){
        // Perform the deletion
        $sql = "DELETE FROM kategori_berita WHERE id_kategori = $id_kategori";
        mysqli_query($conn, $sql);
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Kategori</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-4">
        <h1 class="mb-4">Delete Kategori</h1>

        <div class="card">
            <div class="card-header">
                Confirm Deletion
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($category['nama_kategori_berita']); ?></h5>
                <p class="card-text"><strong>ID Kategori:</strong>
                    <?php echo htmlspecialchars($category['id_kategori']); ?></p>
                <form method="POST" action="">
                    <button type="submit" name="confirm_delete" class="btn btn-danger">Confirm Delete</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>