

<div class="auth">
    <div class="authcontainer">
        <div class="signinup">
            <a href="#login" id="signin">
                <span>Sign In</span>
            </a>
            <a href="#register" id="signup">
                <span>Sign Up</span>
            </a>
        </div>
        <div class="signform" id="login" style="display: none;">
            <form method="POST" action="/1PHPD/auth/login">
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="exemple@email.com" required>
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <input type="submit" value="Sign In" name="signin">
                <?php if (isset($_SESSION["errorMessage"])): ?>
                    <div style="color: red;"><?= $_SESSION["errorMessage"] ?></div>
                    <?php unset($_SESSION["errorMessage"]); ?>
                <?php endif; ?>
            </form>
        </div>
        <div class="signform" id="register" style="display: none;">
            <form method="POST" action="/1PHPD/auth/register">
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="exemple@email.com" required>
                </div>
                <div class="field">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Username" required>
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <input type="submit" value="Sign Up" name="signup">
                <?php if (isset($_SESSION["errorMessage"])): ?>
                    <div style="color: red;"><?= $_SESSION["errorMessage"] ?></div>
                    <?php unset($_SESSION["errorMessage"]); ?>
                <?php endif; ?>
            </form>
        </div>

        <script>
            signin = document.querySelector("#signin");
            signup = document.querySelector("#signup");
            function hash() {
                var hash = window.location.hash;
                console.log(hash);
                if (hash === "#login") {
                    document.getElementById("login").style.display = "flex";
                    document.getElementById("register").style.display = "none";
                    signin.style.backgroundColor = "var(--off-black)";
                    signup.style.backgroundColor = "rgb(25, 25, 25)";
                } else if (hash === "#register") {
                    document.getElementById("login").style.display = "none";
                    document.getElementById("register").style.display = "flex";
                    signin.style.backgroundColor = "rgb(25, 25, 25)";
                    signup.style.backgroundColor = "var(--off-black)";
                } else {
                    document.getElementById("login").style.display = "flex";
                    document.getElementById("register").style.display = "none";
                    signin.style.backgroundColor = "var(--off-black)";
                    signup.style.backgroundColor = "rgb(25, 25, 25)";
                }
            }
            document.addEventListener("DOMContentLoaded", hash());
            window.addEventListener("hashchange", function() {
                hash();
                console.log("hash changed");
            });
        </script>
    </div>
</div>