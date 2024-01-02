<?php

namespace DT\Contact\Models;
/**
 * Fields class.
 */
class Options {
      public static function dtCSettingsOtherSettingsFields() {
            $other_settings = [
                  'template_class' => [
				'type'        => 'text',
				'name'        => 'template_class',
				'label'       => esc_html__( 'Template class', 'the-post-grid' ),
				'holderClass' => 'pro-field',
				'id'          => 'template_class',
				'value'       => '',
				'description'       => esc_html__('The default width of player. Set 0 to use full container width player. Default : 600(px)',''),
			],
			'tgp_filter_taxonomy'  => [
				'type'        => 'select',
				'label'       => esc_html__( 'Taxonomy Filter', 'the-post-grid' ),
				'holderClass' => 'sc-tpg-grid-filter sc-tpg-filter tpg-hidden',
				'class'       => 'rt-select2',
				'options'     => self::rt_filter_type(),
				'description'       => esc_html__('The default width of player. Set 0 to use full container width player. Default : 600(px)',''),

			],
			'dt_checkbox'  => [
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Checkbox', 'the-post-grid' ),
				'holderClass' => 'sc-tpg-grid-filter sc-tpg-filter tpg-hidden',
				'class'       => 'rt-select2',
				// 'options'     => self::rt_filter_type(),
				'description'       => esc_html__('The default width of player. Set 0 to use full container width player. Default : 600(px)',''),

			],
			'dt_url'  => [
				'type'        => 'url',
				'label'       => esc_html__( 'URL', 'the-post-grid' ),
				'holderClass' => 'sc-tpg-grid-filter sc-tpg-filter tpg-hidden',
				'class'       => 'rt-select2',
				// 'options'     => self::rt_filter_type(),
				'description'       => esc_html__('The default width of player. Set 0 to use full container width player. Default : 600(px)',''),

			],
			'dt_image'  => [
				'type'        => 'image',
				'label'       => esc_html__( 'URL', 'the-post-grid' ),
				'holderClass' => 'sc-tpg-grid-filter sc-tpg-filter tpg-hidden',
				'class'       => 'rt-select2',
				// 'options'     => self::rt_filter_type(),
				'description'       => esc_html__('The default width of player. Set 0 to use full container width player. Default : 600(px)',''),

			],
            ];
            return $other_settings;
      }

	public static function rt_filter_type() {
		return [
			'dropdown' => esc_html__( 'Dropdown', 'the-post-grid' ),
			'button'   => esc_html__( 'Button', 'the-post-grid' ),
		];
	}
}
