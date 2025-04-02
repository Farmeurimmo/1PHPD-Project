<?php
    function videoCard($vod) {
        echo '<div class="card">';
        echo '<img src="' . htmlspecialchars($vod['image']) . '" alt="' . htmlspecialchars($vod['title']) . '">';
        echo '<div class="cardinfo">';
        echo '<h3>' . htmlspecialchars($vod['title']) . '</h3>';
        echo '<h4>' . htmlspecialchars($vod['price']) . '€</h4>';
        echo '<p>' . htmlspecialchars($vod['short_plot']) . '</p>';
        echo '<i class="fa-solid fa-cart-plus"></i>';
        echo '</div>';
        echo '</div>';
    }
?>