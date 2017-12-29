<?php
/**
 * Plugin Name: Filmes reviews
 * Plugin URI: http://infowebtec.com.br
 * Description: Plugin para reviews de filmes
 * Version: 1.0
 * Author: Guiherme Francisquini
 * Author URI: http://infowebtec.com.br
 * Text Domain: filmes_reviews
 * License: GPLv2
 */

class FilmesReviews
{
    private static $instance;

    public static function getInstance()
    {
        if(self::$instance == NULL)
        {
            self::$instance = new self();
        }
    }

    private function __construct()
    {
        add_action( 'init', array($this, 'register_post_type') );
    }

    function register_post_type()
    {
        register_post_type( 'filmes_reviews', array(
            'labels' => array(
                'name' => 'Filmes Reviews',
                'singular_name' => 'Filme Review',
            ),
            'description' => 'Post para cadastro de reviews',
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'author',
                'revisions',
                'thumbnail',
                'custom-filds',
            ),
            'public' => TRUE,
            'menu_position' => 3,
            'menu_icon' => 'dashicons-format-video', 
        ));
    }
}

FilmesReviews::getInstance();