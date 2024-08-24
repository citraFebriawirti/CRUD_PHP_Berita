<?php
include 'config.php';

// Fetch the news details based on ID
if (isset($_GET['id_berita'])) {
    $id_berita = $_GET['id_berita'];
    $sql = "SELECT * FROM berita WHERE id_berita=$id_berita";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

// Handle the form submission to update news
if (isset($_POST['update_berita'])) {
    $id_berita = $_POST['id_berita'];
    $id_kategori = $_POST['id_kategori'];
    $judul_berita = $_POST['judul_berita'];
    $isi_berita = $_POST['isi_berita'];
    $gambar_berita = $_FILES['gambar_berita']['name'];
    $slug = strtolower(str_replace(' ', '-', $judul_berita));

    if ($gambar_berita) {
        move_uploaded_file($_FILES['gambar_berita']['tmp_name'], "uploads/$gambar_berita");
        $sql = "UPDATE berita SET id_kategori='$id_kategori', judul_berita='$judul_berita', 
                isi_berita='$isi_berita', gambar_berita='$gambar_berita', slug='$slug' 
                WHERE id_berita=$id_berita";
    } else {
        $sql = "UPDATE berita SET id_kategori='$id_kategori', judul_berita='$judul_berita', 
                isi_berita='$isi_berita', slug='$slug' WHERE id_berita=$id_berita";
    }
    mysqli_query($conn, $sql);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Berita</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-4">
        <h1 class="mb-4">Update Berita</h1>

        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="id_berita" value="<?php echo htmlspecialchars($row['id_berita']); ?>">

            <div class="form-group">
                <label for="id_kategori">Kategori:</label>
                <select name="id_kategori" id="id_kategori" class="form-control" required>
                    <?php
                $sql = "SELECT * FROM kategori_berita";
                $result = mysqli_query($conn, $sql);
                while ($kategori = mysqli_fetch_assoc($result)) {
                    $selected = $kategori['id_kategori'] == $row['id_kategori'] ? 'selected' : '';
                    echo "<option value='".$kategori['id_kategori']."' $selected>".$kategori['nama_kategori_berita']."</option>";
                }
                ?>
                </select>
            </div>

            <div class="form-group">
                <label for="judul_berita">Judul Berita:</label>
                <input type="text" name="judul_berita" id="judul_berita" class="form-control"
                    value="<?php echo htmlspecialchars($row['judul_berita']); ?>" required>
            </div>

            <div class="form-group">
                <label for="isi_berita">Isi Berita:</label>
                <textarea name="isi_berita" id="isi_berita" class="form-control" rows="5"
                    required><?php echo htmlspecialchars($row['isi_berita']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="gambar_berita">Gambar Berita:</label>
                <input type="file" name="gambar_berita" id="gambar_berita" class="form-control-file">
                <?php if ($row['gambar_berita']): ?>
                <img src="uploads/<?php echo htmlspecialchars($row['gambar_berita']); ?>" alt="Current Image"
                    class="img-fluid mt-2" style="max-width: 200px;">
                <?php endif; ?>
            </div>

            <button type="submit" name="update_berita" class="btn btn-primary">Update Berita</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>