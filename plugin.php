<?php

/**
 * @package CSS_Tricks_WP_API_Control
 */

/**
 * Plugin Name: CSS-Tricks WP API Control
 * Plugin URI: https://css-tricks.com
 * Description: Adds network settings to the WP API.
 * Version: 1.1
 * Author: Scott Fennell
 * Author URI: http://scottfennell.org
 * License: GPLv2 or later
 * Text Domain: css-tricks-wp-api-control
 * Network: TRUE
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Make sure we don't expose any info if called directly
if ( ! function_exists( 'add_action' ) ) {
	echo 'Hi!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

/**
 * Define a slug for our plugin to use in CSS classes and other namespacing.
 * Also, since this plugin will only ever be active on the control install,
 * other plugins can sniff for this constant in order to determine if
 * they are on the control install or a client install.
 */
define( 'CSS_TRICKS_WP_API_CONTROL', 'css_tricks_wp_api_control' );

/**
 * Define a version that's more easily accessible than the docblock one,
 * for cache-busting.
 */
define( 'CSS_TRICKS_WP_API_CONTROL_VERSION', '1.1' );

// Define paths and urls for easy loading of files.
define( 'CSS_TRICKS_WP_API_CONTROL_URL', plugin_dir_url( __FILE__ ) );
define( 'CSS_TRICKS_WP_API_CONTROL_DIR', plugin_dir_path( __FILE__ ) );

// For each php file in the inc/ folder, require it.
foreach( glob( CSS_TRICKS_WP_API_CONTROL_DIR . 'inc/*.php' ) as $filename ) {
	require_once( $filename );
}