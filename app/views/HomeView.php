<p>This is the home view.</p>

<ul>
    <?php if (count($vods) > 0) : ?>

        <?php foreach ($vods as $vod): ?>
            <li>
                <h2><?php echo htmlspecialchars($vod['title']); ?></h2>
                <p>Director: <?php echo htmlspecialchars($vod['first_name'] . ' ' . $vod['last_name']); ?></p>
                <p>Price: <?php echo htmlspecialchars($vod['price']); ?></p>
                <p>Release Date: <?php echo htmlspecialchars($vod['release_date']); ?></p>
                <p>Category: <?php echo htmlspecialchars($vod['categories_array']); ?></p>
                <p><?php echo htmlspecialchars($vod['short_plot']); ?></p>
                <img src="<?php echo htmlspecialchars($vod['image']); ?>"
                     alt="<?php echo htmlspecialchars($vod['title']); ?>"/>
            </li>
        <?php endforeach; ?>

    <?php else: ?>
        <li>No VODs available.</li>
    <?php endif; ?>
</ul>
