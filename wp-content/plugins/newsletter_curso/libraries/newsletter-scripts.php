<?php

function nsAddScripts()
{
    wp_enqueue_style( 'ns-main-style', plugins_url( 'css/style.css', dirname(__FILE__) ) );
    wp_enqueue_script( 'ns-main-script', plugins_url( 'js/main.js', dirname(__FILE__) ), array(), false, true );
}

add_action('wp_enqueue_scripts', 'nsAddScripts');