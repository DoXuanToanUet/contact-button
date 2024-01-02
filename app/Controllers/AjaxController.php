<?php
namespace DT\Contact\Controllers;
use DT\Contact\Views\Dtc;
class AjaxController{
      /**
	 * Class constructor
	 */
	public function __construct() {
		add_action( 'wp_ajax_dtcSettings', [ $this, 'dtcSaveSettings' ] );

	}
      /**
	 * Save settings.
	 *
	 * @return void
	 */
	public function dtcSaveSettings() {
		$error = true;

		if ( Dtc::verifyNonce() ) {
			unset( $_REQUEST['action'] );
			unset( $_REQUEST[ DtContact()->nonceId() ] );
			unset( $_REQUEST['_wp_http_referer'] );

			update_option( DtContact()->options['settings'], wp_unslash( $_REQUEST ) );

			$response = [
				'error' => false,
				'msg'   => esc_html__( 'Settings successfully updated', 'the-post-grid' ),
			];
		} else {
			$response = [
				'error' => $error,
				'msg'   => esc_html__( 'Session Error !!', 'the-post-grid' ),
			];
		}

		wp_send_json( $response );
		die();
	}

}
