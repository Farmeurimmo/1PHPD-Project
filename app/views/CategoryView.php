<h1><?php echo $category ?></h1>
<?php include_once "commons/CommonSearchBarView.php"; ?>
<?php searchBar($categories, $directors, $category); ?>

<h2>Movies from the <?php echo strtolower($category) ?> category</h2>
<div class="grid">
    <?php if (count($vods) > 0) : ?>
        <?php include_once "commons/CommonVideoView.php"; ?>

        <?php foreach ($vods as $vod): ?>
            <?php videoCard($vod) ?>
        <?php endforeach; ?>

    <?php else: ?>
        <li>No VODs available.</li>
    <?php endif; ?>
</div>
