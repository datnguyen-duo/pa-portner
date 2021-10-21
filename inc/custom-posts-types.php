<?php

function register_post_types() {
    register_post_type('projects',array(
        'labels' => array(
            'name' => _x('Project', 'post type general name'),
            'singular_name' => _x('Project ', 'post type singular name'),
            'menu_name' => 'Projects'
        ),
        'rewrite' => array(
            'slug' => 'projects',
            'with_front' => false
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'has_archive' => false,
//        'hierarchical' => true,
        'supports' => array('title','thumbnail')
    ));
}
add_action('init','register_post_types');