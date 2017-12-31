<?php
/*
Plugin Name: Meu QuickTag
Plugin URI: http://exemplo.com
Description: Plugin desenvolvido para inserir quicktag personalizada
Version: 1.0
Author: Guilherme Francisquini
Author URI: http://meusite.com.br
Text Domain: meu-quicktag
License: GPL2
*/

$url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
$url .= $_SERVER['SERVER_NAME'];

if(!defined('ABSPATH')) header('Location:'. $url); //segurança plugin

class MeuQuicktag {
    private static $instance;

    public static function getInstance() {
    if (self::$instance == NULL) {
        self::$instance = new self();
    }

    return self::$instance;
    }

    private function __construct() {
        add_action( 'admin_print_footer_scripts',array($this, 'myQuicktag') );
    }

    public function myQuicktag()
    {
        if(wp_script_is( 'quicktags')):
            echo "
                <script type='text/javascript'>
                    //função para recuperar texto selecionado
                    function getSel()
                    {
                        var txtarea = document.getElementById('content');
                        var start = txtarea.selectionStart;
                        var finish = txtarea.selectionEnd;

                        return txtarea.value.substring(start, finish);
                    }

                    QTags.addButton('btn_personalizado', 'Short Code Twitter', getT);
                    
                    function getT()
                    {
                        var selected_text = getSel();
                        QTags.insertContent('[twitter]');
                    }
                </script>
            ";
        endif;
    }
}

MeuQuicktag::getInstance();