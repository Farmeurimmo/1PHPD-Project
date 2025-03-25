# 1PHPD

## Database

* **VOD** (id, title, image, shot_plot, long_plot, id_director, price, release_date, category)

* **VOD_Category** (id, id_vod, id_category)

* **Director** (id, first_name, last_name, films)

* **Actor** (id, first_name, last_name, films)

* **Actor_film** (id, id_actor, id_film)

* **Category** (id, name)

* **Users** (id, username, password(hashed), email, films_purchased)

* **Film_purchased** (id, id_user, id_film)
