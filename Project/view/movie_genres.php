<?php
require_once 'class/Movie_genre.php';
require_once 'class/Genre.php';
require_once 'class/Movie.php';

$movie_genre = new Movie_genre();
$genre = new Genre();
$movie = new Movie();

// Handle add
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $movie_genre->add($_POST['genreID'], $_POST['movieID']);
        header("Location: ?page=movie_genres");
        exit;
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $movie_genre->delete($_GET['delete']);
    header("Location: ?page=movie_genres");
    exit;
}
?>

<h3>Movie Genres List</h3>
<form method="POST">
    <label>Genre:</label>
    <select name="genreID" required>
        <option value="">-- Select Genre --</option>
        <?php foreach ($genre->getAllGenres() as $g): ?>
            <option value="<?= $g['genreID'] ?>"><?= $g['genreID'] ?> - <?= $g['genre_name'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Movie:</label>
    <select name="movieID" required>
        <option value="">-- Select Movie --</option>
        <?php foreach ($movie->getAllMovies() as $m): ?>
            <option value="<?= $m['movieID'] ?>"><?= $m['movieID'] ?> - <?= $m['title'] ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit" name="add">Add Movie Genre</button>
</form>

<table border="1">
    <tr>
        <th>ID</th><th>Genre</th><th>Movie</th><th>Actions</th>
    </tr>
    <?php foreach ($movie_genre->getAll() as $mg): ?>
    <tr>
        <td><?= $mg['id'] ?></td>
        <td><?= $mg['genre_name'] ?></td>
        <td><?= $mg['movie_title'] ?></td>
        <td>
            <a href="?page=movie_genres&delete=<?= $mg['id'] ?>" onclick="return confirm('Delete this entry?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
