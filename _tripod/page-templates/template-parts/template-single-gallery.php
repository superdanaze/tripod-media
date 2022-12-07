<?php 
    //  SECTION : SINGLE PROJECT GALLERY


    genesis_markup([
        'open'		=> '<section %s>',
        'context'	=> 'single_project_gallery',
        'atts'		=> [ 'class' => "project-gallery T_xlg rel delicate", 'data-fade' => true ]
    ]);

        //  gallery
        genesis_markup([
            'open'		=> '<div %s>',
            'context'	=> 'single_project_gallery_inner',
            'atts'		=> [ 'class' => "project-gallery-inner grid", 'data-count' => count($args['gallery']) ]
        ]);

            foreach( $args['gallery'] as $key => $item ) {
                genesis_markup([
                    'open'		=> '<figure %s>',
                    'context'	=> 'single_project_gallery_item_' . $key,
                    'atts'		=> [ 'class' => "project-gallery-item slow_and_smooth", 'data-item' => $key + 1 ],
                    'content'   => wp_get_attachment_image( $item['id'], "medium", false, array( 'class' => "nopoint image fit cover" ) ),
                    'close'     => '</figure>'
                ]);
            }

        genesis_markup([
            'context'	=> 'single_project_gallery_inner',
            'open'		=> '</div>'
        ]);


        //  gallery modal
        genesis_markup([
            'open'		=> '<div %s>',
            'context'	=> 'single_project_gallery_modal',
            'atts'		=> [ 'class' => "project-gallery-modal full__container full__frame__height topleft fixed z10 hide start" ]
        ]);

            //  close X
            genesis_markup([
                'open'		=> '<button %s>',
                'context'	=> 'gallery_modal_close',
                'atts'		=> [ 'class' => "gallery-modal-close topright A_sm abs z10" ],
                'content'   => '<i class="fal fa-times nopoint easy_does_it"></i>',
                'close'     => '</button>'
            ]);

            genesis_markup([
                'open'		=> '<div %s>',
                'context'	=> 'gallery_modal_inner',
                'atts'		=> [ 'class' => "gallery-modal-inner container pad full__height grid rel" ]
            ]);

                //  prev
                genesis_markup([
                    'open'		=> '<nav %s>',
                    'context'	=> 'gallery_modal_prev',
                    'atts'		=> [ 'class' => "gallery-modal-prev gallery-nav flex horiz vert" ],
                    'content'   => '<i class="fal fa-chevron-left nopoint easy_does_it"></i>',
                    'close'     => '</nav>'
                ]);

                //  gallery items
                genesis_markup([
                    'open'		=> '<div %s>',
                    'context'	=> 'gallery_modal_items_wrap',
                    'atts'		=> [ 'class' => "gallery-modal-items flex horiz vert rel" ]
                ]);

                    foreach( $args['gallery'] as $key => $item ) {
                        genesis_markup([
                            'open'		=> '<figure %s>',
                            'context'	=> 'modal_gallery_item_' . $key,
                            'atts'		=> [ 'class' => "modal-gallery-item nopoint abs start", 'data-item' => $key + 1 ],
                            'content'   => sprintf( '<img src="%s" alt="Gallery Image %s"/> ', ELA_Funcs::imgsize($item), $key + 1 ),
                            'close'     => '</figure>'
                        ]);
                    }

                genesis_markup([
                    'context'	=> 'gallery_modal_items_wrap',
                    'close'     => '</div>'
                ]);

                //  next
                genesis_markup([
                    'open'		=> '<nav %s>',
                    'context'	=> 'gallery_modal_next',
                    'atts'		=> [ 'class' => "gallery-modal-next gallery-nav flex horiz vert" ],
                    'content'   => '<i class="fal fa-chevron-right nopoint easy_does_it"></i>',
                    'close'     => '</nav>'
                ]);

            genesis_markup([
                'context'	=> 'gallery_modal_inner',
                'close'     => '</div>'
            ]);

        genesis_markup([
            'context'	=> 'single_project_gallery_modal',
            'close'     => '</div>'
        ]);


    genesis_markup([
        'context'	=> 'single_project_gallery',
        'close'		=> '</section>'
    ]);
  
?>