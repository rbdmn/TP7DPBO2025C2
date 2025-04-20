<?php
require_once 'config/db.php';

class Movie_actor {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAll() {
        $stmt = $this->db->query("
            SELECT 
                ma.id, 
                a.name AS actor_name, 
                m.title AS movie_title,
                ma.role_name
            FROM movie_actors ma
            JOIN actors a ON ma.actorID = a.actorID
            JOIN movies m ON ma.movieID = m.movieID
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function add($actorID, $movieID) {
        $stmt = $this->db->prepare("INSERT INTO movie_actors (actorID, movieID) VALUES (?, ?)");
        return $stmt->execute([$actorID, $movieID]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM movie_actors WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
