<?php
include 'config.php';

if(isset($_POST['add_kategori'])){
    $nama_kategori = $_POST['nama_kategori_berita'];
    $sql = "INSERT INTO kategori_berita (nama_kategori_berita) VALUES ('$nama_kategori')";
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Kategori</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-4">
        <h1 class="mb-4">Add New Kategori</h1>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nama_kategori_berita">Nama Kategori:</label>
                <input type="text" id="nama_kategori_berita" name="nama_kategori_berita" class="form-control" required>
            </div>

            <button type="submit" name="add_kategori" class="btn btn-primary">Add Kategori</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>