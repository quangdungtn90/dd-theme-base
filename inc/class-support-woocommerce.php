<?php

if ( !class_exists( 'DD_Base_Support_WooCommerce' ) ) {

	class DD_Base_Support_WooCommerce {

		public function __construct() {

			add_action( 'widgets_init', array( $this, 'widgetInit' ) );
			add_filter( 'dd_base\query', array( $this, 'query' ), 11 );
			add_filter( 'dd_base\query', array( $this, 'hook' ), 20 );
		}

		/**
		 * Register widget area.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function widgetInit() {

			register_sidebar( array(
				'name' => esc_html__( 'Shop Sidebar', 'dd-base' ),
				'id' => 'shop_sidebar',
				'description' => esc_html__( 'Add widgets here to appear in your sidebar.', 'dd-base' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h2 class="widget-title">',
				'after_title' => '</h2>',
			) );
		}

		/**
		 * Add shop options
		 */
		public function query( $query ) {

			if ( is_shop() || is_product_taxonomy() ) {

				$query['hook']['group'] = 'shop';
				$query['sidebar']['id'] = 'shop_sidebar';
				$query['content']['show_price'] = true;
				$query['content']['show_add_to_cart'] = true;
				$query['content']['show_rating'] = true;
			} else if ( is_singular( 'product' ) ) {

				$query['hook']['group'] = 'shop';
				$query['sidebar']['id'] = 'shop_sidebar';

				$query['content']['show_rating'] = true;
				$query['content']['show_price'] = true;
				$query['content']['show_excerpt'] = true;
				$query['content']['show_sku'] = true;
				$query['content']['show_categories'] = true;
				$query['content']['show_tags'] = true;
				$query['content']['show_add_to_cart'] = true;
				$query['content']['show_upsell'] = true;
				$query['content']['show_related'] = true;
				$query['content']['related_limit'] = 3;
				$query['content']['related_ids'] = '';
				$query['content']['related_by'] = 'product_cat';
			}

			return $query;
		}

		/**
		 * Custom product from woocommerce hook
		 */
		public function hook( $query ) {

			if ( $query['hook']['group'] == 'shop' ) {

				/**
				 * Remove default output content wrapper
				 */
				remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
				remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


				/**
				 * Add theme content wrapper
				 */
				add_action( 'woocommerce_before_main_content', 'dd_base_before_main_content', 10 );
				add_action( 'woocommerce_after_main_content', 'dd_base_after_main_content', 10 );
				add_action( 'woocommerce_before_main_content', 'dd_base_content_header', 5 );

				/**
				 * Breadcrumb
				 */
				remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 5 );
				remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
				add_filter( 'dd_base\breadcrumb', array( $this, 'breadcrumb' ) );
				add_filter( 'wp_title', array( $this, 'headingTitle' ) );

				/**
				 * Remove default sidebar
				 */
				remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

				/**
				 * Setting for content product in loop
				 */
				if ( $query['hook']['id'] != 'product' ) {

					if ( !$query['content']['show_rating'] ) {
						remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
					}
					if ( !$query['content']['show_price'] ) {
						remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
					}
					if ( !$query['content']['show_add_to_cart'] ) {
						remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
					}

				} else {

					/**
					 * Setting for single product
					 */
					if ( !$query['content']['show_price'] ) {
						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
					}
					if ( !$query['content']['show_rating'] ) {
						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
					}
					if ( !$query['content']['show_add_to_cart'] ) {
						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
					}
					if ( !$query['content']['show_excerpt'] ) {
						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
					}

					if ( !$query['content']['show_upsell'] ) {
						remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
					}
					if ( !$query['content']['show_related'] ) {
						remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
					}
				}
			}

			return $query;
		}

		public function breadcrumb( $breadcrumb ) {
			ob_start();
			woocommerce_breadcrumb();
			return ob_get_clean();
		}

		public function headingTitle( $title ) {
			return '<h2 class="page-title">' . esc_html__( 'Shop', 'dd-base' ) . '</h2>';
		}

	}

	new DD_Base_Support_WooCommerce();
}
