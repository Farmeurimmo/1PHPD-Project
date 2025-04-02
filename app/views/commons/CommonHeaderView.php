<nav>
    <div id="navigation">
        <ul id="navigation">
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
    <!-- If user not conected then id=notconected display flex -->
    <div class="users" id="notconected" style="display: flex;">
        <span>Sign In/Sign Up</span>
    </div>
    <div class="users" id="conected" style="display: none;">
        <span>Cart</span>
        <span>Profil</span>
    </div>
</nav>