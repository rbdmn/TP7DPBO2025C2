<?php
require_once 'class/Movie.php';
require_once 'class/Director.php';

$movie = new Movie();
$director = new Director();
$editData = null;

// Handle Search
$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
}

// Menangani Edit
if (isset($_GET['edit'])) {
    $editData = $movie->getMovieById($_GET['edit']);
}

// Menangani Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $movie->updateMovie($_POST['id'], $_POST['directorID'], $_POST['title'], $_POST['release_date'], $_POST['avg_rating']);
    header("Location: ?page=movies");
    exit;
}

// Menangani Add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $movie->addMovie($_POST['directorID'], $_POST['title'], $_POST['release_date'], $_POST['avg_rating']);
    header("Location: ?page=movies");
    exit;
}

// Menangani Delete
if (isset($_GET['delete'])) {
    $movie->deleteMovie($_GET['delete']);
    header("Location: ?page=movies");
    exit;
}
?>

<h3>Movie List</h3>

<!-- Form untuk Tambah/Edit Film -->
<form method="POST">
    <?php if ($editData): ?>
        <input type="hidden" name="id" value="<?= $editData['movieID'] ?>">
    <?php endif; ?>

    <label>Title:</label>
    <input type="text" name="title" value="<?= $editData['title'] ?? '' ?>" required><br>

    <label>Release Date:</label>
    <input type="date" name="release_date" value="<?= $editData['release_date'] ?? '' ?>" required><br>

    <label>Average Rating:</label>
    <input type="number" step="0.1" name="avg_rating" value="<?= $editData['avg_rating'] ?? '' ?>" required><br>

    <label>Director:</label>
    <select name="directorID" required>
        <option value="">-- Select Director --</option>
        <?php foreach ((new Director())->getAllDirectors() as $d): ?>
            <option value="<?= $d['directorID'] ?>"
                <?= (isset($editData) && $editData['directorID'] == $d['directorID']) ? 'selected' : '' ?>>
                <?= $d['directorID'] ?> - <?= $d['name'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit" name="<?= $editData ? 'update' : 'add' ?>">
        <?= $editData ? 'Update Movie' : 'Add Movie' ?>
    </button>
</form>

<hr>

<!-- Form Pencarian -->
<form method="GET" action="index.php">
    <input type="text" name="search" placeholder="Search by Title" value="<?= htmlspecialchars($searchQuery) ?>">
    <input type="hidden" name="page" value="movies">
    <button type="submit">Search</button>
</form>

<hr>

<!-- Tabel Movie -->
<table border="1">
    <tr>
        <th>ID</th><th>Title</th><th>Release Date</th><th>Avg Rating</th><th>Director</th><th>Actions</th>
    </tr>
    <?php
    if ($searchQuery) {
        $movies = $movie->searchMoviesByTitle($searchQuery);
    } else {
        $movies = $movie->getAllMovies();
    }

    if (empty($movies)) {
        echo "<tr><td colspan='6'>No movies found matching your search.</td></tr>";
    } else {
        foreach ($movies as $m): ?>
            <tr>
                <td><?= $m['movieID'] ?></td>
                <td><?= $m['title'] ?></td>
                <td><?= $m['release_date'] ?></td>
                <td><?= $m['avg_rating'] ?></td>
                <td>
                    <?php
                    $d = (new Director())->getDirectorById($m['directorID']);
                    echo $d ? $d['name'] : '-';
                    ?>
                </td>
                <td>
                    <a href="?page=movies&edit=<?= $m['movieID'] ?>">Edit</a> |
                    <a href="?page=movies&delete=<?= $m['movieID'] ?>" onclick="return confirm('Delete this movie?')">Delete</a>
                </td>
            </tr>
        <?php endforeach;
    }
    ?>
</table>
