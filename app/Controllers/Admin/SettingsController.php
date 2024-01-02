<?php

namespace DT\Contact\Controllers\Admin;
use DT\Contact\Views\Dtc;

class SettingsController{

      /**
	 * Version
	 *
	 * @var string
	 */
	private $version;


      public function __construct()
      {
            // echo 'this is setting';
            add_action( 'admin_menu', [ $this, 'register' ] );
            add_action( 'admin_enqueue_scripts', [ $this, 'settings_admin_enqueue_scripts' ] );
      }

      /**
	 * Submenu
	 *
	 * @return void
	 */
	public function register() {
            add_menu_page(
                  __( 'Contact Button ', 'dt-contact' ),
                        'Contact Button',
                        'manage_options',
                        'dt-contact',
                        [$this, 'dtpadmin_page'],
                        'dashicons-store',21
            );
		add_submenu_page(
			'dt-contact',
			esc_html__( 'Settings', 'dt-contact' ),
			esc_html__( 'Settings', 'dt-contact' ),
			'administrator',
			'dtc_settings',
			[ $this, 'settings' ]
		);

		add_submenu_page(
			'dt-contact',
			esc_html__( 'Get Help', 'dt-contact' ),
			esc_html__( 'Get Help', 'dt-contact' ),
			'administrator',
			'dtc_get_help',
			[ $this, 'get_help' ]
		);
	}


      /**
       * Setting page
       *
       * @return void
       */
      public function settings() {
		Dtc::view( 'settings.settings' );
	}

      /**
       * Help page
       *
       * @return void
       */
      public function get_help() {
		Dtc::view( 'page.help' );
	}

      /**
	 * Admin scripts
	 *
	 * @return void
	 */
	public function settings_admin_enqueue_scripts() {

            $styles['dt-tpg-admin']  = DtContact()->get_assets_uri( 'css/admin/admin.css' );
		$scripts[] = [
			'handle' => 'dt-js-admin',
			'src'    => DtContact()->get_assets_uri( 'js/admin/admin.js' ),
			'deps'   => [ 'jquery', 'wp-color-picker', 'jquery-ui-sortable' ],
			'footer' => true,
		];

		foreach ( $scripts as $script ) {
			wp_register_script( $script['handle'], $script['src'], $script['deps'], isset( $script['version'] ) ? $script['version'] : $this->version, $script['footer'] );
		}
            // Register style admin
            foreach ( $styles as $k => $v ) {
			wp_register_style( $k, $v, false, isset( $script['version'] ) ? $script['version'] : $this->version );
		}

            // Enque style admin
            foreach ( $styles as $k => $v ) {
			wp_enqueue_style( $k );
		}
		foreach ( $scripts as $k => $v ) {
			wp_enqueue_script( $v['handle'] );
		}


		wp_localize_script(
			'dt-js-admin',
			'rttpg',
			[
				// 'nonceID' => esc_attr( rtTPG()->nonceId() ),
				'nonce'   => esc_attr( $nonce ),
				'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
			]
		);

      }

}
