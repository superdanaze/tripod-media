<?php 
    //  SECTION : SINGLE PROJECT TRAILER


    genesis_markup([
        'open'		=> '<section %s>',
        'context'	=> 'single_project_trailer',
        'atts'		=> [ 'class' => "project-trailer full__container rel T_lg" ]
    ]);
  
        print '<div class="delicate" data-fade="true">';
        
            //  youtube video
            if ( $args['trailer_type'] === "youtube" ) {
                print ELA_Elements::youtubeVideo( trim($args['trailerID']) );
            }

            //  vimeo video
            if ( $args['trailer_type'] === "vimeo" ) {
                print ELA_Elements::vimeoVideo( trim($args['trailerID']) );
            }
        
        print '</div>';

    genesis_markup([
        'context'	=> 'single_project_trailer',
        'open'		=> '</section>'
    ]);
  
?>