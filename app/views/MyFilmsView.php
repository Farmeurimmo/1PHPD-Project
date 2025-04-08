<h1>This your films list</h1>

<?php include_once 'commons/CommonVideoView.php'; ?>

<div class="grid">
    <?php if (empty($films)): ?>
        <p>Your films list is empty.</p>
    <?php else: ?>
        <?php foreach ($films as $item): ?>
            <?php videoCard($item, false); ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>