<?php
    //  TEMPLATE NAME: FILM


    //  VARS
    $streaming = get_field('where_streaming');
    $streaming_link = get_field('where_streaming_link');
    $synopsis = get_field('synopsis');
    $main_img = get_field('main_image');
    $main_img_position = get_field('main_image_position');
    $poster = get_field('film_poster');
    $trailer_ID = get_field('trailer_id');
    $trailer_type = get_field('trailer_type');
    $credits = get_field('credits');
    $links = get_field('links');
    $gallery = get_field('image_gallery');
    $hero_img;
    $container_classes = array();
    $streaming_title_link = $streaming_link ? array(array( 'name' => $streaming, 'link' => $streaming_link )) : null;
    $links_all = $streaming_title_link;

    //  determine hero image output
    switch (true) {
        case $main_img :
            $hero_img = $main_img;
        break;

        case $poster :
            $hero_img = $poster;
        break;

        default :
            $hero_img = ELA_FALLBACK;
        break;
    }

    //  do we have a trailer?
    if ( $trailer_ID ) $container_classes[] = "has-trailer";

    //  do we have a poster?
    if ( $poster ) $container_classes[] = "has-poster";

    //  aggregate all links
    if ( $streaming_title_link && $links ) {
        $links_all = array_merge( $streaming_title_link, $links );
    } else if ( !$streaming_title_link && $links ) {
        $links_all = $links;
    }


        genesis_markup([
            'open'		=> '<div %s>',
            'context'	=> 'project',
            'atts'		=> [ 'class' => sprintf( "project-single %s rel B_lg", implode( " ", $container_classes ) ) ]
        ]);

            //  hero area
            get_template_part( E_TEMPLATES, 'single-hero', array( 'streaming' => $streaming, 'streaming_link' => $streaming_link, 'hero_img' => $hero_img, 'position' => $main_img_position ) );

            genesis_markup([
                'open'		=> '<div %s>',
                'context'	=> 'project_content_all_wrap',
                'atts'		=> [ 'class' => "content-all-wrap container pad rel" ]
            ]);

                //  trailer area
                if ( $trailer_ID ) get_template_part( E_TEMPLATES, 'single-trailer', array( 'trailerID' => $trailer_ID, 'trailer_type' => $trailer_type ) );

                genesis_markup([
                    'open'		=> '<div %s>',
                    'context'	=> 'project_content_inner',
                    'atts'		=> [ 'class' => "content-inner rel T_xlg" ]
                ]);

                    genesis_markup([
                        'open'		=> '<div %s>',
                        'context'	=> 'project_content_synopsis_credits',
                        'atts'		=> [ 'class' => "content-synopsis-credits rel" ]
                    ]);

                        //  synopsis
                        if ( $synopsis ) get_template_part( E_TEMPLATES, 'single-synopsis', array( 'synopsis' => $synopsis ) );

                        //  credits
                        if ( $credits ) get_template_part( E_TEMPLATES, 'single-credits', array( 'credits' => $credits ) );

                        //  links
                        if ( $links_all ) get_template_part( E_TEMPLATES, 'single-links', array( 'links' => $links_all ) );

                    genesis_markup([
                        'context'	=> 'project_content_synopsis_credits',
                        'close'     => '</div>'
                    ]);

                    //  poster
                    if ( $poster ) get_template_part( E_TEMPLATES, 'single-poster', array( 'poster' => $poster ) );

                genesis_markup([
                    'context'	=> 'project_content_inner',
                    'close'     => '</div>'
                ]);

                //  image gallery
                if ( $gallery ) get_template_part( E_TEMPLATES, 'single-gallery', array( 'gallery' => $gallery ) );

            genesis_markup([
                'context'	=> 'project_content_all_wrap',
                'close'		=> '</div>'
            ]);


        genesis_markup([
            'context'	=> 'project',
            'close'		=> '</div>'
        ]);

    
?>