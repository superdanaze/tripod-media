<?php 
    //  SECTION : SINGLE PROJECT HERO

    $streaming = trim($args['streaming']);
    $streaming_link = trim($args['streaming_link']);
    $hero_img = $args['hero_img'];
    $img_position = $args['position'];
    $title = get_the_title();
    $func = new ELA_Funcs;


    genesis_markup([
        'open'		=> '<section %s>',
        'context'	=> 'single_project_hero',
        'atts'		=> [ 'class' => "project-hero full__container flex noover rel" ]
    ]);
  
        //  hero image
        genesis_markup([
            'open'		=> '<div %s>',
            'context'	=> 'single_project_hero_img',
            'atts'		=> [ 'class' => sprintf( "project-hero-img full__container full__height topleft background %s abs", $img_position ), 'style' => sprintf( 'background-image:url(%s);', $func->imgsize( $hero_img ) ) ],
            'close'     => '</div>'
        ]);

        //  title + streaming
        genesis_markup([
            'open'		=> '<div %s>',
            'context'	=> 'single_project_titles',
            'atts'		=> [ 'class' => "project-titles full__container B_md L_md R_sm z5 delicate rel", 'data-fade' => true ],
        ]);

            printf( '<h2 class="_title f-item nomargin f_light light-f">%s</h2>', $title );

            if ( $streaming && $streaming_link ) printf( '<a class="flex vert slow_and_smooth" href="%s" target="_blank" rel="nofollow">', $streaming_link );
                if ( $streaming ) printf( '<h6 class="light-f nomargin R_mini">%s</h6>', $streaming );
                if ( $streaming && $streaming_link ) print '<i class="fal fa-long-arrow-right light-f slow_and_smooth"></i>';
            if ( $streaming && $streaming_link ) print '</a>';

        genesis_markup([
            'close'     => '</div>',
            'context'	=> 'single_project_titles'
        ]);

    genesis_markup([
        'context'	=> 'single_project_hero',
        'open'		=> '</section>'
    ]);
  
?>