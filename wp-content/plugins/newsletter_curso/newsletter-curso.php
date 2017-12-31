<?php

/**
 * plugin Name: Newsletter Curso
 * Description: Plugin de Newaletter
 * Version: 1.0
 * Author: Guilherme Francisquini
 * 
 */

if(!defined('ABSPATH')) exit;

//Load Scripts
require_once(plugin_dir_path( __FILE__ ).'/libraries/newsletter-scripts.php');
require_once(plugin_dir_path( __FILE__ ).'/libraries/newsletter-classe.php');
require_once(plugin_dir_path( __FILE__ ).'/libraries/newsletter-mailer.php');

//Register Widget
function registerNewsletterCurso()
{
    register_widget('NewsletterCursoWidget');
}

add_action('widgets_init', 'registerNewsletterCurso');