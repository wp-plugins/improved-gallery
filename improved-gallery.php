<?php
/*
Plugin Name: Improved Gallery
Version: 1.0.2
Description: Improves the built-in gallery in WP 2.5
Author: scribu
Author URI: http://scribu.net/
Plugin URI: http://scribu.net/downloads/improved-gallery.html
*/

/*
Copyright (C) 2008 scribu.net (scribu AT gmail DOT com)

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

function improved_gallery($output, $attr){
	global $post;
	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'orderby'    => 'menu_order ASC, ID ASC',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
	), $attr));

	$id = intval($id);
	$attachments = get_children("post_parent=$id&post_type=attachment&post_mime_type=image&orderby={$orderby}");

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $id => $attachment )
			$output .= wp_get_attachment_link($id, $size, true) . "\n";
		return $output;
	}

	$listtag = tag_escape($listtag);
	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;

	$output = "\t<!-- Begin Improved Gallery -->
	<style type='text/css'>#post{$id} .gallery-item {width: {$itemwidth}%;}</style>
	<div class='gallery' id='post{$id}'>\n";

	foreach ( $attachments as $id => $attachment ) {
		$link = wp_get_attachment_link($id, $size, true);
		$output .= "
		<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='gallery-caption'>
				{$attachment->post_excerpt}
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '<br style="clear: both" />';
	}

	$output .= "
			<br style='clear: both;' />
	</div>
	<!-- End Improved Gallery -->\n";

	return $output;
}

function improved_gallery_stylesheet(){
	if ( !defined('WP_CONTENT_URL') )
		// Pre-2.6 compatibility
		$plugin_url = get_option('siteurl') . '/wp-content';
	else
		$plugin_url = WP_CONTENT_URL;
	$plugin_url .= '/plugins/' . plugin_basename(dirname(__FILE__));

	echo '<link rel="stylesheet" type="text/css" media="screen" href="' . $plugin_url . '/gallery-style.css" />'."\n";
}
?>
