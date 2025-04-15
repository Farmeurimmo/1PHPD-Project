<?php if (!empty($vod)) : ?>
    <div>
        <h1><?php echo $vod["title"] ?></h1>
        <h2><?php echo $vod["director_first_name"] . " " . $vod["director_last_name"] ?></h2>
        <p><?php echo $vod["long_plot"] ?></p>

        <h2>Actors</h2>
        <ul style="list-style-type:none">
            <?php if (isset($vod["actors_array"])) : ?>
                <?php foreach (explode(", ", $vod["actors_array"]) as $actor) { ?>
                    <li><?php echo $actor ?></li>
                <?php }
                ?>
            <?php else : ?>
                <li>No actors found</li>
            <?php endif; ?>
        </ul>

        <p><?php echo $vod["price"] ?></p>

        <div style="display: flex; flex-wrap: wrap; justify-content: space-around; max-width: 400px">
            <img style="width: 100%;" src="<?php echo $vod["image"] ?>" alt="<?php echo $vod["title"] ?>">
        </div>
    </div>
<?php else : ?>
    <div>
        <h1>Vod not found</h1>
    </div>
<?php endif; ?>
