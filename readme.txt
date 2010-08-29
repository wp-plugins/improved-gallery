=== Improved Gallery ===
Contributors: scribu
Donate link: http://scribu.net/paypal
Tags: gallery, images, optimisation
Requires at least: 2.5
Tested up to: 2.8
Stable tag: trunk

Improves the built-in gallery in WordPress 2.5 and newer.

== Description ==

This plugin improves the gallery template by making the following tweaks:

1. Puts all the gallery css in a separte file, for easy customisation and **faster page load**.
1. Adds an id attribute to the code, so that two or more galleries can have a *different* number of columns and still **display correctly** on the same page.

Links: [Plugin News](http://scribu.net/wordpress/improved-gallery) | [Author's Site](http://scribu.net)

== Installation ==

1. Unzip "Improved Gallery" archive and put the folder into your "plugins" folder (`/wp-content/plugins/`).
1. Activate the plugin from the Plugins admin menu.

= Advanced Usage =

If you want to make it even easier to edit your gallery style, you can do this:

1. Copy the styles from 'gallery-style.css' into the main 'style.css' file in your theme (`wp-content/themes/your-theme`).
1. Edit `improved-gallery.php` and delete or comment out this line, like so:

`// add_action('template_redirect', 'improved_gallery_stylesheet');`

== Changelog ==

= 1.0.5 =
* WP 2.8 compatibility

= 1.0 =
* initial release
* [more info](http://scribu.net/wordpress/improved-gallery/ig-1-0.html)

