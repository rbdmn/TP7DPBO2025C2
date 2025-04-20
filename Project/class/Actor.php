<?php
require_once 'config/db.php';

class Actor {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllActors() {
        $stmt = $this->db->query("SELECT * FROM actors");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addActor($name, $nationality, $age) {
        $stmt = $this->db->prepare("INSERT INTO actors (name, nationality, age) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $nationality, $age]);
    }

    public function getActorById($id) {
        $stmt = $this->db->prepare("SELECT * FROM actors WHERE actorID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateActor($id, $name, $nationality, $age) {
        $stmt = $this->db->prepare("UPDATE actors SET name = ?, nationality = ?, age = ? WHERE actorID = ?");
        return $stmt->execute([$name, $nationality, $age, $id]);
    }

    public function deleteActor($id) {
        $stmt = $this->db->prepare("DELETE FROM actors WHERE actorID = ?");
        return $stmt->execute([$id]);
    }
}
?>
