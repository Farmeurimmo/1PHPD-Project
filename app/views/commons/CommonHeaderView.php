<nav>
    <div id="navigation">
        <ul>
            <li><a href="#">Home</a></li>
            <li>
                <span>Category</span>
                <ul class="category">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Comedy</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <?php if (isset($_SESSION["username"])) : ?>
        <div class="users" id="conected" style="display: flex; gap: 30px;">
            <span><i class="fa-solid fa-cart-shopping"></i></span>
            <a href="/1PHPD/my/profile">
                <span><i class="fa-solid fa-user"></i></span>
                <span><?php echo $_SESSION["username"]; ?></span>
            </a>
        </div>
    <?php else : ?>
        <div class="users" id="notconected" style="display: flex;">
            <span><a href="/1PHPD/auth/">Sign In/Sign Up</a></span>
        </div>
    <?php endif; ?>
</nav>