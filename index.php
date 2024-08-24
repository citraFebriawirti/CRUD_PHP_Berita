<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .card-img-top {
        height: 180px;
        object-fit: cover;
    }
    </style>
</head>

<body>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Daftar Berita</h1>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="add_berita.php" class="btn btn-primary mr-4">Tambah Berita</a>
                <a href="add_kategori.php" class="btn btn-warning">Tambah Kategori</a>
            </div>

        </div>

        <div class="row">
            <?php
            $sql = "SELECT berita.*, kategori_berita.nama_kategori_berita FROM berita 
                    JOIN kategori_berita ON berita.id_kategori = kategori_berita.id_kategori";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card'>";
                    echo "<img src='uploads/".$row['gambar_berita']."' class='card-img-top' alt='".$row['judul_berita']."'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'><a href='detail.php?slug=".$row['slug']."' class='text-dark'>".$row['judul_berita']."</a></h5>";
                    echo "<p class='card-text'><strong>Kategori:</strong> ".$row['nama_kategori_berita']."</p>";
                    echo "<p class='card-text'><strong>Tanggal:</strong> ".$row['tgl_berita']."</p>";
                    echo "<p class='card-text'>".substr($row['isi_berita'], 0, 100)."...</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No news found.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>