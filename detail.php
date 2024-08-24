<?php
include 'config.php';

// Fetch the news article based on slug
if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];
    $sql = "SELECT berita.*, kategori_berita.nama_kategori_berita 
            FROM berita 
            JOIN kategori_berita ON berita.id_kategori = kategori_berita.id_kategori 
            WHERE berita.slug='$slug'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .news-detail img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .news-detail {
        margin-top: 20px;
    }
    </style>
</head>

<body>

    <div class="container mt-4">
        <a href="index.php" class="btn btn-secondary mb-4">Kembali Ke Daftar</a>

        <?php if (isset($row)): ?>
        <div class="news-detail">
            <h1 class="mb-4"><?php echo htmlspecialchars($row['judul_berita']); ?></h1>
            <p class="text-muted"><strong>Kategori:</strong>
                <?php echo htmlspecialchars($row['nama_kategori_berita']); ?></p>
            <p class="text-muted"><strong>Tanggal:</strong> <?php echo htmlspecialchars($row['tgl_berita']); ?></p>
            <?php if (!empty($row['gambar_berita'])): ?>
            <img style="width:30%" src="uploads/<?php echo htmlspecialchars($row['gambar_berita']); ?>"
                alt="<?php echo htmlspecialchars($row['judul_berita']); ?>">
            <?php endif; ?>
            <p class="mt-4"><?php echo nl2br(htmlspecialchars($row['isi_berita'])); ?></p>
            <a href="edit_berita.php?id_berita=<?php echo $row['id_berita']; ?>" class="btn btn-warning mt-3">Edit
                Berita</a>

            <!-- Delete Button Form -->
            <form method="POST" action="delete_berita.php" class="mt-3">
                <input type="hidden" name="id_berita" value="<?php echo $row['id_berita']; ?>">
                <button type="submit" name="delete_berita" class="btn btn-danger">Delete Berita</button>
            </form>
        </div>
        <?php else: ?>
        <p>Berita tidak ditemukan.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>