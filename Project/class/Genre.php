<?php
require_once 'config/db.php';

class Genre {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllGenres() {
        $stmt = $this->db->query("SELECT * FROM genres");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addGenre($name) {
        $stmt = $this->db->prepare("INSERT INTO genres (genre_name) VALUES (?)");
        return $stmt->execute([$name]);
    }

    public function getGenreById($id) {
        $stmt = $this->db->prepare("SELECT * FROM genres WHERE genreID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateGenre($id, $name) {
        $stmt = $this->db->prepare("UPDATE genres SET genre_name = ? WHERE genreID = ?");
        return $stmt->execute([$name, $id]);
    }

    public function deleteGenre($id) {
        $stmt = $this->db->prepare("DELETE FROM genres WHERE genreID = ?");
        return $stmt->execute([$id]);
    }
}
