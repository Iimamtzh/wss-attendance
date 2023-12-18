<?php

/**
 *
 * @link       https://websweetstudio.com/
 * @since      1.0.0
 *
 * @package    Custom_Plugin
 * @subpackage Custom_Plugin/includes
 */

class Custom_Plugin_Post_Types
{
    public function __construct()
    {
        // Hook into the 'init' action
        add_action('init', array($this, 'register_post_types'));
    }

    /**
     * Register custom post types
     */
    public function register_post_types()
    {
        // Register Blog Post Type
        register_post_type(
            'attendance',
            array(
                'labels' => array(
                    'name' => ('Attendance'),
                    'singular_name' => ('Attendance')
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'attendance'),
                'supports' => array('title', 'editor', 'thumbnail'),
                'menu_icon'   => 'dashicons-groups',
                'show_in_rest' => true
            )
        );
    }
}

// Inisialisasi class Custom_Post_Types_Register
$custom_post_types_register = new Custom_Plugin_Post_Types();
