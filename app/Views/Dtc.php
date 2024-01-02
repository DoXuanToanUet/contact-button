<?php
namespace DT\Contact\Views;


use DT\Contact\Models\Field;

class Dtc{

	/**
	 * view
	 *
	 * @param  mixed $viewName
	 * @param  mixed $args
	 * @param  mixed $return
	 * @return void
	 */
	public static function view( $viewName, $args = [], $return = false ) {
		$file     = str_replace( '.', '/', $viewName );
		$file     = ltrim( $file, '/' );
		$viewFile = trailingslashit( DTCONTACT_PATH . '/resources' ) . $file . '.php';

		if ( ! file_exists( $viewFile ) ) {
			return new \WP_Error(
				'brock',
				sprintf(
				/* translators: %s File name */
					esc_html__( '%s file not found', 'the-post-grid' ),
					$viewFile
				)
			);
		}

		if ( $args ) {
			extract( $args ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
		}

		if ( $return ) {
			ob_start();
			include $viewFile;

			return ob_get_clean();
		}

		include $viewFile;
	}

	/**
	 * rtFieldGenerator
	 *
	 * @param  mixed $fields
	 * @return void
	 */
	public static function rtFieldGenerator( $fields = [] ) {
		$html = null;

		if ( is_array( $fields ) && ! empty( $fields ) ) {
			$tpgField = new Field();
			foreach ( $fields as $fieldKey => $field ) {
				$html .= $tpgField->Field( $fieldKey, $field );
			}
		}

		return $html;
	}



	/**
	 * Prints HTML.
	 *
	 * @param string $html HTML.
	 * @param bool $allHtml All HTML.
	 *
	 * @return mixed
	 */
	// public static function print_html( $html, $allHtml = false ) {
	// 	if ( $allHtml ) {
	// 		echo stripslashes_deep( $html );
	// 	} else {
	// 		echo wp_kses_post( stripslashes_deep( $html ) );
	// 	}
	// }
/**
	 * Allowed HTML for wp_kses.
	 *
	 * @param string $level Tag level.
	 *
	 * @return mixed
	 */
	public static function allowedHtml( $level = 'basic' ) {
		$allowed_html = [];

		switch ( $level ) {
			case 'basic':
				$allowed_html = [
					'b'      => [
						'class' => [],
						'id'    => [],
					],
					'i'      => [
						'class' => [],
						'id'    => [],
					],
					'u'      => [
						'class' => [],
						'id'    => [],
					],
					'br'     => [
						'class' => [],
						'id'    => [],
					],
					'em'     => [
						'class' => [],
						'id'    => [],
					],
					'span'   => [
						'class' => [],
						'id'    => [],
					],
					'strong' => [
						'class' => [],
						'id'    => [],
					],
					'hr'     => [
						'class' => [],
						'id'    => [],
					],
					'a'      => [
						'href'   => [],
						'title'  => [],
						'class'  => [],
						'id'     => [],
						'target' => [],
						'style'  => [],
					],
					'div'    => [
						'class' => [],
						'id'    => [],
					],
				];
				break;

			case 'advanced':
				$allowed_html = [
					'b'      => [
						'class' => [],
						'id'    => [],
					],
					'i'      => [
						'class' => [],
						'id'    => [],
					],
					'u'      => [
						'class' => [],
						'id'    => [],
					],
					'br'     => [
						'class' => [],
						'id'    => [],
					],
					'em'     => [
						'class' => [],
						'id'    => [],
					],
					'span'   => [
						'class' => [],
						'id'    => [],
					],
					'strong' => [
						'class' => [],
						'id'    => [],
					],
					'hr'     => [
						'class' => [],
						'id'    => [],
					],
					'a'      => [
						'href'    => [],
						'title'   => [],
						'class'   => [],
						'id'      => [],
						'data-id' => [],
						'target'  => [],
					],
					'input'  => [
						'type'  => [],
						'name'  => [],
						'class' => [],
						'value' => [],
					],
				];
				break;

			case 'image':
				$allowed_html = [
					'img' => [
						'src'      => [],
						'data-src' => [],
						'alt'      => [],
						'height'   => [],
						'width'    => [],
						'class'    => [],
						'id'       => [],
						'style'    => [],
						'srcset'   => [],
						'loading'  => [],
						'sizes'    => [],
					],
					'div' => [
						'class' => [],
					],
				];
				break;

			case 'anchor':
				$allowed_html = [
					'a' => [
						'href'  => [],
						'title' => [],
						'class' => [],
						'id'    => [],
						'style' => [],
					],
				];
				break;

			default:
				// code...
				break;
		}

		return $allowed_html;
	}
	/**
	 * Definition for wp_kses.
	 *
	 * @param string $string String to check.
	 * @param string $level Tag level.
	 *
	 * @return mixed
	 */
	public static function htmlKses( $string, $level ) {
		if ( empty( $string ) ) {
			return;
		}

		return wp_kses( $string, self::allowedHtml( $level ) );
	}

	/**
	 * Verify nonce.
	 *
	 * @return bool
	 */
	public static function verifyNonce() {
		$nonce     = isset( $_REQUEST[ DtContact()->nonceId() ] ) ? sanitize_text_field( wp_unslash( $_REQUEST[ DtContact()->nonceId() ] ) ) : null;
		$nonceText = DtContact()->nonceText();

		if ( ! wp_verify_nonce( $nonce, $nonceText ) ) {
			return false;
		}

		return true;
	}
}

