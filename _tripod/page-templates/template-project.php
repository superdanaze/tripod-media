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
    

    get_header(); 

        

    get_footer();
    
?>