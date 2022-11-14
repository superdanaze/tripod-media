<?php

add_filter( 'body_class', 'ela_post_custom_body_class' );
/**
 * Adds landing page body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Original body classes.
 * @return array Modified body classes.
 */
function ela_post_custom_body_class( $classes ) {

	$classes[] = 'single-project';
	$classes[] = 'custom-page';

	return $classes;

}


//  remove post title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//  remove post entry meta
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//  remove header markup
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//  remove content sidebar wrap div
add_filter( 'genesis_markup_content-sidebar-wrap', '__return_null' );

//  remove main wrapper
add_filter( 'genesis_markup_content', '__return_null' );


function single_project() {
	get_template_part( E_TEMPLATE, 'project' );
}

add_filter( 'genesis_entry_content', 'single_project' );


genesis();

?>