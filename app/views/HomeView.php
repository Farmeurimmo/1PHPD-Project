
<h1>Home</h1>
<section id="about">
    <h2>About</h2>
    <p>about about about about about about about about about about about about 
        about about about about about about about about about about about about 
        about about about about about about about about about about about about  
        about about about about about</p>
</section>

<section id="recomended">
    <h2>Recomended</h2>

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
</section>