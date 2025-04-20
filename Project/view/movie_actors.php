<?php
require_once 'class/Movie_actor.php';
require_once 'class/Actor.php';
require_once 'class/Movie.php';

$movie_actor = new Movie_actor();
$actor = new Actor();
$movie = new Movie();

// Handle add
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $movie_actor->add($_POST['actorID'], $_POST['movieID']);
        header("Location: ?page=movie_actors");
        exit;
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $movie_actor->delete($_GET['delete']);
    header("Location: ?page=movie_actors");
    exit;
}
?>

<h3>Movie Actors List</h3>
<form method="POST">
    <label>Actor:</label>
    <select name="actorID" required>
        <option value="">-- Select Actor --</option>
        <?php foreach ($actor->getAllActors() as $a): ?>
            <option value="<?= $a['actorID'] ?>"><?= $a['actorID'] ?> - <?= $a['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Movie:</label>
    <select name="movieID" required>
        <option value="">-- Select Movie --</option>
        <?php foreach ($movie->getAllMovies() as $m): ?>
            <option value="<?= $m['movieID'] ?>"><?= $m['movieID'] ?> - <?= $m['title'] ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit" name="add">Add Movie Actor</button>
</form>

<table border="1">
    <tr>
        <th>ID</th><th>Actor</th><th>Movie</th><th>Actions</th>
    </tr>
    <?php foreach ($movie_actor->getAll() as $ma): ?>
    <tr>
        <td><?= $ma['id'] ?></td>
        <td><?= $ma['actor_name'] ?></td>
        <td><?= $ma['movie_title'] ?></td>
        <td>
            <a href="?page=movie_actors&delete=<?= $ma['id'] ?>" onclick="return confirm('Delete this entry?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
