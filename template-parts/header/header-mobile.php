<header class="site-header-mobile">
	<div class="site-header-mobile__top">
		<button class="site-header-mobile__button-left">
			<i class="fa fa-bars"></i>
		</button>
		<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
		<button class="site-header-mobile__button-right">
			<i class="fa fa-user"></i>
		</button>

	</div>
	<div class="site-header-mobile__bottom">
		<div class="site-header-mobile__content-left">
			<div class="site-header-mobile__close-content">
				<i class="fa fa-times"></i>
			</div>
			<div class="site-header-mobile__search-form">
				<?php get_search_form(); ?>
			</div>
			<nav class="site-header-mobile__nav">

			</nav>
		</div>
		<div class="site-header-mobile__content-right">
			<div class="site-header-mobile__close-content">
				<i class="fa fa-times"></i>
			</div>
			<?php
				if ( get_theme_mod( 'header_show_account_nav', 1 ) ) {
                    if ( class_exists( 'WooCommerce' ) ) {
	                    dd_base_account_navigator();
                    }
				}
			?>
		</div>
	</div>
</header>
