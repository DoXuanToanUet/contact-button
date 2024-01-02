<?php
/**
 * Notice Controller class.
 *
 * @package RT_TPG
 */

 namespace DT\Contact\Controllers\Admin;

 class NoticeController{

      public function __construct() {

		// Black friday 2023
		$current      = time();
		$black_friday = mktime( 0, 0, 0, 11, 18, 2022 ) <= $current && $current <= mktime( 0, 0, 0, 3, 6, 2024 );
		// var_dump($black_friday);
		if ( $black_friday ) {
			add_action( 'admin_init', [ $this, 'black_friday_notice' ] );
		}


		add_action( 'admin_init', [ $this, 'rttpg_notice' ] );
      }

      // Notice in admin
      public  function rttpg_notice() {
            add_action(
			'admin_notices',
                  [ $this , 'dt_admin_notice' ]

            );
      }
	public function black_friday_notice(){
		add_action(
			'admin_notices',
			function () {
				$plugin_name   = 'Contact Button';
				$download_link = 'https://www.radiustheme.com/downloads/the-post-grid-pro-for-wordpress/'; ?>
                <div class="notice notice-info is-dismissible" data-rttpg-dismissable="rttpg_bf_2022"
                     style="display:grid;grid-template-columns: 100px auto;padding-top: 25px; padding-bottom: 22px;">
                    <img alt="<?php echo esc_attr( $plugin_name ); ?>"
                         src="<?php echo esc_url( rtTPG()->get_assets_uri( 'images/post-grid-gif.gif' ) ); ?>"
                         width="74px" height="74px" style="grid-row: 1 / 4; align-self: center;justify-self: center"/>
                    <h3 style="margin:0;"><?php echo sprintf( '%s Cyber Week Deal!!', esc_html( $plugin_name ) ); ?></h3>
                    <p style="margin:0 0 2px;">Don't miss out on our biggest sale of the year! Get your
                        <b><?php echo esc_html( $plugin_name ); ?> plan</b> with <b>UPTO 50% OFF</b>! Limited time offer!!!</p>
                    <p style="margin:0;">
                        <a class="button button-primary" href="<?php echo esc_url( $download_link ); ?>"
                           target="_blank">Buy Now</a>
                        <a class="button button-dismiss" href="#">Dismiss</a>
                    </p>
                </div>
				<?php
			}
		);

	}
      /**
	 * Display Admin Notice, asking for a review
	 *
	 * @return void
	 */
      public  function dt_admin_notice() {
		global $pagenow;

            $exclude = [
			'themes.php',
			'users.php',
			'tools.php',
			'options-general.php',
			'options-writing.php',
			'options-reading.php',
			'options-discussion.php',
			'options-media.php',
			'options-permalink.php',
			'options-privacy.php',
			'edit-comments.php',
			'upload.php',
			'media-new.php',
			'admin.php',
			'import.php',
			'export.php',
			'site-health.php',
			'export-personal-data.php',
			'erase-personal-data.php',
		];

            if ( ! in_array( $pagenow, $exclude ) ){
                  printf(
				'<div class="notice rttpg-review-notice rttpg-review-notice--extended">
					<div class="rttpg-review-notice_content">
						<h3>%1$s</h3>
					</div>
				</div>',
                        esc_html__( 'Enjoying The Button Contact?', 'toandt' ),
			);
            }
      }
 }
