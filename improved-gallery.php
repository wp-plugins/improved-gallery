<?php
/*
Plugin Name: Improved Gallery
Version: 1.0.5
Description: Improves the built-in gallery in WP >= 2.5
Author: scribu
Author URI: http://scribu.net/
Plugin URI: http://scribu.net/wordpress/improved-gallery


Copyright (C) 2009 Cristi Burcă (scribu@gmail.com)

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

add_filter('gallery_style', 'improved_gallery');
add_action('template_redirect', 'improved_gallery_stylesheet');

function improved_gallery($style) {
	global $post;
	
	// Extract width;
	preg_match('/width:\s*(\d+)%;/', $style, $matches);

	$id = "post{$post->ID}";
	$width = $matches[1];

	$style = "<style type='text/css'>#{$id} .gallery-item {width: {$width}%}</style>
	<div class='gallery' id='{$id}'>\n";

	return $style;
}

function improved_gallery_stylesheet() {
	if ( function_exists('plugins_url') )
		$url = plugins_url(plugin_basename(dirname(__FILE__)));
	else
		$url = get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(dirname(__FILE__));

	wp_enqueue_style('gallery-style', $url . '/gallery-style.css');
}

