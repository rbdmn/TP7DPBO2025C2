<?php
require_once 'config/db.php';

class Movie_genre {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAll() {
        $stmt = $this->db->query("
            SELECT 
                mg.id, 
                g.genre_name, 
                m.title AS movie_title
            FROM movie_genres mg
            JOIN genres g ON mg.genreID = g.genreID
            JOIN movies m ON mg.movieID = m.movieID
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($genreID, $movieID) {
        $stmt = $this->db->prepare("INSERT INTO movie_genres (genreID, movieID) VALUES (?, ?)");
        return $stmt->execute([$genreID, $movieID]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM movie_genres WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
