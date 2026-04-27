<?php 
session_start();
include "connection.php";

$id = intval($_GET['id']);
$updated = false;

// EDIT
if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $poster = mysqli_real_escape_string($conn, $_POST['poster']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    mysqli_query($conn, "UPDATE movies SET 
        title='$title',
        year='$year',
        genre='$genre',
        poster='$poster',
        description='$description'
        WHERE id=$id
    ");

    $updated = true;
}

// REVIEW

if (isset($_POST['submit_review'])) {
    $movie_id = intval($_POST['movie_id']);
    $rating = floatval($_POST['rating']);
    $review = mysqli_real_escape_string($conn, $_POST['review'] ?? '');
    $username = $_SESSION['username'];

    mysqli_query($conn, "INSERT INTO reviews (movie_id, username, rating, review)
    VALUES ('$movie_id', '$username', '$rating', '$review')");

    header("Location: detail.php?id=$movie_id&review_added=1");
    exit;
}

/* ambil data terbaru*/
$result = mysqli_query($conn, "
    SELECT m.*, AVG(r.rating) as avg_rating, COUNT(r.id) as total_reviews
    FROM movies m
    LEFT JOIN reviews r ON m.id = r.movie_id
    WHERE m.id = $id
    GROUP BY m.id
");

$movie = mysqli_fetch_assoc($result);
$reviews = mysqli_query($conn, "
    SELECT * FROM reviews 
    WHERE movie_id = $id 
    ORDER BY created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/detail.css">
    <title><?= $movie['title'] ?> - Flixio</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

<header class="header">
    <div class="logo">
        <span class="flix">Flix</span><span class="io">io</span>
    </div>

    <nav class="nav">
        <a href="index.php">Home</a>
        <a href="#">Movies</a>
        <a href="#">Genre</a>
        <a href="account.php">Account</a>
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

            <p class="rating">
                <?php if ($movie['avg_rating']): ?>
                    <span style="color: white;"> <span style="color: var(--yellow);">★</span> <?= round($movie['avg_rating'], 1) ?></span>
                    <small >(<?= $movie['total_reviews'] ?> ratings)</small>
                <?php else: ?>
                    <span >No ratings yet</span>
                <?php endif; ?>
            </p>

            <p class="description"><?= $movie['description'] ?></p>

            <div class="action-group">
                <div>
                    <button class="yellow-btn" onclick="openReviewModal()">
                        <svg viewBox="0 0 24 24" width="16" height="16" style="vertical-align: middle;">
                            <path d="M12 17l-5 3 1-6-4-4 6-.5L12 4l2 5.5 6 .5-4 4 1 6z"
                            fill="black"/>
                        </svg>
                        Rate & review
                    </button>
                </div>


                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                
                <div>
                    <button class="yellow-btn" onclick="openEditModal()">
                        <svg viewBox="0 0 24 24" width="16" height="16" style="vertical-align: middle;">
                            <path d="M4 20h4l10-10-4-4L4 16v4zM14 6l4 4"
                            stroke="black" stroke-width="2" fill="none" stroke-linecap="round"/>
                        </svg>
                        Edit info
                    </button>

                    <button class="red-btn" onclick="confirmDelete(<?= $movie['id'] ?>)">
                        <svg viewBox="0 0 24 24" width="16" height="16" style="vertical-align: middle;">
                            <path d="M3 6h18M9 6v12m6-12v12M5 6l1 14h12l1-14M10 6V4h4v2"
                            stroke="white" stroke-width="2" stroke-linecap="round" fill="none"/>
                        </svg>
                        Delete from database
                    </button>
                </div>
                    
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- <a href="index.php" class="back-btn">← Back</a> -->

    <div class="review-section">
        <h2>Reviews</h2>

        <?php if (mysqli_num_rows($reviews) > 0): ?>
            
            <?php while($r = mysqli_fetch_assoc($reviews)): ?>
                <div class="review-card">
                    <?php for ($i = 0; $i < 10; $i++): ?>
                        <?php if ($i < floor($r['rating'])): ?>
                            <span style="color: var(--yellow);">★</span>
                        <?php else: ?>
                            <?php if ($i == 0):
                                break;
                            endif; ?>
                            <span style="color: #555;">★</span>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <div class="review-header">
                        <strong><?= $r['username'] ?></strong>
                        
                        <?php if (isset($_SESSION['username']) && $_SESSION['username'] == $r['username']): ?>
                            <span style="font-size: 12px; color: var(--yellow); margin-left: 4px;">(You)</span>
                        <?php endif; ?>

                    </div>

                    <?php if (!empty($r['review'])): ?>
                        <p class="review-text"><?= $r['review'] ?></p>
                    <?php endif; ?>
                    <small><?= date("d M Y", strtotime($r['created_at'])) ?></small>
                </div>
            <?php endwhile; ?>

        <?php else: ?>
            <p>No reviews yet. Be the first to review this movie!</p>
        <?php endif; ?>
    </div>

</div>

<!-- edit modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>

        <h2 class="modal-title">Edit Movie Details</h2>

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
                <label>Description</label>
                <textarea name="description" class="desc-box" required><?= $movie['description'] ?></textarea>
            </div>

            <button type="submit" name="update">Save</button>
        </form>
    </div>
</div>

<!-- review modal -->
<div id="reviewModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeReviewModal()">&times;</span>

        <h2>Rate & review</h2>

        <form method="POST">
            <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
            <div class="form-group">
                <label>Rating</label>
                <input type="number" step="1" name="rating" min="0" max="10">
            </div>

            <div class="form-group">
                <label>Review</label>
                <textarea name="review" class="desc-box"></textarea>
            </div>

            <button type="submit" name="submit_review">Submit</button>
        </form>
    </div>
</div>

<!-- action scripts -->
<script>
function openEditModal() {
    document.getElementById("editModal").style.display = "block";
}

function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}

function openReviewModal() {
    document.getElementById("reviewModal").style.display = "block";
}

function closeReviewModal() {
    document.getElementById("reviewModal").style.display = "none";
}

function confirmDelete(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "This movie will be permanently deleted",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ff3c3c",
        cancelButtonColor: "#555",
        confirmButtonText: "Yes"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "delete.php?id=" + id;
        }
    });
}

</script>

<!-- Swal scripts -->
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

<?php if (isset($_GET['review_added'])): ?>
<script>
Swal.fire({
    title: "Rating & review added!",
    text: "Thank you for contributing to the community 😃",
    icon: "success",
    confirmButtonColor: "#ff3c3c"
});
</script>
<?php endif; ?>





</body>
</html>