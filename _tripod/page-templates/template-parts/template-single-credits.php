<?php 
    //  SECTION : SINGLE PROJECT CREDITS

    genesis_markup([
        'open'		=> '<section %s>',
        'context'	=> 'single_project_credits',
        'atts'		=> [ 'class' => "project-credits rel delicate T_md", 'data-fade' => true ]
    ]);

        //  title
        print '<div class="credits-title full__container text_center rel">';
            print '<h5 class="project-content-title">CREDITS</h5>';
        print '</div>';

        //  credits
        genesis_markup([
            'open'		=> '<div %s>',
            'context'	=> 'single_project_credits_list',
            'atts'		=> [ 'class' => "project-credits-list grid duo" ]
        ]);

            foreach( $args['credits'] as $credit ) {
                //  title
                printf( '<p class="light-f f_med nomargin text_right">%s</p>', strtoupper( trim($credit['title']) ) );

                //  name
                printf( '<h6 class="light-f nomargin">%s</h6>', strtoupper( trim($credit['name']) ) );
            }

        genesis_markup([
            'context'	=> 'single_project_credits_list',
            'open'		=> '</div>'
        ]);
        
    genesis_markup([
        'context'	=> 'single_project_credits',
        'open'		=> '</section>'
    ]);
  
?>