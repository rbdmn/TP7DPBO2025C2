<?php
require_once 'class/Actor.php';
require_once 'class/Director.php';
require_once 'class/Genre.php';
require_once 'class/Movie_actor.php';
require_once 'class/Movie_genre.php';
require_once 'class/Movie.php';

$actor = new Actor();
$director = new Director();
$genre = new Genre();
$movie_actor = new Movie_actor();
$movie_genre = new Movie_genre();
$movie = new Movie();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDB ripoff zero waste</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="imdb_logo.jpg">
</head>
<body>
    <main>
        <h2>IMDB RIPOFF</h2>
        <nav class="center-nav">
            <a href="?page=actors">Actors</a> |
            <a href="?page=directors">Directors</a> |
            <a href="?page=genres">Genres</a> |
            <a href="?page=movies">Movies</a>

            <?php if (isset($_GET['page']) && $_GET['page'] === 'movies'): ?>
                | <a href="?page=movie_actors">Movie_actors</a>
                | <a href="?page=movie_genres">Movie_genres</a>
            <?php endif; ?>
        </nav>

        <hr>

        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == 'actors') include 'view/actors.php';
            elseif ($page == 'directors') include 'view/directors.php';
            elseif ($page == 'genres') include 'view/genres.php';
            elseif ($page == 'movie_actors') include 'view/movie_actors.php';
            elseif ($page == 'movie_genres') include 'view/movie_genres.php';
            elseif ($page == 'movies') include 'view/movies.php';
        }
        ?>
    </main>
</body>
</html>
<img src="the_chosen_one.jpeg" alt="the_chosen_one" id="bottom-right-img">