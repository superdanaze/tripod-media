<?php 
    //  SECTION : SINGLE PROJECT GALLERY


    genesis_markup([
        'open'		=> '<section %s>',
        'context'	=> 'single_project_gallery',
        'atts'		=> [ 'class' => "project-gallery T_xlg rel delicate", 'data-fade' => true ]
    ]);

        genesis_markup([
            'open'		=> '<div %s>',
            'context'	=> 'single_project_gallery_inner',
            'atts'		=> [ 'class' => "project-gallery-inner grid", 'data-count' => count($args['gallery']) ]
        ]);

            foreach( $args['gallery'] as $key => $item ) {
                genesis_markup([
                    'open'		=> '<figure %s>',
                    'context'	=> 'single_project_gallery_item',
                    'atts'		=> [ 'class' => "project-gallery-item slow_and_smooth", 'data-item' => $key + 1 ],
                    'content'   => wp_get_attachment_image( $item['id'], "medium", false, array( 'class' => "nopoint image fit cover" ) ),
                    'close'     => '</figure>'
                ]);
            }

        genesis_markup([
            'context'	=> 'single_project_gallery_inner',
            'open'		=> '</div>'
        ]);

    genesis_markup([
        'context'	=> 'single_project_gallery',
        'close'		=> '</section>'
    ]);
  
?>