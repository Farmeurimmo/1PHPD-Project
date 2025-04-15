<h1>Welcome <?php echo $user["username"] ?></h1>

<div style="display: flex; flex-wrap: wrap; justify-content: space-between;">
    <section id="profile">
        <h2>Your presonal informations</h2>
        <p><b>Your email:</b> <?php echo $user["email"] ?></p>
        <p><b>Account created at:</b> <?php echo $user["created_at"] ?></p>
        <p><b>Account last updated at:</b> <?php echo $user["updated_at"] ?></p>
    </section>

    <section id="notYou">
        <h2>Not you ?</h2>
        <a href="/1PHPD/auth/logout">Logout</a>
    </section>

    <section id="yourFilms">
        <h2>Want to see the vods you bought ?</h2>
        <a href="/1PHPD/my/films">My VODs</a>
    </section>
</div>

<section id="passwordChange">
    <h2>Want to change your password ?</h2>
    <div class="signform">
        <form method="POST" action="/1PHPD/auth/password">
            <div class="field">
                <label for="old_password">Old Password</label>
                <input type="password" id="old_password" name="old_password" placeholder="Old Password" required>
            </div>
            <div class="field">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
            </div>
            <div class="field">
                <input type="checkbox" id="disconnect_all" name="disconnect_all" checked>
                <label for="disconnect_all">Disconnect all devices (including this one)</label>
            </div>
            <input type="submit" value="Change Password">
            <?php if (isset($_SESSION["errorMessage"])): ?>
                <div style="color: red;"><?= $_SESSION["errorMessage"] ?></div>
                <?php unset($_SESSION["errorMessage"]); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION["successMessage"])): ?>
                <div style="color: green;"><?= $_SESSION["successMessage"] ?></div>
                <?php unset($_SESSION["successMessage"]); ?>
            <?php endif; ?>
        </form>
    </div>
</section>
