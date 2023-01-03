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
                $title = $project->post_title;
                $enabled = get_field('enabledisable', $ID);
                $streaming = get_field('where_streaming', $ID);
                $img = get_field('main_image', $ID);
                $img_position = get_field('main_image_position', $ID);
                $link = $project->guid;

                //  do not print if project is not enabled
                if ( !$enabled ) continue;

                genesis_markup([
                    'open'		=> '<a %s>',
                    'context'	=> 'project_item',
                    'atts'		=> [ 'class' => "project-item-wrap noover rel start", 'href' => $link, 'rel' => "nofollow" ]
                ]);

                    genesis_markup([
                        'open'		=> '<div %s>',
                        'context'	=> 'project_item_inner',
                        'atts'		=> [ 'class' => "project-item-inner full__height rel delicate", 'data-fade' => true ]
                    ]);


                        //  image
                        genesis_markup([
                            'open'		=> '<div %s>',
                            'context'	=> 'project_item_bg',
                            'atts'		=> [ 'class' => sprintf( "project-item-bg full__container full__height background %s topleft abs", $img_position ), 'style' => sprintf( 'background-image:url(%s);', $func->imgsize($img) ) ],
                            'close'     => '</div>'
                        ]);

                        //  gradient
                        genesis_markup([
                            'open'		=> '<div %s>',
                            'context'	=> 'project_item_grad',
                            'atts'		=> [ 'class' => "project-item-grad full__container botleft abs z1 slow_and_smooth" ],
                            'close'     => '</div>'
                        ]);

                        //  peek title
                        genesis_markup([
                            'open'		=> '<div %s>',
                            'context'	=> 'project_item_peek',
                            'atts'		=> [ 'class' => "project-item-peek full__container botright text_right B_xsm R_xsm abs z5 slow_and_smooth" ],
                            'content'   => sprintf( '<h6 class="light-f nomargin">%s</h6>', trim( $title ) ),
                            'close'     => '</div>'
                        ]);

                        //  title + streaming
                        genesis_markup([
                            'open'		=> '<div %s>',
                            'context'	=> 'project_item_title',
                            'atts'		=> [ 'class' => "project-item-title full__container botleft A_sm abs z5" ]
                        ]);

                            printf( '<h3 class="_title f-item nomargin f_light light-f">%s</h3>', strtoupper(trim( $title )) );
                            if ( $streaming ) printf( '<h6 class="_streaming f-item nomargin light-f">%s</h6>', trim( $streaming ) );

                            print '<div class="_view f-item full__container flex vert T_mini">';
                                print '<p class="nomargin light-f R_mini">view project</p><i class="fal fa-long-arrow-right light-f"></i>';
                            print '</div>';

                        genesis_markup([
                            'close'     => '</div>',
                            'context'	=> 'project_item_title'
                        ]);


                    genesis_markup([
                        'context'	=> 'project_item_inner',
                        'close'		=> '</div>'
                    ]);

                genesis_markup([
                    'context'	=> 'project_item',
                    'close'		=> '</a>'
                ]);

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