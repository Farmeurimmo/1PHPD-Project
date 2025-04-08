

<div class="auth">
    <div class="authcontainer">
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const signinDiv = document.querySelector('.signin');
                const signupDiv = document.querySelector('.signup');
                const formContainer = document.querySelector('.signform');

                signinDiv.addEventListener('click', function () {
                    signinDiv.style.backgroundColor = "var(--off-black)";
                    signupDiv.style.backgroundColor = "rgb(25, 25, 25)";
                    formContainer.innerHTML = `
                        <form method="POST" action="/1PHPD/auth/register">
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
                    `;
                });

                signupDiv.addEventListener('click', function () {
                    signinDiv.style.backgroundColor = "rgb(25, 25, 25)";
                    signupDiv.style.backgroundColor = "var(--off-black)";
                    formContainer.innerHTML = `
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
                        </form>
                    `;
                });
            });
        </script>
        <div class="signinup">
            <div class="signin">
                <span>Sign In</span>
            </div>
            <div class="signup" style="background-color:rgb(25, 25, 25);">
                <span>Sign Up</span>
            </div>
        </div>
        <div class="signform">
            <form method="POST" action="/1PHPD/auth/register">
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="exemple@email.com" required>
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <input type="submit" value="Sign In" name="signin">
            </form>
        </div>
    </div>
</div>