<?php
/**
 * Template part for displaying related posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DD_Base
 * @since 1.0
 */
$related_args = dd_base_post_related_args();
$query = new WP_Query( $related_args );

if ( $query->have_posts() ):
	?>

	<div class="releated_posts lastest-news--three-col">

		<h3 class="releated_posts__title"><?php echo esc_html__( 'Related Posts', 'dd-base' ) ?></h3>

		<div class="row">
			<?php while ( $query->have_posts() ): $query->the_post(); ?>
				<div class="col-md-4 col-sm-4">
					<div <?php post_class() ?>>

						<?php if ( '' !== get_the_post_thumbnail() ): ?>
							<div class="action-image">
								<a href="<?php the_permalink() ?>">
									<?php the_post_thumbnail( 'dd_base-related-post' ) ?>
								</a>
							</div>
						<?php endif; ?>

						<a class="post-title" href="<?php the_permalink() ?>"><?php the_title() ?></a>
					</div>
				</div>
			<?php endwhile; ?>
		</div>

	</div>

	<?php
	wp_reset_postdata();
	endif;

