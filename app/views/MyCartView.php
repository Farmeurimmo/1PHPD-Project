<h1>My cart</h1>

<?php include_once 'commons/CommonVideoView.php'; ?>

<div class="grid">
    <?php if (empty($cart)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <?php foreach ($cart as $item): ?>
            <?php videoCard($item); ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<h2>Buying</h2>
<form method="post" action="/1PHPD/my/cart/checkout">
    <button type="submit" class="checkout-button">Checkout</button>
</form>