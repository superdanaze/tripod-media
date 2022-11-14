<?php
    //  TEMPLATE NAME: FILM


    //  VARS
    $streaming = get_field('where_streaming');
    $streaming_link = get_field('where_streaming_link');
    $synopsis = get_field('synopsis');
    $main_img = get_field('main_image');
    $poster = get_field('film_poster');
    $trailer_ID = get_field('trailer_id');
    $trailer_type = get_field('trailer_type');
    $credits = get_field('credits');
    $links = get_field('links');
    $gallery = get_field('image_gallery');
    $hero_img;

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


        genesis_markup([
            'open'		=> '<div %s>',
            'context'	=> 'project',
            'atts'		=> [ 'class' => "project-single rel", ]
        ]);

            //  hero area
            get_template_part( E_TEMPLATES, 'single-hero', array( 'streaming' => $streaming, 'streaming_link' => $streaming_link, 'hero_img' => $hero_img ) );



        genesis_markup([
            'context'	=> 'project',
            'close'		=> '</div>'
        ]);

    
?>