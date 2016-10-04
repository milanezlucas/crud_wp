<?php
define( 'CRUD_PREFIX',          'crud_' );
define( 'CRUD_TEMPLATEPATH', 	get_template_directory() );

require_once( CRUD_TEMPLATEPATH . '/dashboard/custom_post.php' );
require_once( CRUD_TEMPLATEPATH . '/dashboard/metabox.php' );
require_once( CRUD_TEMPLATEPATH . '/dashboard/forms.php' );

require_once( CRUD_TEMPLATEPATH . '/src/custom_post.php' );

function crud_get_posts( $post_type )
{
    $rs_pages = new WP_Query( array(
        'post_type'         => $post_type,
        'posts_per_page'    => -1
    ));
    while ( $rs_pages->have_posts() ) {
        $rs_pages->the_post();

        $pages[ get_the_ID() ] = get_the_title();
    }
    wp_reset_postdata();

    return $pages;
}
