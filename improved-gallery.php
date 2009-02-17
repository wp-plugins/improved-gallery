<?php
/*
Plugin Name: Improved Gallery
Version: 1.0.3
Description: Improves the built-in gallery in WP >= 2.5
Author: scribu
Author URI: http://scribu.net/
Plugin URI: http://scribu.net/wordpress/improved-gallery

Copyright (C) 2009 scribu.net (scribu AT gmail DOT com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

add_filter('post_gallery', 'improved_gallery', 10, 2);
add_action('wp_head', 'improved_gallery_stylesheet');

// Check version
global $wp_version;

if ( substr($wp_version, 0, 3) == '2.6' )
	require(dirname(__FILE__) . '/2.6.php');
elseif ( substr($wp_version, 0, 3) == '2.5' )
	require(dirname(__FILE__) . '/2.5.php');
else {
	function improved_gallery_warning() {
		echo '<div class="error"><p><strong>Improved Gallery can\'t work with this WordPress version!</strong> See the readme for supported versions.</p></div>';
	}

	add_action('admin_notices', 'improved_gallery_warning');
}

function improved_gallery_stylesheet() {
	if ( function_exists('plugin_url') )
		$plugin_url = plugin_url();
	else
		// Pre-2.6 compatibility
		$plugin_url = get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(dirname(__FILE__));

	echo '<link rel="stylesheet" href="' . $plugin_url . '/gallery-style.css" type="text/css" media="screen" />' . "\n";
}

