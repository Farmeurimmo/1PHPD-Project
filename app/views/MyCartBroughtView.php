<?php if (isset($_SESSION["errorMessage"])) : ?>

    <div class="error">
        <p><?php echo $_SESSION["errorMessage"]; ?></p>
    </div>
    <?php unset($_SESSION["errorMessage"]); ?>

<?php else: ?>

    <?php if (isset($cart)) : ?>

        <div class="cart">
            <h1>You successfully bought:</h1>

            <div class="cart-tab">
                <?php foreach ($cart as $item): ?>
                    <div class="cart-item">
                        <h2><?php echo $item["title"]; ?></h2>
                        <p>Price: <?php echo $item["price"]; ?>$</p>
                    </div>
                <?php endforeach; ?>
            </div>

            <h2>Total Price: <?php echo $totalPrice; ?>$</h2>
        </div>

    <?php else: ?>
        <div class="error">
            <p>You didn't buy anything.</p>
        </div>
    <?php endif; ?>

<?php endif; ?>
