<h1>My cart</h1>

<?php
include_once 'commons/CommonVideoView.php';
$_total = 0;
?>
<div class="cart-page">
    <section id="items">
        <div class="delete-all">
            <h2>My Items</h2>
            <form method="post" class="cart-form" action="/1PHPD/cart/removeall">
                <button type="submit" class="add-to-cart-button">
                    <i class="fa-solid fa-trash"></i> Delete All
                </button>
            </form>
        </div>
        <div class="cart-tab">
            <?php if (empty($cart)): ?>
                <p>Your cart is empty.</p>
            <?php else: ?>
                <?php foreach ($cart as $item): ?>
                    <div class="cart-item">
                        <h3><?php echo $item['title']; ?></h3>
                        <div>
                            <form method="post" class="cart-form" action="/1PHPD/cart/remove">
                                <input type="hidden" name="vod_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                <button type="submit" class="add-to-cart-button">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            <p><?php echo $item['price']; ?>€</p>
                            <?php $_total += $item['price'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
    <section id="total">
        <div>
            <h2>Total:</h2>
            <p><?php echo $_total; ?>€</p>
        </div>
        <form method="post" action="/1PHPD/my/cart/checkout">
            <button type="submit" class="buy-btn">Buy</button>
        </form>
    </section>
</div>
