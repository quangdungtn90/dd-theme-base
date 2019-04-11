<?php if ( $desc = get_the_author_meta( 'description' ) ):
	$user_id = get_the_author_meta( 'ID' );


	?>
    <div class="biography">

        <div class="biography__image">
			<?php
			$author_bio_avatar_size = apply_filters( 'themespond_author_bio_avatar_size', 110 );
			echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
			?>
        </div>

        <div class="biography__content">

            <div class="biography__heading">

				<?php if ( is_single() ): ?>
                    <h3 class="biography__title">
                        <a href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>" rel="author">
							<?php echo esc_html( get_the_author() ) ?>
                        </a>
                    </h3>
				<?php else: ?>
                    <div class="biography__counters">
                        <span class="biography__posts-count">
                            <?php printf( esc_html__( '%d Posts', 'dd-base' ), dd_base_get_author_posts_count( $user_id ) ); ?>
                        </span>
                        <span class="biography__comments-count">
                            <?php printf( esc_html__( '%d Comments', 'dd-base' ), dd_base_get_author_comments_count( $user_id ) ); ?>
                        </span>
                    </div>
				<?php endif; ?>

				<?php
				if ( $author_url = get_the_author_meta( 'url' ) ) {
					printf( '<a class="biography__weburl" href="%1$s">%1$s</a>', esc_url( $author_url ) );
				}
				?>
            </div>

            <div class="biography__body">
                <p>
					<?php
					echo wp_kses_post( $desc );
					?>
                </p>
				<?php do_action( 'dd_base\biography_extral', $user_id ) ?>
            </div>

        </div>
    </div>
	<?php
endif;
