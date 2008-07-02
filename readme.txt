=== Improved Gallery ===
Contributors: scribu
Donate link: http://scribu.net/download/
Tags: gallery, images, optimisation
Requires at least: 2.5
Tested up to: 2.6
Stable tag: trunk

Improves the built-in gallery in WP 2.5

== Description ==

This plugin improves the gallery template in Wordpress 2.5, by making the following tweeks:

1. Puts all the gallery css in a separte file, for easy customisation and **faster page load**.
1. Adds an id attribute to the code, so that two or more galleries can have a *different* number of columns and still **display correctly** on the same page.

== Installation ==

1. Unzip "Custom Field Images" archive and put the folder into your "plugins" folder (`/wp-content/plugins/`).
1. Go to `/wp-includes/` directory, find the file `media.php` and set its permissions to 757 (This should not be necesary in WP 2.5.2)
1. Activate the plugin from the Plugins admin menu.

= Advanced Usage =

If you want to make it even easier to edit your gallery style, you can do this:

1. Copy the styles from 'gallery-style.css' into the main 'style.css' file in your theme (`wp-content/themes/your-theme`).
1. Edit `improved-gallery.php` and delete or comment out this line:

`add_action('wp_head', 'improved_gallery_stylesheet');`