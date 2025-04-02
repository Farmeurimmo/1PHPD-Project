<?php

class Vod {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getVods($page = 1, $category = null, $search = null) {
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
        GROUP BY vods.id
        LIMIT :limit OFFSET :offset
    ";

        $query = $this->db->prepare($sql);
        $searchParam = isset($search) ? "%$search%" : null;
        $categoryParam = isset($category) ? "%$category%" : null;

        $query->bindParam(':search', $searchParam);
        $query->bindParam(':category', $categoryParam);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}