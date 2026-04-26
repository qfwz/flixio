<?php
session_start();
include "connection.php";
$result = mysqli_query($conn, "SELECT * FROM movies");

if (isset($_POST['add'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $poster = mysqli_real_escape_string($conn, $_POST['poster']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);

    mysqli_query($conn, "INSERT INTO movies (title, year, genre, poster, rating) 
    VALUES ('$title', '$year', '$genre', '$poster', '$rating')");
    header("Location: index.php?added=1");
    exit;
}



?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Flixio</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addModal')">&times;</span>
        
        <h2>Add Movie</h2>
        
        <form method="POST" action="">
            <input type="text" name="title" placeholder="Title" required><br>
            <input type="number" name="year" placeholder="Year" min="1901" max="2155" required><br>
            <input type="text" name="genre" placeholder="Genre" required><br>
            <input type="text" name="poster" placeholder="Poster URL" required><br>
            <input type="number" step="0.1" name="rating" placeholder="Rating" required><br><br>

            <button type="submit" name="add">Add</button>
        </form>
    </div>
</div>

<div id="welcomeBox" class="welcome-box">
    <h1 class="welcome-text">
        Welcome, <?= isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest' ?> 👋
    </h1>
</div>

<script>
function openModal(id) {
    document.getElementById(id).style.display = "block";
}

function closeModal(id) {
    document.getElementById(id).style.display = "none";
}

function openToaster(id) {
    const el = document.getElementById(id);
    el.classList.add("show");
}

function closeToaster(id) {
    const el = document.getElementById(id);
    el.classList.remove("show");
}
</script>

<body>



<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
<a href="#" class="add-btn" onclick="openModal('addModal')">
    <svg viewBox="0 0 24 24" width="30" height="30">
        <path d="M12 5v14M5 12h14" stroke="white" stroke-width="2" stroke-linecap="round"/>
    </svg>
    <span>Add Movie </span>
</a>
<?php endif; ?>


<header class="header">
    <div class="logo">
        <span class="flix">Flix</span><span class="io">io</span>
    </div>

    <nav class="nav">
        <a href="#">Home</a>
        <a href="#">Movies</a>
        <a href="#">Genre</a>
        <a href="account.php">Account</a>
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

<?php if (isset($_GET['added'])): ?>
<script>
Swal.fire({
    title: "Added!",
    text: "Movie has been added.",
    icon: "success",
    confirmButtonColor: "#3cba54"
});
</script>
<?php endif; ?>

<?php if (isset($_SESSION['just_login'])): ?>
    <script>
        openToaster('welcomeBox');
        setTimeout(() => {
            closeToaster('welcomeBox');
        }, 2000);
    </script>
    <?php unset($_SESSION['just_login']); ?>
<?php endif; ?>

</body>
</html>