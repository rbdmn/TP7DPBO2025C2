<?php
require_once 'config/db.php';

class Director {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllDirectors() {
        $stmt = $this->db->query("SELECT * FROM directors");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addDirector($name, $nationality, $age) {
        $stmt = $this->db->prepare("INSERT INTO directors (name, nationality, age) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $nationality, $age]);
    }

    public function getDirectorById($id) {
        $stmt = $this->db->prepare("SELECT * FROM directors WHERE directorID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateDirector($id, $name, $nationality, $age) {
        $stmt = $this->db->prepare("UPDATE directors SET name = ?, nationality = ?, age = ? WHERE directorID = ?");
        return $stmt->execute([$name, $nationality, $age, $id]);
    }

    public function deleteDirector($id) {
        $stmt = $this->db->prepare("DELETE FROM directors WHERE directorID = ?");
        return $stmt->execute([$id]);
    }
}
?>
