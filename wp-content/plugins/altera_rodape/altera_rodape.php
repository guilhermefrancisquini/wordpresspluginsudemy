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