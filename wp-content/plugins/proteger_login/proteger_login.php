<?php
/*
Plugin Name: Proteger Login
Plugin URI: http://exemplo.com
Description: Plugin desenvolvido para proteger login
Version: 1.0
Author: Guilherme Francisquini
Author URI: http://meusite.com.br
Text Domain: proteger-login
License: GPL2
*/

$url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
$url .= $_SERVER['SERVER_NAME'];

if(!defined('ABSPATH')) header('Location:'. $url); //segurança plugin

class ProtegerLogin {
    private static $instance;

    public static function getInstance() {
    if (self::$instance == NULL) {
        self::$instance = new self();
    }

    return self::$instance;
    }

    private function __construct() {
        add_action('login_form_login', 'ProtegerLogin::ptLogin');
    }
    
    public function ptLogin()
    {
        if($_SERVER['SCRIPT_NAME'] == '/wp-login.php')
        {
            //echo "<script>alert(1)</script>";

            $min = Date('i');

            $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
            $url .= $_SERVER['SERVER_NAME'];

            if(!isset($_GET['empresa'.$min]))
            {
                header('Location:' . $url);
            }
        }
    }


}

ProtegerLogin::getInstance();