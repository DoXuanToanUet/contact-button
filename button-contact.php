<?php
/*
 * Plugin Name:       Button Contact
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       This my note plugin
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Toan dt
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       dt-contact
 * Domain Path:       /languages
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
//  Dinh nghia cac hang so plugin
if( !defined('DTCONTACT_PATH') ){
      define('DTCONTACT_PATH', plugin_dir_path(__FILE__));
}
if( !defined('DTCONTACT_URL') ){
      define('DTCONTACT_URL', plugin_dir_url(__FILE__));
}
define( 'DTCONTACT_URL_PLUGIN_URL', plugins_url( '', __FILE__ ) );
if ( ! class_exists( 'DtContact' ) ) {
	require_once 'app/DtContact.php';
}


