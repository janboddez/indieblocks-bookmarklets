<?php
/**
 * Plugin Name:       IndieBlocks Bookmarklets
 * Description:       Bookmarklets support for IndieBlocks.
 * Plugin URI:        https://indieblocks.xyz/
 * Author:            Jan Boddez
 * Author URI:        https://jan.boddez.net/
 * License:           GNU General Public License v3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       indieblocks
 * Version:           0.1.0
 * GitHub Plugin URI: https://github.com/janboddez/indieblocks-bookmarklets
 * Primary Branch:    main
 *
 * @author  Jan Boddez <jan@janboddez.be>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 * @package IndieBlocks\Bookmarklets
 */

namespace IndieBlocks\Bookmarklets;

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load dependencies.
require_once __DIR__ . '/includes/class-plugin.php';

$indieblocks_bookmarklets = Plugin::get_instance();
$indieblocks_bookmarklets->register();
