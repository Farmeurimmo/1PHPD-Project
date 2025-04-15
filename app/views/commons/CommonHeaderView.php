<nav>
    <div class="hamburger">
        <span>☰</span>
    </div>
    <div class="nav" id="navigation">
        <a href="/1PHPD/">Home</a>
        <div class="dropdown">
            <button class="dropbtn">
                <span>Category</span>
            </button>
            <div class="dropdown-content">
                <a href="/1PHPD/category/crime">Crime</a>
                <a href="/1PHPD/category/drama">Drama</a>
            </div>
        </div>
    </div>

    <script>
        const hamburger = document.querySelector('.hamburger');
        const navigation = document.querySelector('.nav');

        hamburger.addEventListener('click', () => {
            if (navigation.id === 'navigation') {
                navigation.id = 'navigation-open';
            } else {
                navigation.id = 'navigation';
            }
        });
    </script>

    <?php if (isset($_SESSION["username"])) : ?>
        <div class="users" style="display: flex;">
            <div class="cartdiv">
                <a href="/1PHPD/my/cart"><i class="fa-solid fa-cart-shopping"></i>
                    <?php if (isset($_COOKIE["cart"])) : ?>
                        <?php
                        echo count(json_decode($_COOKIE["cart"], true));
                        ?>
                    <?php else : ?>
                        <?php echo 0; ?>
                    <?php endif; ?>
                </a>
            </div>

            <div class="dropdown">
                <button class="dropbtn">
                    <span><i class="fa-solid fa-user"></i></span>
                    <span><?php echo $_SESSION["username"]; ?></span>
                </button>
                <div class="dropdown-content">
                    <a href="/1PHPD/my/profile">My Profile</a>
                    <a href="/1PHPD/my/films">My Films</a>
                    <a href="/1PHPD/auth/logout">Sign Out</a>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="users" style="display: flex;">
            <span><a href="/1PHPD/auth/">Sign In/Sign Up</a></span>
        </div>
    <?php endif; ?>
</nav>