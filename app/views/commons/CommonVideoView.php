<?php

function priceAndBuyButton($vod) {
    echo '<span class="buy-btn-container">';
    echo '<h4>' . htmlspecialchars($vod['price']) . '€</h4>';

    if (isset($_SESSION["username"]) && isset($_SESSION["userId"])) {
        $user = new User();
        $vod_list = $user->getUserFilms($_SESSION["userId"]);
        $vod_ids = array_column($vod_list, 'id');
        if (in_array($vod['id'], $vod_ids)) {
            echo '<form method="post" class="cart-form" action="#">';
            echo '<input type="hidden" name="vod_id" value="' . htmlspecialchars($vod['id']) . '">';
            echo '<button type="submit" class="add-to-cart-button">';
            echo '<i class="fa-solid fa-check"></i>';
            echo '</button>';
            echo '</form>';
        } else {
            $vods = isset($_COOKIE["cart"]) ? json_decode($_COOKIE["cart"], true) : [];
            $add = false;
            if (isset($vods[$vod['id']])) {
                $add = true;
            }
            echo '<form method="post" class="cart-form" action="/1PHPD/cart/' . ($add ? 'remove' : 'add') . '">';
            echo '<input type="hidden" name="vod_id" value="' . htmlspecialchars($vod['id']) . '">';
            echo '<button type="submit" class="add-to-cart-button">';

            if (isset($vods[$vod['id']])) {
                echo '<i class="fa-solid fa-trash"></i>';
            } else {
                echo '<i class="fa-solid fa-cart-plus"></i>';
            }

            echo '</button>';
            echo '</form>';
        }
    } else {
        echo '<a href="/1PHPD/auth/">';
        echo '<input type="hidden" name="vod_id" value="' . htmlspecialchars($vod['id']) . '">';
        echo '<button type="submit" class="add-to-cart-button">';
        echo '<i class="fa-solid fa-cart-plus"></i>';
        echo '</button>';
        echo '</a>';
    }
    echo '</span>';
}

function videoCard($vod) {
    include_once __DIR__ . "/../../models/User.php";
    echo '<a class="card" href="/1PHPD/vod/' . $vod['id'] . '">';
    echo '<img src="' . htmlspecialchars($vod['image']) . '" alt="' . htmlspecialchars($vod['title']) . '" loading="lazy">';
    echo '<div class="cardinfo">';
    echo '<h3>' . htmlspecialchars($vod['title']) . '</h3>';
    priceAndBuyButton($vod);
    echo '<p>' . htmlspecialchars($vod['plot']) . '</p>';
    echo '</div>';
    echo '</a>';
}

?>