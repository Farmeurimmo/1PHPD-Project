<?php if (!empty($vod)) : ?>
    <h1><?php echo $vod["title"] ?></h1>
    <h2>Informations</h2>
    <div class="vod-infos">
        <div class="image-container">
            <img src="<?php echo $vod["image"] ?>" alt="<?php echo $vod["title"] ?>">
        </div>
        <div class="info-container">
            <h3>Director: </h3>
            <a href="/1PHPD/director/<?php echo $vod["director_id"]; ?>"><?php echo $vod["director_first_name"] . " " . $vod["director_last_name"] ?></a>
            <h3>Actors: </h3>
            <p><?php if (isset($vod["actors_array"])) : ?>
                <?php foreach (explode(", ", $vod["actors_array"]) as $actor) {
                    echo "$actor, ";
                }
                ?>
            <?php else : ?>
                <p>No actors found</p>
            <?php endif; ?></p>
            <h3>Release date: </h3>
            <p><?php echo $vod["release_date"] ?></p>

            <?php
                include_once "commons/CommonVideoView.php";
                priceAndBuyButton($vod);
            ?>

            <h3>Long plot</h3>
            <p><?php echo $vod["long_plot"] ?></p>
        </div>
    </div>
<?php else : ?>
    <div>
        <h1>Vod not found</h1>
    </div>
<?php endif; ?>
