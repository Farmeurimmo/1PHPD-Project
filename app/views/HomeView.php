<p>This is the home view.</p>

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
