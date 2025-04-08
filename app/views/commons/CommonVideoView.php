<?php
function videoCard($vod, $canBuy = true) {
    echo '<div class="card">';
    echo '<img src="' . htmlspecialchars($vod['image']) . '" alt="' . htmlspecialchars($vod['title']) . '">';
    echo '<div class="cardinfo">';
    echo '<h3>' . htmlspecialchars($vod['title']) . '</h3>';
    echo '<span>';
    echo '<h4>' . htmlspecialchars($vod['price']) . '€</h4>';

    if ($canBuy) {
        $vods = isset($_COOKIE["cart"]) ? json_decode($_COOKIE["cart"], true) : [];
        $add = false;
        if (isset($vods[$vod['id']])) {
            $add = true;
        }
        echo '<form method="post" class="cart-form" action="/1PHPD/cart/' . ($add ? 'remove' : 'add') . '">';
        echo '<input type="hidden" name="vod_id" value="' . htmlspecialchars($vod['id']) . '">';
        echo '<button type="submit" class="add-to-cart-button">';

        if (isset($vods[$vod['id']])) {
            echo '<i class="fa-solid fa-check"></i>';
        } else {
            echo '<i class="fa-solid fa-cart-plus"></i>';
        }

        echo '</button>';
        echo '</form>';
    }

    echo '</span>';
    echo '<p>' . htmlspecialchars($vod['short_plot']) . '</p>';
    echo '</div>';
    echo '</div>';
}

?>