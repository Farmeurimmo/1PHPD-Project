<?php function searchBar($categories, $directors, $currentCategory = null) { ?>
    <div class="search-bar">
        <form method="get" action="/1PHPD/">
            <input type="text" name="search" placeholder="Search..."
                   value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <select name="category">
                <?php if ($currentCategory) { ?>
                    <option value="<?= htmlspecialchars($currentCategory) ?>"
                            selected><?= htmlspecialchars($currentCategory) ?></option>
                <?php } else { ?>
                    <option value="">All Categories</option>
                <?php } ?>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= htmlspecialchars($category['name']) ?>" <?= (isset($_GET['category']) && $_GET['category'] == $category['name']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php } ?>
            </select>
            <select name="director">
                <option value="">All Directors</option>
                <?php foreach ($directors as $director) { ?>
                    <option value="<?= htmlspecialchars($director['first_name'] . ' ' . $director['last_name']) ?>" <?= (isset($_GET['director']) && $_GET['director'] == $director['first_name'] . ' ' . $director['last_name']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($director['first_name'] . ' ' . $director['last_name']) ?>
                    </option>
                <?php } ?>
            </select>
            <button type="submit">Search</button>
        </form>
    </div>
<?php } ?>
