<?php

class Vod {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getVods($page = 1, $category = null, $search = null, $director = null) {
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $sql = "
        SELECT DISTINCT 
            vods.id, vods.image, vods.title, vods.short_plot, vods.director_id, vods.price, vods.release_date,
            directors.first_name, directors.last_name,
            GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.name SEPARATOR ', ') AS categories_array
        FROM vods
        INNER JOIN vod_categories ON vod_categories.vod_id = vods.id
        INNER JOIN categories ON vod_categories.category_id = categories.id
        INNER JOIN directors ON vods.director_id = directors.id
        WHERE (:search IS NULL OR vods.title LIKE :search)
        AND (:category IS NULL OR categories.name LIKE :category)
        AND (
            :director = '' OR 
            directors.first_name LIKE :director OR 
            directors.last_name LIKE :director OR 
            CONCAT(directors.first_name, ' ', directors.last_name) LIKE :director OR 
            CONCAT(directors.last_name, ' ', directors.first_name) LIKE :director
        )
        GROUP BY vods.id
        LIMIT :limit OFFSET :offset
    ";

        $query = $this->db->prepare($sql);
        $searchParam = isset($search) ? "%$search%" : null;
        $categoryParam = isset($category) ? "%$category%" : null;
        $directorParam = isset($director) ? "%$director%" : null;

        $query->bindParam(':search', $searchParam);
        $query->bindParam(':category', $categoryParam);
        $query->bindParam(':director', $directorParam);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVodData($id) {
        $sql = "
        SELECT 
            vods.id,
            vods.image,
            vods.title,
            vods.short_plot,
            vods.long_plot,
            vods.director_id,
            vods.price,
            vods.release_date,
            directors.first_name AS director_first_name,
            directors.last_name AS director_last_name,
            GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.name SEPARATOR ', ') AS categories_array,
            GROUP_CONCAT(DISTINCT CONCAT(actors.first_name, ' ', actors.last_name) ORDER BY actors.last_name SEPARATOR ', ') AS actors_array
        FROM vods
        INNER JOIN vod_categories ON vod_categories.vod_id = vods.id
        INNER JOIN categories ON vod_categories.category_id = categories.id
        INNER JOIN directors ON vods.director_id = directors.id
        LEFT JOIN actor_films ON actor_films.vod_id = vods.id
        LEFT JOIN actors ON actor_films.actor_id = actors.id
        WHERE vods.id = :id
        GROUP BY vods.id
        ";

        $query = $this->db->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getFilmTitle($vodId) {
        $sql = "SELECT title FROM vods WHERE id = :vodId";
        $query = $this->db->prepare($sql);
        $query->bindParam(':vodId', $vodId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchColumn();
    }

    public function getDirectors() {
        $sql = "SELECT DISTINCT first_name, last_name, CONCAT(first_name, ' ', last_name) AS full_name FROM directors";

        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategories() {
        $sql = "SELECT DISTINCT name FROM categories";

        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}