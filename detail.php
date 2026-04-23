<?php 
include "connection.php";

$id = intval($_GET['id']);
$updated = false;

// EDIT
if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $poster = mysqli_real_escape_string($conn, $_POST['poster']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    mysqli_query($conn, "UPDATE movies SET 
        title='$title',
        year='$year',
        genre='$genre',
        poster='$poster',
        rating='$rating',
        description='$description'
        WHERE id=$id
    ");

    $updated = true;
}

/* ambil data terbaru*/
$result = mysqli_query($conn, "SELECT * FROM movies WHERE id = $id");
$movie = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title><?= $movie['title'] ?> - Flixio</title>

    <!-- Swal -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

<header class="header">
    <div class="logo">Flixio</div>

    <nav class="nav">
        <a href="index.php">Home</a>
        <a href="#">Movies</a>
        <a href="#">Genre</a>
        <a href="#">About</a>
    </nav>
</header>

<div class="detail-container">

    <div class="detail-card">
        <div class="detail-poster">
            <img src="<?= $movie['poster'] ?>" alt="<?= $movie['title'] ?>">
        </div>

        <div class="detail-info">
            <h1>
                <?= $movie['title'] ?>
                <span class="detail-year">(<?= $movie['year'] ?>)</span>
            </h1>

            <p class="genre"><?= $movie['genre'] ?></p>
            <p class="rating">⭐ <?= $movie['rating'] ?></p>

            <p class="description"><?= $movie['description'] ?></p>

            <button class="edit-btn" onclick="openEditModal()">Edit details</button>
        </div>
    </div>

    <a href="index.php" class="back-btn">← Back</a>

</div>

<!-- editor window -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>

        <h2>Edit Movie</h2>

        <form method="POST">

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="<?= $movie['title'] ?>" required>
            </div>

            <div class="form-group">
                <label>Year</label>
                <input type="number" name="year" value="<?= $movie['year'] ?>" required>
            </div>

            <div class="form-group">
                <label>Genre</label>
                <input type="text" name="genre" value="<?= $movie['genre'] ?>" required>
            </div>

            <div class="form-group">
                <label>Poster</label>
                <input type="text" name="poster" value="<?= $movie['poster'] ?>" required>
            </div>

            <div class="form-group">
                <label>Rating</label>
                <input type="number" step="0.1" name="rating" value="<?= $movie['rating'] ?>" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="desc-box" required><?= $movie['description'] ?></textarea>
            </div>

            <button type="submit" name="update">Save</button>
        </form>
    </div>
</div>

<!-- buat buka editor -->
<script>
function openEditModal() {
    document.getElementById("editModal").style.display = "block";
}

function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}
</script>

<!-- Swal Trigger -->
<?php if ($updated): ?>
<script>
Swal.fire({
    title: "Saved!",
    text: "Changes have been saved.",
    icon: "success",
    confirmButtonColor: "#ff3c3c"
});
</script>
<?php endif; ?>

</body>
</html>