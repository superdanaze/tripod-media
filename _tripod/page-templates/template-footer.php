<?php

    //  footer template

    //  VARS
    $info = get_field('contact_information', 'options');


    genesis_markup([
        'open'		=> '<div %s>',
        'context'	=> 'footer_inner',
        'atts'		=> [ 'class' => "footer-inner full__container flex horiz" ]
    ]);

        //  company information
        if ( $info ) {
            genesis_markup([
                'open'		=> '<div %s>',
                'context'	=> 'footer_info',
                'atts'		=> [ 'class' => "footer-info rel delicate", 'data-fade' => true ],
                'content'   => trim( sprintf( '<h6 class="nomargin">%s</h6>', $info ) ),
                'close'     => '</div>'
            ]);
        }

        //  social links
        genesis_markup([
            'open'		=> '<div %s>',
            'context'	=> 'footer_social',
            'atts'		=> [ 'class' => "footer-social flex horiz rel T_md B_lg delicate", 'data-fade' => true ],
            'content'   => ELA_Mods::social_links(),
            'close'     => '</div>'
        ]);

    genesis_markup([
        'context'	=> 'footer_inner',
        'close'		=> '</div>',
    ]);

?>