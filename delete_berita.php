<?php
include 'config.php';

// Check if the id_berita parameter is set
if (isset($_GET['id_berita'])) {
    $id_berita = intval($_GET['id_berita']); // Ensure it's an integer to prevent SQL injection

    // Fetch the news article details to display
    $stmt = $conn->prepare("SELECT * FROM berita WHERE id_berita = ?");
    $stmt->bind_param("i", $id_berita);
    $stmt->execute();
    $result = $stmt->get_result();
    $news_item = $result->fetch_assoc();
    $stmt->close();
    
    if (!$news_item) {
        echo "<p>News article not found.</p>";
        exit();
    }

    // Handle the deletion
    if (isset($_POST['confirm_delete'])) {
        // Perform the deletion
        $stmt = $conn->prepare("DELETE FROM berita WHERE id_berita = ?");
        $stmt->bind_param("i", $id_berita);
        $stmt->execute();
        $stmt->close();
        
        // Redirect to the index page after deletion
        header("Location: index.php");
        exit();
    }
} else {
    echo "<p>No article ID specified.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Berita</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-4">
        <h1 class="mb-4">Delete Berita</h1>

        <div class="card">
            <div class="card-header">
                Confirm Deletion
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($news_item['judul_berita']); ?></h5>
                <p class="card-text"><strong>Kategori:</strong>
                    <?php echo htmlspecialchars($news_item['id_kategori']); ?></p>
                <p class="card-text"><strong>Tanggal:</strong> <?php echo htmlspecialchars($news_item['tgl_berita']); ?>
                </p>
                <p class="card-text"><?php echo nl2br(htmlspecialchars($news_item['isi_berita'])); ?></p>
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