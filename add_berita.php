<?php
include 'config.php';

if(isset($_POST['add_berita'])){
    $id_kategori = $_POST['id_kategori'];
    $judul_berita = $_POST['judul_berita'];
    $isi_berita = $_POST['isi_berita'];
    $gambar_berita = $_FILES['gambar_berita']['name'];
    $tgl_berita = date('Y-m-d');
    $slug = strtolower(str_replace(' ', '-', $judul_berita));
    
    move_uploaded_file($_FILES['gambar_berita']['tmp_name'], "uploads/$gambar_berita");

    $sql = "INSERT INTO berita (id_kategori, judul_berita, isi_berita, gambar_berita, tgl_berita, slug) 
            VALUES ('$id_kategori', '$judul_berita', '$isi_berita', '$gambar_berita', '$tgl_berita', '$slug')";
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
    <title>Add Berita</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-4">
        <h1 class="mb-4">Add New Berita</h1>

        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="id_kategori">Kategori:</label>
                <select id="id_kategori" name="id_kategori" class="form-control">
                    <?php
                $sql = "SELECT * FROM kategori_berita";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    echo "<option value='".$row['id_kategori']."'>".$row['nama_kategori_berita']."</option>";
                }
                ?>
                </select>
            </div>

            <div class="form-group">
                <label for="judul_berita">Judul Berita:</label>
                <input type="text" id="judul_berita" name="judul_berita" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="isi_berita">Isi Berita:</label>
                <textarea id="isi_berita" name="isi_berita" class="form-control" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="gambar_berita">Gambar Berita:</label>
                <input type="file" id="gambar_berita" name="gambar_berita" class="form-control-file" required>
            </div>

            <button type="submit" name="add_berita" class="btn btn-primary">Add Berita</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>