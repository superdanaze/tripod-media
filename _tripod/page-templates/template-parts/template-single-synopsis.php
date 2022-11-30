<?php 
    //  SECTION : SINGLE PROJECT SYNOPSIS

    genesis_markup([
        'open'		=> '<section %s>',
        'context'	=> 'single_project_synopsis',
        'atts'		=> [ 'class' => "project-synopsis _small text_center rel delicate", 'data-fade' => true ]
    ]);

        //  title
        print '<h5 class="project-content-title">SYNOPSIS</h5>';

        //  synopsis
        printf( '<span class="light-f nomargin">%s</span>', trim($args['synopsis']) );

    genesis_markup([
        'context'	=> 'single_project_synopsis',
        'open'		=> '</section>'
    ]);
  
?>