<?php
include 'config.php';

// Fetch the category details based on ID
if (isset($_GET['id_kategori'])) {
    $id_kategori = $_GET['id_kategori'];
    $sql = "SELECT * FROM kategori_berita WHERE id_kategori=$id_kategori";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

// Handle the form submission to update category
if (isset($_POST['update_kategori'])) {
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori_berita'];
    $sql = "UPDATE kategori_berita SET nama_kategori_berita='$nama_kategori' WHERE id_kategori=$id_kategori";
    mysqli_query($conn, $sql);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Kategori</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-4">
        <h1 class="mb-4">Update Kategori</h1>

        <form method="POST" action="">
            <input type="hidden" name="id_kategori" value="<?php echo htmlspecialchars($row['id_kategori']); ?>">

            <div class="form-group">
                <label for="nama_kategori_berita">Nama Kategori:</label>
                <input type="text" name="nama_kategori_berita" id="nama_kategori_berita" class="form-control"
                    value="<?php echo htmlspecialchars($row['nama_kategori_berita']); ?>" required>
            </div>

            <button type="submit" name="update_kategori" class="btn btn-primary">Update Kategori</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>