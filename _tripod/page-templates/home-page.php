<?php
/**
 * 
 *
 *
 * Template Name: Home Page
 *
 */

//	custom hero atts
$header_style = get_field('header_color_scheme');


add_filter( 'body_class', 'ela_page_custom_body_class' );
/**
 * Adds landing page body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Original body classes.
 * @return array Modified body classes.
 */
function ela_page_custom_body_class( $classes ) {

    global $header_style;
	$classes[] = 'tm-page';
	$classes[] = 'tm-home-page';
    $classes[] = $header_style;
    $classes[] = 'nav-abs';

	return $classes;

}

//  remove post title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//  remove main wrapper
add_filter( 'genesis_markup_content', '__return_null' );

//	remove content sidebar wrapper
add_filter( 'genesis_markup_content-sidebar-wrap', '__return_null' );


//  VARS
$func = new ELA_Funcs;
$vars = array();


$__args = array(
    'post_type'             => 'project',
    'post_status'           => 'publish',
    'ignore_sticky_posts'   => true,
    'posts_per_page'		=> -1,
    // 'orderby'               => 'menu_order', 
    'order'                 => 'DESC'
);

$projects = new WP_Query($__args);



add_filter( 'genesis_entry_content', function() use( $vars, $projects, $func ) {

    ob_start();

        genesis_markup([
            'open'		=> '<div %s>',
            'context'	=> 'projects_wrap',
            'atts'		=> [ 'class' => "projects-wrap full__container grid rel A_sm" ]
        ]);

            foreach( $projects->posts as $key => $project ) {
                $ID = $project->ID;

            }

        genesis_markup([
            'context'	=> 'projects_wrap',
            'close'		=> '</div>'
        ]);



    $output = ob_get_clean();

    //  OUTPUT
    genesis_markup(
        [
            'open'		=> '<section %s>',
            'context'	=> "home_projects_grid",
            'atts'		=> [ 'class' => "home-projects full__container rel" ],
            'content'	=> $output,
            'close'		=> '</section>',
        ]
    );
    
});

// Runs the Genesis loop.
genesis();