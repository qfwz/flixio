<?php
include "connection.php";
$result = mysqli_query($conn, "SELECT * FROM movies");

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $poster = $_POST['poster'];
    $rating = $_POST['rating'];

    mysqli_query($conn, "INSERT INTO movies (title, year, genre, poster, rating) 
    VALUES ('$title', '$year', '$genre', '$poster', '$rating')");

    header("Location: index.php");
}

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Flixio</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<a href="#" class="add-btn" onclick="openModal()">
    <svg viewBox="0 0 24 24" width="30" height="30">
        <path d="M12 5v14M5 12h14" stroke="white" stroke-width="2" stroke-linecap="round"/>
    </svg>
    <span>Add Movie </span>
</a>

<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        
        <h2>Add Movie</h2>
        
        <form method="POST" action="">
            <input type="text" name="title" placeholder="Title" required><br>
            <input type="number" name="year" placeholder="Year" required><br>
            <input type="text" name="genre" placeholder="Genre" required><br>
            <input type="text" name="poster" placeholder="Poster URL" required><br>
            <input type="number" step="0.1" name="rating" placeholder="Rating" required><br><br>

            <button type="submit" name="add">Add</button>
        </form>
    </div>
</div>

<script>
function openModal() {
    document.getElementById("modal").style.display = "block";
}

function closeModal() {
    document.getElementById("modal").style.display = "none";
}
</script>

<body>

<header class="header">
    <div class="logo">Flixio</div>

    <nav class="nav">
        <a href="#">Home</a>
        <a href="#">Movies</a>
        <a href="#">Genre</a>
        <a href="#">About</a>
    </nav>
</header>

<div class="container">
<?php while($movie = mysqli_fetch_assoc($result)): ?>

    <a href="detail.php?id=<?= $movie['id'] ?>" class="film-card">
        <div class="poster">
            <img src="<?= $movie['poster'] ?>" alt="<?= $movie['title'] ?> Poster">
        </div>
        
        
        <div class="judul">
            <?= $movie['title'] ?>
            <span class="tahun"><?= $movie['year'] ?></span>
        </div>

        <div class="genre"><?= $movie['genre'] ?></div>
        <div>⭐ <?= $movie['rating'] ?></div>
    </a>

<?php endwhile; ?>
</div>

<?php if (isset($_GET['deleted'])): ?>
<script>
Swal.fire({
    title: "Deleted!",
    text: "Movie has been removed.",
    icon: "success",
    confirmButtonColor: "#ff3c3c"
});
</script>
<?php endif; ?>

</body>
</html>