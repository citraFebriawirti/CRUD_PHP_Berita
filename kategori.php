<?php
include 'config.php';

if (isset($_GET['id_kategori'])) {
    $id_kategori = intval($_GET['id_kategori']); // Ensure it's an integer to prevent SQL injection

    // Fetch news articles based on category
    $stmt = $conn->prepare("SELECT berita.*, kategori_berita.nama_kategori_berita FROM berita 
                            JOIN kategori_berita ON berita.id_kategori = kategori_berita.id_kategori 
                            WHERE berita.id_kategori = ?");
    $stmt->bind_param("i", $id_kategori);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch category name
    $category_sql = "SELECT nama_kategori_berita FROM kategori_berita WHERE id_kategori = ?";
    $category_stmt = $conn->prepare($category_sql);
    $category_stmt->bind_param("i", $id_kategori);
    $category_stmt->execute();
    $category_result = $category_stmt->get_result();
    $category = $category_result->fetch_assoc();
    $category_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles by Category</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .article-card img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .article-card {
        margin-bottom: 20px;
    }
    </style>
</head>

<body>

    <div class="container mt-4">
        <a href="index.php" class="btn btn-secondary mb-4">Back to List</a>

        <?php if (isset($category)): ?>
        <h1 class="mb-4">Articles in Category: <?php echo htmlspecialchars($category['nama_kategori_berita']); ?></h1>

        <?php if ($result->num_rows > 0): ?>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card article-card">
                    <?php if (!empty($row['gambar_berita'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($row['gambar_berita']); ?>" class="card-img-top"
                        alt="<?php echo htmlspecialchars($row['judul_berita']); ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="detail.php?slug=<?php echo htmlspecialchars($row['slug']); ?>"
                                class="text-dark"><?php echo htmlspecialchars($row['judul_berita']); ?></a>
                        </h5>
                        <p class="card-text">
                            <?php echo nl2br(htmlspecialchars(substr($row['isi_berita'], 0, 100))); ?>...</p>
                        <a href="detail.php?slug=<?php echo htmlspecialchars($row['slug']); ?>"
                            class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php else: ?>
        <p>No articles found in this category.</p>
        <?php endif; ?>
        <?php else: ?>
        <p>Category not found.</p>
        <?php endif; ?>
    </div>


    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>