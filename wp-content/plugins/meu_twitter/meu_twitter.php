<?php
/*
Plugin Name: Meu Twitter
Plugin URI: http://exemplo.com
Description: Plugin desenvolvido para cadastro do botão twitter
Version: 1.0
Author: Guilherme Francisquini
Author URI: http://meusite.com.br
Text Domain: meu-twitter
License: GPL2
*/
$url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
$url .= $_SERVER['SERVER_NAME'];
if(!defined('ABSPATH')) header('Location:'. $url); //segurança plugin
class MeuTwitter {
    private static $instance;

    public static function getInstance() {
    if (self::$instance == NULL) {
        self::$instance = new self();
    }

    return self::$instance;
    }

    private function __construct() {
        add_action('admin_menu', array($this, 'setCustomFields'));
        add_shortcode('twitter', array($this, 'twitter'));
    }

    public function setCustomFields()
    {
        add_menu_page( 'Meu Twitter', 'Meu Twitter', 'manage_options', 'meu-twitter', 'MeuTwitter::saveCustomFields', 'dashicons-twitter', 25 );
    }

    public function saveCustomFields()
    {
        echo '<h3>'.__("Cadastro do Twitter", 'meu-twitter').'</h3>';
        echo '<form method="post">';
        $fields = array('twitter');
        foreach($fields as $field):

            if(isset($_POST[$field]))
                update_option($field, $_POST[$field]);

            $value = stripcslashes(get_option( $field ));
            $label = ucwords(strtolower($field));
            echo "
                <p>
                    <label>$label</label><br>
                    <textarea cols='100' rows='10' name='$field'> $value </textarea>
                </p>
            ";
        endforeach;
        $nameButton = (get_option( 'twitter' ) !== "") ? "Editar" : "Cadastrar";
        echo "<input type='submit' value='$nameButton'>";
        echo '</form>';
    }

    public function twitter($params = null)
    {
        return stripcslashes(get_option( 'twitter' ));
    }

}

MeuTwitter::getInstance();