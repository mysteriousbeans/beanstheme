<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php generate_do_element_classes( 'content' ); ?>>
		<main id="main" <?php generate_do_element_classes( 'main' ); ?>>
			<?php
			/**
			 * generate_before_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_before_main_content' );

      ?>
      

				<header class="page-header">
					<h1 class="page-title">
						<?php
						printf( // WPCS: XSS ok.
							/* translators: 1: Search query name */
							__( 'You searched for %s', 'generatepress' ),
							'<span style="font-weight: bold;">' . get_search_query() . '</span>'
						);
						?>
					</h1>
           <!-- Include Relevanssi 'did you mean' -->
          <?php
if ( function_exists( 'relevanssi_didyoumean' ) ) {
    relevanssi_didyoumean( get_search_query(), '<p>Any chance you meant: ', '</p>', 6 );
}
?>
				</header><!-- .page-header -->

      			<?php if ( have_posts() ) : ?>

      
				<?php while ( have_posts() ) : the_post();

					get_template_part( 'content', 'search' );

				endwhile;

				/**
				 * generate_after_loop hook.
				 *
				 * @since 2.3
				 */
				do_action( 'generate_after_loop' );

				generate_content_nav( 'nav-below' );

			else :

				get_template_part( 'no-results', 'search' );

			endif;

			/**
			 * generate_after_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * generate_after_primary_content_area hook.
	 *
	 * @since 2.0
	 */
	do_action( 'generate_after_primary_content_area' );

	generate_construct_sidebars();

get_footer();
