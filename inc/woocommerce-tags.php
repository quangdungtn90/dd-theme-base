<?php


if ( ! function_exists( 'dd_base_wishlist' ) ):
	/**
	 * Display mini wishlist
	 * @since 1.0
	 * @return void
	 */
	function dd_base_wishlist() {
		if ( function_exists( 'dd_base_toolkit' ) && class_exists( 'YITH_WCWL' ) ) {
			dd_base_toolkit( 'miniwishlist' )->template();
		}
	}
endif;


if ( ! function_exists( 'dd_base_minicart' ) ):
	/**
	 * Display minicart
	 * @since 1.0
	 * @return void
	 */
	function dd_base_minicart() {
		if ( function_exists( 'dd_base_toolkit' ) && class_exists( 'WooCommerce' ) ) {
			dd_base_toolkit( 'minicart' )->template();
		}
	}
endif;


if ( ! function_exists( 'dd_base_account_navigator' ) ):

	/**
	 * Display Account navigation
	 * @since 1.0
	 * @return void
	 */
	function dd_base_account_navigator( $partial = null, $id = 0 ) {

		if ( get_theme_mod( 'topbar_user_enable', 1 ) ) {
			?>
            <div class="account_nav <?php echo is_user_logged_in() ? 'logged_in' : ''; ?>">

				<?php
				if ( is_user_logged_in() ):
					$user = get_userdata( get_current_user_id() );
					?>

                    <a class="account_nav__heading"
                       href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ) ?>">
                       <?php  echo get_avatar( $user->ID, 25 ); ?>
						<?php echo esc_html( $user->display_name ) ?>
                    </a>

                    <div class="account_nav__content">
                        <ul>
							<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                                <li class="account_nav__item account_nav__item-<?php echo esc_html( $endpoint ) ?>">
                                    <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                                </li>
							<?php endforeach; ?>
                        </ul>
                    </div>

				<?php else: ?>
                    <div class="account_nav__login">
                        <a class="login" href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ) ?>">
		                    <?php echo esc_html__( 'Login', 'dd-base' ) ?>
                        </a>
                        <?php if(get_option('users_can_register')) : ?>
                        <a class="register" href="<?php echo wp_registration_url(); ?>">
	                        <?php echo esc_html__( 'Register', 'dd-base' ) ?>
                        </a>
                        <?php endif; ?>
                    </div>
				<?php endif; ?>
            </div>

			<?php
		}
	}

endif;
