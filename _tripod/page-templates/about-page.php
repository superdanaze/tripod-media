<?php
/**
 * 
 *
 *
 * Template Name: About Page
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
	$classes[] = 'tm-about-page';
    $classes[] = $header_style;
    $classes[] = 'nav-abs';

	return $classes;

}

//  remove post title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//  remove main wrapper
add_filter( 'genesis_markup_content', '__return_null' );

//	remove content sidebar wrapper
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );



//  VARS
$func = new ELA_Funcs;
$vars = (object) array(
    'gallery'       => get_field('hero_images'),
    'leader'        => get_field('leader_text'),
    'team_title'    => get_field('team_title'),
    'contact_title' => get_field('contact_title'),
    'team'          => get_field('team_members'),
    'contact_info'  => get_field('contact_information')
);


add_filter( 'genesis_entry_content', function() use( $vars, $func ) {

    ob_start();

        //  hero
        genesis_markup([
            'open'		=> '<section %s>',
            'context'	=> 'about_hero',
            'atts'		=> [ 'class' => "about-hero full__container flex horiz noover rel delicate", 'data-fade' => true ]
        ]);

            //  gallery images
            if ( $vars->gallery ) :
                genesis_markup([
                    'open'		=> '<div %s>',
                    'context'	=> 'about_hero_inner',
                    'atts'		=> [ 'class' => "about-hero-inner full__height flex abs" ]
                ]);

                    foreach( $vars->gallery as $key => $item ) {
                        genesis_markup([
                            'open'		=> '<figure %s>',
                            'context'	=> 'gallery_item_' . $key,
                            'atts'		=> [ 'class' => "about-gallery-item full__height noover flex horiz" ],
                            'content'   => sprintf( '<img class="image fit cover" src="%s" alt="hero gallery item %s" />', $func->imgsize($item), $key ),
                            'close'     => '</figure>'
                        ]);
                    }

                genesis_markup([
                    'context'	=> 'about_hero_inner',
                    'close'		=> '</div>'
                ]);
            endif;

            //  leader text
            if ($vars->leader  ) :
                genesis_markup([
                    'open'		=> '<div %s>',
                    'context'	=> 'about_hero_leader',
                    'atts'		=> [ 'class' => "about-hero-leader full__height flex horiz vert abs z5 delicate", 'data-fade' => true ]
                ]);

                    genesis_markup([
                        'open'		=> '<div %s>',
                        'context'	=> 'about_hero_leader_text',
                        'atts'		=> [ 'class' => "about-hero-leader-text _small text_center T_md L_sm R_sm" ],
                        'content'   => sprintf( '<h5 class="nomargin">%s</h5>', trim( $vars->leader ) ),
                        'close'     => '</div>'
                    ]);


                genesis_markup([
                    'context'	=> 'about_hero_leader',
                    'close'     => '</div>'
                ]);
            endif;

        genesis_markup([
            'context'	=> 'about_hero',
            'close'		=> '</section>'
        ]);



    $output = ob_get_clean();

    //  OUTPUT
    genesis_markup(
        [
            'open'		=> '<div %s>',
            'context'	=> "about_page",
            'atts'		=> [ 'class' => "about-wrap full__container rel" ],
            'content'	=> $output,
            'close'		=> '</div>',
        ]
    );
    
});

// Runs the Genesis loop.
genesis();