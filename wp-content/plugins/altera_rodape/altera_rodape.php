<?php
/**
 * Plugin Name: Altera Rodapé
 * Plugin URI: http://infowebtec.com.br
 * Description: Este plugin altera o rodapé do Blog
 * Version: 1.0
 * Author: Guiherme Francisquini
 * Author URI: http://infowebtec.com.br
 * Text Domain: altera_rodape
 * License: GPLv2
 */

 function altera_rodape()
 {
     echo "Meu primeiro Plugin - Guilherme Francisquini - 2017";
 }

 add_action( 'wp_footer', 'altera_rodape' );

 add_action( 'init', 'my_user_check' );

 function my_user_check()
 {
     if( is_user_logged_in())
     {
         //echo '<script>alert(1)</script>';
     }
 }

add_action( 'the_title', 'my_filtered_title', 10, 2 );
function my_filtered_title( $value, $id)
{
	$value = '[ **** '. $value .' ****]';
	return $value;
}
