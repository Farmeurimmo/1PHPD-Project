<div style="display: flex; flex-wrap: wrap; justify-content: space-around;">
    <div>
        <h1>Welcome <?php echo $user["username"] ?></h1>
        <p>Your email: <?php echo $user["email"] ?></p>
        <p>Account created at: <?php echo $user["created_at"] ?></p>
        <p>Account last updated at: <?php echo $user["updated_at"] ?></p>
    </div>
    <div>
        <h2>Not you ?</h2>
        <a href="/1PHPD/auth/logout">Logout</a>
    </div>
    <div>
        <h2>Want to change your password ?</h2>
        <form method="post" action="/1PHPD/auth/password"
              style="display: flex; flex-wrap: wrap; justify-content: space-around; flex-direction: column; gap: 4px;">
            <label>Old password:
                <input type="password" name="old_password" placeholder="Old Password" required style="width: 100%;">
            </label>
            <label>New password:
                <input type="password" name="new_password" placeholder="New Password" required style="width: 100%;">
            </label>
            <label>Disconnect all devices (including this one):
                <input type="checkbox" name="disconnect_all" checked>
            </label>
            <button type="submit">Change Password</button>
            <?php if (isset($_SESSION["errorMessage"])) {
                echo "<p style='color: red;'>" . $_SESSION["errorMessage"] . "</p>";
                unset($_SESSION["errorMessage"]);
            } ?>

            <?php if (isset($_SESSION["successMessage"])) {
                echo "<p style='color: green;'>" . $_SESSION["successMessage"] . "</p>";
                unset($_SESSION["successMessage"]);
            } ?>
        </form>
    </div>
    <div>
        <h2>Want to see the vods you bought ?</h2>
        <a href="/1PHPD/my/films">My VODs</a>
    </div>
</div>
