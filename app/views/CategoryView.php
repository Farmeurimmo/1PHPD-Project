<h2><?php echo $category ?> category</h2>

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
