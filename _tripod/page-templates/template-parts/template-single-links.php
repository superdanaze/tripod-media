<?php 
    //  SECTION : SINGLE PROJECT LINKS

    genesis_markup([
        'open'		=> '<section %s>',
        'context'	=> 'single_project_links',
        'atts'		=> [ 'class' => "project-links rel delicate T_md", 'data-fade' => true ]
    ]);

        //  title
        print '<div class="credits-title full__container text_center rel">';
            print '<h5 class="project-content-title">LINKS</h5>';
        print '</div>';

        //  credits
        genesis_markup([
            'open'		=> '<div %s>',
            'context'	=> 'single_project_links_list',
            'atts'		=> [ 'class' => "project-links-list text_center" ]
        ]);

            foreach( $args['links'] as $key => $link ) {

                //  make sure we have a name and link
                if ( !$link['link'] || !$link['name'] ) continue;

                printf( '<a href="%s" target="_blank" rel="nofollow"><h6 class="light-f nomargin easy_does_it">%s</h6></a>', trim($link['link']), trim( strtoupper( $link['name'] ) ) );
            }

        genesis_markup([
            'context'	=> 'single_project_links_list',
            'open'		=> '</div>'
        ]);
        
    genesis_markup([
        'context'	=> 'single_project_links',
        'open'		=> '</section>'
    ]);
  
?>