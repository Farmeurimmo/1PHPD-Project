<h2><?php echo $category ?> category</h2>

<div class="vods">
    <?php foreach ($vods as $vod) : ?>
        <div class="vod">
            <a href="/1PHPD/vod/<?php echo $vod["id"] ?>">
                <img src="<?php echo $vod["image"] ?>" alt="<?php echo $vod["title"] ?>" width="200" height="200">
                <h3><?php echo $vod["title"] ?></h3>
            </a>
        </div>
    <?php endforeach; ?>
</div>
