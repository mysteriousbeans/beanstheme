<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file. 
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

function generatepress_child_enqueue_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'generatepress-rtl', trailingslashit( get_template_directory_uri() ) . 'rtl.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_scripts', 100 );


/** 
 * Enqueue Font Awesome. 
 */
function tu_load_font_awesome() {
    wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/css/all.css');
}

add_action( 'wp_enqueue_scripts', 'tu_load_font_awesome' );

add_filter( 'generate_typography_default_fonts', function( $fonts ) {
    $fonts[] = 'Lora';

    return $fonts;
} );


/** Change the 404 page text in a way that won't be reversed by theme upgrades **/

add_filter( 'generate_404_title','generate_custom_404_title' );
function generate_custom_404_title()
{
      return 'Grrrr.... Something is not quite right&#33;';
}

add_filter( 'generate_404_text','generate_custom_404_text' );
function generate_custom_404_text()
{
      return 'For some super mysterious reason we can&#39;t find the page you are looking for, but maybe you can have another go (or at least find something else interesting) by using the search box?';
}


/** Change author name display to use co-authors plus **/

add_filter( 'generate_post_author_output', function( $author ) {
    if ( function_exists( 'coauthors_posts_links' ) ) {
        return sprintf( ' <span class="byline">%1$s</span>',
            coauthors_posts_links( null, null, 'by ', null, false )
        );
    }

    return $author;
} );

/** Remove link from post date **/

add_filter( 'generate_post_date_output', function( $output, $time_string ) {
	printf( '<span class="posted-on">%s</span>',
		$time_string
	);
}, 10, 2 );

