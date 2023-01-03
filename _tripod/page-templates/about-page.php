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

        //  HERO
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


        //  TEAM
        if ( $vars->team ) :
            genesis_markup([
                'open'		=> '<section %s>',
                'context'	=> 'about_team',
                'atts'		=> [ 'class' => "about-team full__container rel T_xlg" ]
            ]);

                genesis_markup([
                    'open'		=> '<div %s>',
                    'context'	=> 'about_team_inner',
                    'atts'		=> [ 'class' => "about-team-inner container pad rel" ]
                ]);

                    //  title
                    if ( $vars->team_title ) printf( '<h5 class="about-title text_center delicate" data-fade>%s</h5>', strtoupper( trim( $vars->team_title ) ) );

                    //  team
                    genesis_markup([
                        'open'		=> '<div %s>',
                        'context'	=> 'about_team_wrap',
                        'atts'		=> [ 'class' => "about-team-wrap flex horiz rel" ]
                    ]);

                        foreach( $vars->team as $key => $member ) {
                            genesis_markup([
                                'open'		=> '<figure %s>',
                                'context'	=> 'team_member_' . $key,
                                'atts'		=> [ 'class' => "team-member text_center delicate", 'data-fade' => true ]
                            ]);

                                //  title
                                if ( $member['title'] ) printf( '<p class="light-f f_med nomargin">%s</p>', strtoupper( trim( $member['title'] ) ) );

                                //  name
                                if ($member['name'] ) printf( '<h6 class="light-f nomargin">%s</h6>', trim( $member['name'] ) );

                            genesis_markup([
                                'context'	=> 'team_member_' . $key,
                                'close'     => '</figure>'
                            ]);
                        }

                    genesis_markup([
                        'context'	=> 'about_team_wrap',
                        'close'     => '</div>'
                    ]);

                genesis_markup([
                    'context'	=> 'about_team_inner',
                    'close'     => '</div>'
                ]);

            genesis_markup([
                'context'	=> 'about_team',
                'close'     => '</section>'
            ]);
        endif;


        //  CONTACT INFORMATION
        if ( $vars->contact_info ) :
            genesis_markup([
                'open'		=> '<section %s>',
                'context'	=> 'about_contact',
                'atts'		=> [ 'class' => "about-contact full__container rel T_xlg" ]
            ]);

                genesis_markup([
                    'open'		=> '<div %s>',
                    'context'	=> 'about_contact_inner',
                    'atts'		=> [ 'class' => "about-contact-inner container pad rel" ]
                ]);

                    //  title
                    if ( $vars->contact_title ) printf( '<h5 class="about-title text_center delicate" data-fade>%s</h5>', strtoupper( trim( $vars->contact_title ) ) );

                    //  contact info
                    genesis_markup([
                        'open'		=> '<div %s>',
                        'context'	=> 'about_contact_content',
                        'atts'		=> [ 'class' => "about-contact-content _small text_center light-f rel delicate", 'data-fade' => true ],
                        'content'   => $vars->contact_info,
                        'close'     => '</div>'
                    ]);

                genesis_markup([
                    'context'	=> 'about_contact_inner',
                    'close'     => '</div>'
                ]);

            genesis_markup([
                'context'	=> 'about_contact',
                'close'     => '</section>'
            ]);
        endif;


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