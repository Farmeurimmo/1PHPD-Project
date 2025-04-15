<h1><?php echo $director[0]["first_name"] . " " . $director[0]["last_name"]; ?></h1>
<h2>Filmography</h2>
<div class="grid">
    <?php if (count($director) > 0) : ?>
        <?php include_once "commons/CommonVideoView.php"; ?>

        <?php foreach ($director as $vod): ?>
            <?php videoCard($vod) ?>
        <?php endforeach; ?>

    <?php else: ?>
        <li>No VODs available.</li>
    <?php endif; ?>
</div>