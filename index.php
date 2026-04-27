<?php
session_start();
include "connection.php";

$result = mysqli_query($conn, "
    SELECT m.*, AVG(r.rating) as avg_rating
    FROM movies m
    LEFT JOIN reviews r ON m.id = r.movie_id
    GROUP BY m.id
");

if (isset($_POST['add'])) {

    if ($_SESSION['role'] !== 'admin') {
        header("Location: index.php?error=1");
        exit;
    }

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $poster = mysqli_real_escape_string($conn, $_POST['poster']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    if (empty($poster)) {
        $poster = "https://via.placeholder.com/300x450?text=No+Image";
    }
    if (empty($description)) {
        $description = "No description.";
    }

    mysqli_query($conn, "INSERT INTO movies (title, year, genre, poster, description) 
    VALUES ('$title', '$year', '$genre', '$poster', '$description')");
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
        
        <h2 class="modal-title">Add Movie</h2>
        
        <form method="POST" action="">

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" required>
            </div>

            <div class="form-group">
                <label>Year</label>
                <input type="number" name="year" required>
            </div>

            <div class="form-group">
                <label>Genre</label>
                <input type="text" name="genre" required>
            </div>

            <div class="form-group">
                <label>Poster</label>
                <input type="text" name="poster">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="desc-box"></textarea>
            </div>

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

        

        <div>
            <?php if ($movie['avg_rating']): ?>
                <span style="color: var(--yellow);">★</span> <?= round($movie['avg_rating'], 1) ?>
            <?php else: ?>
                No ratings yet
            <?php endif; ?>
        </div>
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

<?php if (isset($_GET['error'])): ?>
<script>
Swal.fire({
    title: "Error",
    text: "You don't have permission to perform this action.",
    icon: "error",
    confirmButtonColor: "#ff3c3c"
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