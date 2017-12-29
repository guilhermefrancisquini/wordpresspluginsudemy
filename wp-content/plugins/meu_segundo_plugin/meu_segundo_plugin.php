<?php
/**
 * Plugin Name: Personalizar painel
 * Plugin URI: http://infowebtec.com.br
 * Description: Plugin desenvolvido para personalizar painel
 * Version: 1.0
 * Author: Guiherme Francisquini
 * Author URI: http://infowebtec.com.br
 * Text Domain: meu_segundo_plugin
 * License: GPLv2
 */

 // Desativar a action welcome panel

 class SegundoPlugin
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
        //Desativa a action welcome_panel
        remove_action('welcome_panel', 'wp_welcome_panel');

        //Adiciona nova action
        add_action('welcome_panel', array($this, 'welcome_panel'));
    }

    public function welcome_panel()
    {
        echo '
        <div class="welcome-panel-content">
            <h3> Seja Bem vindo ao Painel Administrativo</h3>
            <p> Siga-nos nas redes sociais </p>
            <div id="icons">
                <a href="#" target="_blank">
                    <img src="http://wordpress.dev/wp-content/uploads/2017/12/1474968161-youtube-circle-color.png">
                </a>
                <a href="#" target="_blank">
                    <img src="http://wordpress.dev/wp-content/uploads/2017/12/1474968150-facebook-circle-color.png">
                </a>
            </div>
        </div>
        ';
    }
}

SegundoPlugin::getInstance();