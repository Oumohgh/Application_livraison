<?php

Class Controller {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function index() {

        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);

        switch ($page) {
            case ($page === "show"):
                $this->db->readAll('director');
                require "views/show.php";
                break;

            case ($page === "show_movies"):
                $id = $_GET['id'];
                $this->db->readMovies('films', $id);
                $id = $_GET['id'];
                $director = $this->db->getById('director', $id);
                require "views/show_.php";
                break;

            case ($page === "delete_commande"):
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $this->db->delete('commande',$id);
                }
                require "views/show.php";
                break;

            case ($page === "delete_commande"):
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $this->db->delete('coommands',$id);
                    header('Location: /index.php?page=show');
                    exit();
                }
                require "views/show_.php";
                break;

            case ($page === "create_"):
                if (isset($_POST['insert_'])) {
                    $movie = new ();
                    $movie->setDirectorId($_POST['director_id']);
                    $movie->setTitle($_POST['title']);
                    $movie->setAltTitle($_POST['alt_title']);
                    $movie->setYear($_POST['year']);
                    $insert_success_movie = $this->createMovies($movie);
                    header('Location: /index.php?page=show&insert_success_=' . (bool)$insert_success_movie . '&id=' . $movie->getId());
                    exit();
                }
                require "views/create.php";
                break;

            case ($page === "create_"):
                if (isset($_POST['insert_'])) {
                    $director = new  ();
                    $director->setName($_POST['name']);
                    $director->setBirthYear($_POST['birth_year']);
                    $director->setNationality($_POST['nationality']);
                    $insert_success_director = $this->createDirector($director);
                    header('Location: /index.php?page=show&insert_success_=' . (bool)$insert_success_director . '&id=' . $director->getId());
                    exit();
                }
                require "views/create_.php";
                break;

            case ($page === "update"):
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $movie = $this->db->getById('films', $id);
                    require "views/update.php";
                }
                break;

            case ($page === "do_update"):
                if (isset($_POST['update_'])) {
                    $movie = new ($_POST);
                    $update_success_movie = $this->updateMovies($movie);
                    header('Location: /index.php?page=show&update_success_=' . (int)$update_success_movie . '&id=' . $movie->getId());
                    exit();
                }
                break;

            case ($page === "update_"):
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $director = $this->db->getById('', $id);
                    require "views/update_.php";
                }
                break;

            case ($page === "do_update_"):
                if (isset($_POST['update_'])) {
                    $director = new ($_POST);
                    $update_success_director = $this->updateDirector($director);
                    header('Location: /index.php?page=show&update_success_director=' . (int)$update_success_director . '&id=' . $director->getId());
                    exit();
                }
                break;

            default:
                require "views/start.php";
                break;
        }
    }

    public function updateMovies(Movie $movie) {
        return $this->db->update('films', $movie->getId(), $movie->toArray());
    }

    public function updateDirector(Director $director) {
        return $this->db->update('director', $director->getId(), $director->toArray());
    }

    public function createMovies(Movie $movie) {
        return $this->db->create('films', $movie->toArray());
    }

    public function createDirector(Director $director) {
        return $this->db->create('director', $director->toArray());
    }

    public function success() {
        if (isset($_GET['insert_success_movie']) && $_GET['insert_success_movie']) {
            echo "<p>Your movie was successfully inserted! If you want to see your movie click <a href='/index.php?page=update_movie&id=" .$_GET['id']. "'>Here</a></p>";
        }
        elseif (isset($_GET['insert_success_director']) && $_GET['insert_success_director']) {
            echo "<p>Your director was successfully inserted! If you want to see your director click <a href='/index.php?page=update_director&id=" .$_GET['id']. "'>Here</a></p>";
        }
        elseif (isset($_GET['insert_success_movie']) && !$_GET['insert_success_movie']) {
            echo "<p>Something went wrong!</p>";
        }
        elseif (isset($_GET['insert_success_director']) && !$_GET['insert_success_director']) {
            echo "<p>Something went wrong!</p>";
        }
    }

    public function updateSuccess() {
        if (isset($_GET['update_success_movie']) && $_GET['update_success_movie']) {
            echo "<p>Your movie was successfully updated! If you want to see your movie click <a href='/index.php?page=update_movie&id=" .$_GET['id']. "'>Here</a></p>";
        }
        elseif (isset($_GET['update_success_director']) && $_GET['update_success_director']) {
            echo "<p>Your director was successfully updated! If you want to see your director click <a href='/index.php?page=update_director&id=" .$_GET['id']. "'>Here</a></p>";
        }
        elseif (isset($_GET['update_success_movie']) && !$_GET['update_success_movie']) {
            echo "<p>Something went wrong!</p>";
        }
        elseif (isset($_GET['update_success_director']) && !$_GET['update_success_director']) {
            echo "<p>Something went wrong!</p>";
        }
    }
  }