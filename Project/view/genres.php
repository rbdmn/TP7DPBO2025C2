<?php
require_once 'class/Genre.php';
$genre = new Genre();

// Handle add/update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        if ($_POST['id'] === '') {
            $genre->addGenre($_POST['genre_name']);
        } else {
            $genre->updateGenre($_POST['id'], $_POST['genre_name']);
        }
        header("Location: ?page=genres");
        exit;
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $genre->deleteGenre($_GET['delete']);
    header("Location: ?page=genres");
    exit;
}

// Handle edit
$editData = null;
if (isset($_GET['edit'])) {
    $editData = $genre->getGenreById($_GET['edit']);
}
?>

<h3><?= $editData ? "Edit Genre" : "Add Genre" ?></h3>
<form method="POST">
    <input type="hidden" name="id" value="<?= $editData['genreID'] ?? '' ?>">
    <input type="text" name="genre_name" placeholder="Genre Name" required value="<?= $editData['genre_name'] ?? '' ?>">
    <button type="submit" name="save">Save</button>
</form>

<h3>Genre List</h3>
<table border="1">
    <tr>
        <th>ID</th><th>Genre</th><th>Actions</th>
    </tr>
    <?php foreach ($genre->getAllGenres() as $g): ?>
    <tr>
        <td><?= $g['genreID'] ?></td>
        <td><?= $g['genre_name'] ?></td>
        <td>
            <a href="?page=genres&edit=<?= $g['genreID'] ?>">Edit</a> |
            <a href="?page=genres&delete=<?= $g['genreID'] ?>" onclick="return confirm('Delete this genre?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
