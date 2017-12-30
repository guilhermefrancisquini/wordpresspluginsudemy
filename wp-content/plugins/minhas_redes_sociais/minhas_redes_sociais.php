<?php
/*
Plugin Name: Minhas Redes Sociais
Plugin URI: http://exemplo.com
Description: Plugin desenvolvido para exibir as minhas redes sociais
Version: 1.0
Author: Guilherme Francisquini
Author URI: http://meusite.com.br
Text Domain: minhas-redes-sociais
License: GPL2
*/
require_once (dirname(__FILE__).'/widget/meu_widget.php');
class MinhasRedes {
    private static $instance;

    public static function getInstance() {
    if (self::$instance == NULL) {
        self::$instance = new self();
    }

    return self::$instance;
    }

    private function __construct() {
        add_action('widgets_init', array($this, 'registerWidgets'));
    }

    public function registerWidgets()
    {
        register_widget( 'MeuWidget' );
    }
}

MinhasRedes::getInstance();