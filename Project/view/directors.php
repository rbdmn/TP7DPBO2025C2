<?php
require_once 'class/Director.php';
$director = new Director();

// Handle add/update/delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        if ($_POST['id'] === '') {
            $director->addDirector($_POST['name'], $_POST['nationality'], $_POST['age']);
        } else {
            $director->updateDirector($_POST['id'], $_POST['name'], $_POST['nationality'], $_POST['age']);
        }
        header("Location: ?page=directors");
        exit;
    }
}

if (isset($_GET['delete'])) {
    $director->deleteDirector($_GET['delete']);
    header("Location: ?page=directors");
    exit;
}

$editData = null;
if (isset($_GET['edit'])) {
    $editData = $director->getDirectorById($_GET['edit']);
}
?>

<h3><?= $editData ? "Edit director" : "Add director" ?></h3>
<form method="POST">
    <input type="hidden" name="id" value="<?= $editData['directorID'] ?? '' ?>">
    <input type="text" name="name" placeholder="Name" required value="<?= $editData['name'] ?? '' ?>">
    <input type="text" name="nationality" placeholder="Nationality" required value="<?= $editData['nationality'] ?? '' ?>">
    <input type="number" name="age" placeholder="Age" required value="<?= $editData['age'] ?? '' ?>">
    <button type="submit" name="save">Save</button>
</form>

<h3>Director List</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Nationality</th>
        <th>Age</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($director->getAllDirectors() as $b): ?>
    <tr>
        <td><?= $b['directorID'] ?></td>
        <td><?= $b['name'] ?></td>
        <td><?= $b['nationality'] ?></td>
        <td><?= $b['age'] ?></td>
        <td>
            <a href="?page=directors&edit=<?= $b['directorID'] ?>">Edit</a> | 
            <a href="?page=directors&delete=<?= $b['directorID'] ?>" onclick="return confirm('Delete this director?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
