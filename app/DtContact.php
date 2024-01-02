<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

require_once __DIR__ . './../vendor/autoload.php';

use DT\Contact\Controllers\Admin\NoticeController;
use DT\Contact\Controllers\ScriptController;
use DT\Contact\Controllers\Admin\SettingsController;



if ( ! class_exists( DtContact::class ) ) {

      final class DtContact{

		/**
		 * Store the singleton object.
		 *
		 * @var boolean
		 */
		private static $singleton = false;

		/**
		 * Options
		 *
		 * @var array
		 */
		public $options = [
			'settings'          => 'dtc_settings',
			// 'version'           => RT_THE_POST_GRID_VERSION,
			// 'installed_version' => 'rt_the_post_grid_current_version',
			// 'slug'              => RT_THE_POST_GRID_PLUGIN_SLUG,
		];
            /**
		 * Create an inaccessible constructor.
		 */
		private function __construct() {
			$this->__init();
		}
            /**
		 * Fetch an instance of the class.
		 */
		public static function getInstance() {
			if ( false === self::$singleton ) {
				self::$singleton = new self();
			}

			return self::$singleton;
		}

		protected function __init() {
			new SettingsController();
			new ScriptController();
			if ( is_admin() ) {
				// new AdminAjaxController();
				new NoticeController();
				// new MetaController();
			}
		}


		/**
		 * Nonce ID
		 *
		 * @return string
		 */
		public static function nonceId() {
			return 'dtc_nonce';
		}
		/**
		 * Nonce text
		 *
		 * @return string
		 */
		public static function nonceText() {
			return 'dtc_nonce_secret';
		}

		public function get_assets_uri( $file ) {
			$file = ltrim( $file, '/' );

			return trailingslashit( DTCONTACT_URL_PLUGIN_URL . '/assets' ) . $file;
		}

		public function tpg_can_be_rtl( $file ) {
			$file = ltrim( str_replace( '.css', '', $file ), '/' );

			if ( is_rtl() ) {
				$file .= '.rtl';
			}

			return trailingslashit( DTCONTACT_URL_PLUGIN_URL . '/assets' ) . $file . '.css';
		}
}

/**
 * Function for external use.
 *
 * @return DtContact
 */
function DtContact() {
	return DtContact::getInstance();
}
// Init app.
DtContact();

}
