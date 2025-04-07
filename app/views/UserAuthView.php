<div style="display: flex; flex-direction: row; justify-content: center; margin: 20px; gap: 30px;">
    <form method="POST" action="/1PHPD/auth/register">
        <h2>Register</h2>
        <div>
            <label>Email:
                <input type="email" name="email" required>
            </label>
        </div>

        <div>
            <label>Username:
                <input type="text" name="username" required>
            </label>
        </div>

        <div>
            <label>Password:
                <input type="password" name="password" required>
            </label>
        </div>

        <input type="submit" value="Register" name="register">

        <?php if (isset($_SESSION["errorMessage"])): ?>
            <div style="color: red;"><?= $_SESSION["errorMessage"] ?></div>
            <?php unset($_SESSION["errorMessage"]); ?>
        <?php endif; ?>
    </form>

    <form method="POST" action="/1PHPD/auth/login">
        <h2>Login</h2>

        <div>
            <label>Email:
                <input type="email" name="email" required>
            </label>
        </div>

        <div>
            <label>Password:
                <input type="password" name="password" required>
            </label>
        </div>

        <input type="submit" value="Login" name="login">
    </form>
</div>