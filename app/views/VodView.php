<div>
    <h1><?php echo $vod["title"] ?></h1>
    <h2><?php echo $vod["director_first_name"] . " " . $vod["director_last_name"] ?></h2>
    <p><?php echo $vod["long_plot"] ?></p>

    <h2>Actors</h2>
    <ul style="list-style-type:none">
        <?php if (isset($vod["actors"])) : ?>
            <?php foreach (explode(", ", $vod["actors_array"]) as $actor) { ?>
                <li><?php echo $actor ?></li>
            <?php }
            ?>
        <?php else : ?>
            <li>No actors found</li>
        <?php endif; ?>
    </ul>

    <p><?php echo $vod["price"] ?></p>

    <div style="display: flex; flex-wrap: wrap; justify-content: space-around;">
        <div style="display: flex; width: 50%;">
            <img style="width: 100%;" src="<?php echo $vod["image"] ?>" alt="<?php echo $vod["title"] ?>">
        </div>
        <div style="display: flex; width: 50%;">
            <iframe style="width: 100%;" src="<?php echo $vod["trailer"] ?>" frameborder="0"
                    allowfullscreen=""></iframe>
        </div>
    </div>
</div>
