
<h1>Internet Movies DataBase & co</h1>
<section id="about">
    <h2>About</h2>
    <p>Internet Movies DataBase & co is your one-stop platform for all things 
        movies! Discover detailed information about your favorite films, 
        including cast, director, genres, and captivating plot summaries. Whether 
        you're looking for the latest blockbusters or timeless classics, we've 
        got you covered. Plus, you can purchase movies directly from our 
        platform to enjoy them anytime, anywhere.</p>
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