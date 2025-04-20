<?php
require_once 'class/Actor.php';
$actor = new Actor();

// Handle add/update/delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        if ($_POST['id'] === '') {
            $actor->addActor($_POST['name'], $_POST['nationality'], $_POST['age']);
        } else {
            $actor->updateActor($_POST['id'], $_POST['name'], $_POST['nationality'], $_POST['age']);
        }
        header("Location: ?page=actors");
        exit;
    }
}

if (isset($_GET['delete'])) {
    $actor->deleteActor($_GET['delete']);
    header("Location: ?page=actors");
    exit;
}

$editData = null;
if (isset($_GET['edit'])) {
    $editData = $actor->getActorById($_GET['edit']);
}
?>

<h3><?= $editData ? "Edit Actor" : "Add Actor" ?></h3>
<form method="POST">
    <input type="hidden" name="id" value="<?= $editData['actorID'] ?? '' ?>">
    <input type="text" name="name" placeholder="Name" required value="<?= $editData['name'] ?? '' ?>">
    <input type="text" name="nationality" placeholder="Nationality" required value="<?= $editData['nationality'] ?? '' ?>">
    <input type="number" name="age" placeholder="Age" required value="<?= $editData['age'] ?? '' ?>">
    <button type="submit" name="save">Save</button>
</form>

<h3>Actor List</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Nationality</th>
        <th>Age</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($actor->getAllActors() as $b): ?>
    <tr>
        <td><?= $b['actorID'] ?></td>
        <td><?= $b['name'] ?></td>
        <td><?= $b['nationality'] ?></td>
        <td><?= $b['age'] ?></td>
        <td>
            <a href="?page=actors&edit=<?= $b['actorID'] ?>">Edit</a> | 
            <a href="?page=actors&delete=<?= $b['actorID'] ?>" onclick="return confirm('Delete this actor?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
