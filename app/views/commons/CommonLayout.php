<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDB | <?= isset($title) ? $title : '...' ?></title>
    <link rel="stylesheet" href="/1PHPD/public/assets/style.css">
    <script src="https://kit.fontawesome.com/6389d77eca.js" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.cart-form').forEach(form => {
                form.addEventListener('submit', e => {
                    e.preventDefault();

                    const formData = new FormData(form);
                    const url = form.action;

                    fetch(url, {
                        method: 'POST',
                        body: formData,
                        credentials: 'same-origin'
                    }).then(res => {
                        if (res.ok) {
                            location.reload();
                        } else {
                            alert("Error, unable to add/remove item from cart, please try again.");
                        }
                    });
                });
            });
        });
    </script>

</head>
<body>

<?php include_once "CommonHeaderView.php"; ?>

<main>
    <?php if (isset($view)) {
        include_once $view;
    } ?>
</main>

<?php include_once "CommonFooterView.php"; ?>

</body>
</html>