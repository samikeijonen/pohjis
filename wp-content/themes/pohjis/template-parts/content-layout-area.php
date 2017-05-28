<?php
// Service content with different layouts.
$prefix  = pohjis_metabox_prefix();
$content = carbon_get_post_meta( get_the_ID(), $prefix . 'service_content', 'complex' );

if ( $content ) :

	echo '<div class="service-layouts">';

		foreach ( $content as $item ) :

			echo '<div class="service-'. $item['template'] .'-section service-layout-section section">';
				echo '<div class="wrapper">';

				// Text and image on the right layout.
				if ( 'text-image' === $item['template'] ) :
					echo '<div class="grid-wrapper grid-wrapper-2cl">';

						echo '<div class="content-area">';
							echo wpautop( wp_kses_post( $item['text-image-content'] ) );
						echo '</div>';

						echo '<div class="content-area">';
							echo '<img src="' . esc_url( wp_get_attachment_url( $item['text-image-img'] ) ) . '" alt="">';
						echo '</div>';

					echo '</div><!-- .grid-wrapper -->';
				endif;

				// Three column layout.
				if ( 'three-columns' === $item['template'] ) :
					echo '<div class="grid-wrapper grid-wrapper-3cl">';

						echo '<div class="content-area">';
							echo wpautop( wp_kses_post( $item['three-columns-1'] ) );
						echo '</div>';

						echo '<div class="content-area">';
							echo wpautop( wp_kses_post( $item['three-columns-2'] ) );
						echo '</div>';

						echo '<div class="content-area">';
							echo wpautop( wp_kses_post( $item['three-columns-3'] ) );
						echo '</div>';

					echo '</div><!-- .grid-wrapper -->';
				endif;

				// Two column layout.
				if ( 'two-columns' === $item['template'] ) :
					echo '<div class="grid-wrapper grid-wrapper-2cl">';

						echo '<div class="content-area">';
							echo wpautop( wp_kses_post( $item['two-columns-1'] ) );
						echo '</div>';

						echo '<div class="content-area">';
							echo wpautop( wp_kses_post( $item['two-columns-2'] ) );
						echo '</div>';

					echo '</div><!-- .grid-wrapper -->';
				endif;

				// Two column layout with image on top.
				if ( 'image-two-columns' === $item['template'] ) :
					// Image on top.
					if ( isset( $item['image-two-columns-img'] ) && $item['image-two-columns-img'] ) :
						echo '<img src="' . esc_url( wp_get_attachment_url( $item['image-two-columns-img'] ) ) . '" alt="">';
					endif;

					echo '<div class="top-of-image">';
						echo '<div class="top-of-image-wrapper">';
							echo '<div class="grid-wrapper grid-wrapper-2cl">';

								echo '<div class="content-area">';
									echo wpautop( wp_kses_post( $item['image-two-columns-1'] ) );
								echo '</div>';

								echo '<div class="content-area">';
									echo wpautop( wp_kses_post( $item['image-two-columns-2'] ) );
								echo '</div>';

							echo '</div><!-- .grid-wrapper -->';
						echo '</div><!-- .top-of-image-wrapper -->';
					echo '</div><!-- .top-of-image -->';
				endif;

				// One column layout.
				if ( 'one-column' === $item['template'] ) :

						echo '<div class="content-area content-area-one-column">';
							echo wpautop( wp_kses_post( $item['one-column-content'] ) );
						echo '</div>';

				endif;

				echo '</div><!-- .wrapper -->';
			echo '</div><!-- .service-section -->';

		endforeach;

	echo '</div><!-- .service-layouts -->';

endif;

// Featured area.
$featured_title   = carbon_get_post_meta( get_the_ID(), $prefix . 'featured_for_service_title' );
$featured_content = carbon_get_post_meta( get_the_ID(), $prefix . 'featured_for_service_content' );
$featured         = carbon_get_post_meta( get_the_ID(), $prefix . 'service_featured_content', 'complex' );

if ( isset( $featured_title ) && $featured_title || isset( $featured_content ) && $featured_content ) :
echo '<div class="service-featured-content service-layout-section intro-content section">';
	echo '<div class="wrapper wrapper-smaller-center">';
		echo '<h2 class="heading-one">' . esc_html( $featured_title ) . '</h2>';
		echo wpautop( esc_html( $featured_content ) );
	echo '</div>';
echo '</div>';
endif;

// Featured content.
if ( $featured ) :

	echo '<div class="service-featured-area-section section">';
		echo '<div class="wrapper">';
			echo '<div class="grid-wrapper grid-wrapper-3cl justify-content-center">';

			foreach ( $featured as $item ) :
				$img     = wp_get_attachment_image_src( $item['img'], 'pohjis-bigger', true );
				$img_url = $img[0];
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-inner entry-inner-bg"<?php if ( $item['img'] ) : ?> style="background-image:url('<?php echo esc_url( $img_url ); ?>');"<?php endif; ?>>
						<div class="bg-wrapper">
							<a href="<?php echo esc_url( $item['link_url'] ); ?>" rel="bookmark">
								<header class="entry-header">
									<?php echo '<h3 class="entry-title no-margin-bottom">' . esc_html( $item['title'] ) . '</h3>'; ?>
								</header>
							</a>
						</div>
					</div>
				</article><!-- #post-## -->
			<?php endforeach;

			echo '</div><!-- .grid-wrapper -->';
		echo '</div><!-- .wrapper -->';
	echo '</div><!-- .section -->';

endif;
