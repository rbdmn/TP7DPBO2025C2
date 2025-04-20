<?php
require_once 'config/db.php';

class Movie {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllMovies() {
        $stmt = $this->db->query("SELECT * FROM movies");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addMovie($directorID, $title, $release_date, $avg_rating) {
        $stmt = $this->db->prepare("INSERT INTO movies (directorID, title, release_date, avg_rating) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$directorID, $title, $release_date, $avg_rating]);
    }

    public function deleteMovie($id) {
        $stmt = $this->db->prepare("DELETE FROM movies WHERE movieID = ?");
        return $stmt->execute([$id]);
    }

    public function getMovieById($id) {
        $stmt = $this->db->prepare("SELECT * FROM movies WHERE movieID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateMovie($id, $directorID, $title, $release_date, $avg_rating) {
        $stmt = $this->db->prepare("UPDATE movies SET directorID = ?, title = ?, release_date = ?, avg_rating = ? WHERE movieID = ?");
        return $stmt->execute([$directorID, $title, $release_date, $avg_rating, $id]);
    }

    public function searchMoviesByTitle($title) {
        $title = "%" . $title . "%"; // Menambahkan wildcard untuk pencarian lebih fleksibel
        $stmt = $this->db->prepare("SELECT * FROM movies WHERE title LIKE ?");
        $stmt->execute([$title]); // Menggunakan array untuk menyisipkan parameter
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Mengembalikan hasil pencarian
    }
}
