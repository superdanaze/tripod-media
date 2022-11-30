<?php 
    //  SECTION : SINGLE PROJECT POSTER

    $poster = $args['poster'];
    $title = get_the_title();

    genesis_markup([
        'open'		=> '<section %s>',
        'context'	=> 'single_project_poster',
        'atts'		=> [ 'class' => "project-poster rel delicate", 'data-fade' => true ]
    ]);
  
        print wp_get_attachment_image( $poster['id'], "medium", false, array( 'class' => "image", 'alt' => $title . " poster" ) );

    genesis_markup([
        'context'	=> 'single_project_poster',
        'open'		=> '</section>'
    ]);
  
?>