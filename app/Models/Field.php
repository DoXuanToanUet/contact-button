<?php

namespace DT\Contact\Models;
use DT\Contact\Views\Dtc;
/**
 * Fields class.
 */
class Field {
      private $class;
      private $id;
      private $name;
      private $placeholder;
      private $type;
      private $default;
      private $label;
      private $holderClass;
      private $value;
      private $description;
      private $multiple;
      private $attr;
      private $blank;
      private $options;

      function __construct() {
	}
      private function setArgument( $key, $attr ) {
            global $pagenow;

            $this->type     = isset( $attr['type'] ) ? ( $attr['type'] ? $attr['type'] : 'text' ) : 'text';
            $this->multiple = isset( $attr['multiple'] ) ? ( $attr['multiple'] ? $attr['multiple'] : false ) : false;
            $this->name     = ! empty( $key ) ? $key : null;
            $this->id             = isset( $attr['id'] ) ? $attr['id'] : null;
            $this->default  = isset( $attr['default'] ) ? $attr['default'] : null;
		$this->value    = isset( $attr['value'] ) ? ( $attr['value'] ? $attr['value'] : null ) : null;
            $this->label          = isset( $attr['label'] ) ? ( $attr['label'] ? $attr['label'] : null ) : null;
		$this->class          = isset( $attr['class'] ) ? ( $attr['class'] ? $attr['class'] : null ) : null;
		$this->holderClass    = isset( $attr['holderClass'] ) ? ( $attr['holderClass'] ? $attr['holderClass'] : null ) : null;
		$this->description    = isset( $attr['description'] ) ? ( $attr['description'] ? $attr['description'] : null ) : null;
            $this->attr           = isset( $attr['attr'] ) ? ( $attr['attr'] ? $attr['attr'] : null ) : null;
            $this->blank          = ! empty( $attr['blank'] ) ? $attr['blank'] : null;
            $this->options        = isset( $attr['options'] ) ? ( $attr['options'] ? $attr['options'] : [] ) : [];
      }
      public function Field( $key, $attr = [] ) {
            $html  = null;
            $this->setArgument( $key, $attr );
            $html .= '<div class="field-holder" style="display:flex; gap:15px;">';

            if ( $this->label ) {
			$html .= "<div class='field-label'>";
			$html .= '<label for="'.esc_attr( $this->id ).'">' . Dtc::htmlKses( $this->label, 'basic' ) . '</label>';
			$html .= '</div>';
		}

            $html .= '<div class="dtc-field-content" style="color: #9e9e9e;">';
            switch ( $this->type ) {
			case 'text':
				$html .= $this->text();
				break;
                  case 'select':
                        $html .= $this->select();
                        break;
                  case 'checkbox':
                        $html .= $this->checkbox();
                        break;
                  case 'url':
                        $html .= $this->url();
                        break;
                  case 'image':
                        $html .= $this->image();
                        break;

            }
            if ( $this->description ) {
			$html .= "<div class='field-description-label'>";
			$html .= '<label for="'.esc_attr( $this->id ).'">' . Dtc::htmlKses( $this->description, 'basic' ) . '</label>';
			$html .= '</div>';
		}
            $html .= '</div>';


            $html .= '</div>';

            return $html;
      }

      private function text(){
            $h  = null;
            $h .= '<input
				type="text"
				class="' . esc_attr( $this->class ) . '"
				id="' . esc_attr( $this->id ) . '"
				value="' . esc_attr( $this->value ) . '"
				name="' . esc_attr( $this->name ) . '"
				placeholder="' . esc_attr( $this->placeholder ) . '"
				/>';

		return $h;

      }
      private function checkbox(){
            $h  = null;
            $h .= '<input
				type="checkbox"
				class="' . esc_attr( $this->class ) . '"
				id="' . esc_attr( $this->id ) . '"
				value="' . esc_attr( $this->value ) . '"
				name="' . esc_attr( $this->name ) . '"
				placeholder="' . esc_attr( $this->placeholder ) . '"
				/>';

		return $h;

      }
      private function select(){
            $h           = null;
            if ( $this->multiple ) {
			$this->attr  = " style='min-width:160px;'";
			$this->name  = $this->name . '[]';
			$this->attr  = $this->attr . " multiple='multiple'";
			$this->value = ( is_array( $this->value ) && ! empty( $this->value ) ? $this->value : [] );
		} else {
			$this->value = [ $this->value ];
		}

            $h .= '<select name="' . esc_attr( $this->name ) . '" id="' . esc_attr( $this->id ) . '" class="' . esc_attr( $this->class ) . '" ' . Dtc::htmlKses( $this->attr, 'basic' ) . '>';

		if ( $this->blank ) {
			$h .= '<option value="">' . esc_html( $this->blank ) . '</option>';
		}

            if ( is_array( $this->options ) && ! empty( $this->options ) ) {
			foreach ( $this->options as $key => $value ) {
				$slt = ( in_array( $key, $this->value ) ? 'selected' : null );
				$h  .= '<option ' . esc_attr( $slt ) . ' value="' . esc_attr( $key ) . '">' . esc_html( $value ) . '</option>';
			}
		}

		$h .= '</select>';

		return $h;

      }
      private function url() {
		$h  = null;
		$h .= '<input
				type="url"
				class="' . esc_attr( $this->class ) . '"
				id="' . esc_attr( $this->id ) . '"
				value="' . esc_url( $this->value ) . '"
				name="' . esc_attr( $this->name ) . '"
				placeholder="' . esc_attr( $this->placeholder ) . '"
				' . Dtc::htmlKses( $this->attr, 'basic' ) . '
				/>';

		return $h;
	}

      private function image() {
		$holderClass = explode( ' ', $this->holderClass );

		$h   = null;
		$img = null;

		$h .= "<div class='rt-image-holder'>";
		$h .= '<input type="hidden" name="' . esc_attr( $this->name ) . '" value="' . absint( $this->value ) . '" id="' . esc_attr( $this->id ) . '" class="hidden-image-id" />';
		$c  = 'hidden';

		if ( $id = absint( $this->value ) ) {
			$aImg = wp_get_attachment_image_src( $id, 'thumbnail' );
			$img  = '<img src="' . esc_url( $aImg[0] ) . '" >';
			$c    = null;
		}

		$h .= '<div class="rt-image-preview">' . Dtc::htmlKses( $img, 'image' ) . '<span class="dashicons dashicons-plus-alt rtAddImage"></span><span class="dashicons dashicons-trash rtRemoveImage ' . esc_attr( $c ) . '"></span></div>';

		$h .= '</div>';

		return $h;
	}
}
