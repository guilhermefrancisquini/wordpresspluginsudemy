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
    const TEXT_DOMAIN = 'meu_segundo_plugin';
    
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

        //Registrando style.css
        add_action('admin_enqueue_scripts', array($this, 'addCss'));

        add_action( 'init', array($this, 'meuSegundoPluginLoadTextDomain') );
    }

    public function meuSegundoPluginLoadTextDomain()
    {
        load_plugin_textdomain( self::TEXT_DOMAIN, false, dirname( plugin_basename( __FILE__ )) );
    }

    public function welcome_panel()
    {
        echo '
        <div class="welcome-panel-content">
            <h3>' . _e('Seja Bem vindo ao Painel Administrativo', 'meu_segundo_plugin') . '</h3>
            <p>' . _e('Siga-nos nas redes sociais', 'meu_segundo_plugin') . '</p>
            <p>' . _e('Olá', 'meu_segundo_plugin') . '</p>
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

    public function addCss()
    {
        wp_register_style( 'style', plugin_dir_url( __FILE__ ).'css/style.css');
        wp_enqueue_style( 'style');
    }
}

SegundoPlugin::getInstance();