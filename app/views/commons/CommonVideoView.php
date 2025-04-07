<?php
    function videoCard($vod) {
        echo '<div class="card">';
        echo '<img src="' . htmlspecialchars($vod['image']) . '" alt="' . htmlspecialchars($vod['title']) . '">';
        echo '<div class="cardinfo">';
        echo '<h3>' . htmlspecialchars($vod['title']) . '</h3>';
        echo '<span>';
        echo '<h4>' . htmlspecialchars($vod['price']) . '€</h4>';
  
        echo '<form method="post" action="/1PHPD/cart/add">';
        echo '<input type="hidden" name="vod_id" value="' . htmlspecialchars($vod['id']) . '">';
        echo '<button type="submit" class="add-to-cart-button">';
        echo '<i class="fa-solid fa-cart-plus"></i>';
        echo '</button>';
        echo '</form>';
  
        echo '</span>';
        echo '<p>' . htmlspecialchars($vod['short_plot']) . '</p>';
        echo '</div>';
        echo '</div>';
    }
?>