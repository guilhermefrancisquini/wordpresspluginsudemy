<?php
/**
 * Plugin Name: Filmes reviews
 * Plugin URI: http://infowebtec.com.br
 * Description: Plugin para reviews de filmes
 * Version: 1.0
 * Author: Guiherme Francisquini
 * Author URI: http://infowebtec.com.br
 * Text Domain: filmes_reviews
 * License: GPLv2
 */

require dirname( __FILE__ ) . '/libraries/class-tgm-plugin-activation.php';

class FilmesReviews
{
    private static $instance;
    const TEXT_DOMAIN = 'filmes_reviews';
    const FIELD_PREFIX = 'fr_';

    public static function getInstance()
    {
        if(self::$instance == NULL)
        {
            self::$instance = new self();
        }
    }

    private function __construct()
    {
        add_action( 'init', 'FilmesReviews::register_post_type' );
        add_action( 'init', 'FilmesReviews::registerTaxonomies' );
        add_action( 'tgmpa_register', array($this, 'check_required_plugins') );
        add_filter( 'rwmb_meta_boxes', array($this, 'metaboxCustomFields') );

        // Template customizado
        add_action( 'template_include', array($this, 'addCptTemplate') );
        add_action( 'wp_enqueue_scripts', array($this, 'addStyleScripts') );
    }

    public static function register_post_type()
    {
        register_post_type( 'filmes_reviews', array(
            'labels' => array(
                'name' => 'Filmes Reviews',
                'singular_name' => 'Filme Review',
            ),
            'description' => 'Post para cadastro de reviews',
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'author',
                'revisions',
                'thumbnail',
                'custom-fields',
            ),
            'public' => TRUE,
            'menu_position' => 3,
            'menu_icon' => 'dashicons-format-video', 
        ));
    }

    public static function registerTaxonomies()
    {
        register_taxonomy( 'tipos_filmes', array( 'filmes_reviews'), 
            array(
                'labels' => array(
                    'name' => __('Filmes Tipos'),
                    'singular_name' => __('Filme Tipo'),
                ),
                'public' => TRUE,
                'hierarchical' => TRUE,
                'rewrite' => array(
                    'slug' => 'tipos-filmes'
                ),
            ) 
        );
    }

    /*
    * checar plugins requeridos
    */
    public function check_required_plugins()
    {
        $plugins = array(
            array(
                'name' => 'Meta Box',
                'slug' => 'meta-box',
                'required' => TRUE,
                'force_activation' => FALSE,
                'force_desactivation' => FALSE,
            ),
        );

        /*Config*/
        $config  = array(
            'domain'           => TEXT_DOMAIN,
            'default_path'     => '',
            'parent_slug'      => 'plugins.php',
            'capability'       => 'update_plugins',
            'menu'             => 'install-required-plugins',
            'has_notices'      => true,
            'is_automatic'     => false,
            'message'          => '',
            'strings'          => array(
              'page_title'                      => __( 'Instalar plugins requeridos', TEXT_DOMAIN ),
              'menu_title'                      => __( 'Instalar Plugins', TEXT_DOMAIN),
              'installing'                      => __( 'Instalando Plugin: %s', TEXT_DOMAIN),
              'oops'                            => __( 'Algo deu errado com a API do plug-in.', TEXT_DOMAIN ),
              'notice_can_install_required'     => _n_noop( 'O Comentário do plugin Filmes Reviews depende do seguinte plugin:%1$s.', 'Os Comentários do plugin Filmes Reviews depende dos seguintes plugins:%1$s.' ),
              'notice_can_install_recommended'  => _n_noop( 'O plugin Filmes review recomenda o seguinte plugin: %1$s.', 'O plugin Filmes review recomenda os seguintes plugins: %1$s.' ),
              'notice_cannot_install'           => _n_noop( 'Desculpe, mas você não tem as permissões para instalar o plugin %s. Entre em contato com o administrador do site para obter ajuda em obter o plugin instalado.', 'Desculpe, mas você não tem as permissões para instalar os plugins %s . Entre em contato com o administrador do site para obter ajuda em obter o plugin instalado.' ),
              'notice_can_activate_required'    => _n_noop( 'O seguinte plug-in necessário está inativo no momento:%1$s.', 'Os seguintes plugins necessários estão inativos no momento:%1$s.' ),
              'notice_can_activate_recommended' => _n_noop( 'O seguinte plug-in necessário está inativo no momento:%1$s.', 'Os seguintes plugins necessários estão inativos no momento:%1$s.' ),
              'notice_cannot_activate'          => _n_noop( 'Desculpe, mas você não tem as permissões para instalar o plugin %s. Entre em contato com o administrador do site para obter ajuda em obter o plugin instalado.', 'Desculpe, mas você não tem as permissões para instalar os plugins %s . Entre em contato com o administrador do site para obter ajuda em obter o plugin instalado.' ),
              'notice_ask_to_update'            => _n_noop( 'O seguinte plugin precisa ser atualizado para a última versão para assegurar o máximo de compatibilidade com este tema:%1$s.', 'Os seguintes plugins precisam ser atualizados para a última versão para assegurar o máximo de compatibilidade com este tema:%1$s.' ),
              'notice_cannot_update'            => _n_noop( 'Desculpe, mas você não tem as permissões para instalar o plugin %s. Entre em contato com o administrador do site para obter ajuda em obter o plugin atualizado.', 'Desculpe, mas você não tem as permissões para instalar os plugins %s . Entre em contato com o administrador do site para obter ajuda em obter o plugin atualizado.' ),
              'install_link'                    => _n_noop( 'Comece a instalação de plug-in', 'Comece a instalação dos plugins' ),
              'activate_link'                   => _n_noop( 'Ativar o plugin instalado', 'Ativar os plugins instalados' ),
              'return'                          => __( 'Voltar parapara os plugins requeridos instalados', TEXT_DOMAIN ),
              'plugin_activated'                => __( 'Plugin ativado com sucesso.', TEXT_DOMAIN ),
              'complete'                        => __( 'Todos os plugins instalados e ativados com sucesso. %s', TEXT_DOMAIN ),
              'nag_type'                        => 'updated',
            )
          );

        tgmpa( $plugins, $config ); 
        /*Fim Config*/  
    }

    /*METABOX*/
    public function metaboxCustomFields()
    {
        $metabox[] = array(
            'id' => 'data_filme',
            'title' => __('Informações Adicionais', 'filmes_reviews'),
            'pages' => __('filmes_reviews', 'pots'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Ano de lançamento', 'filmes_reviews'),
                    'desc' => __('Ano que o filme foi lançado', 'filmes_reviews'),
                    'id' => self::FIELD_PREFIX.'filme_ano',
                    'type' => 'number',
                    'std' => date('Y'),
                    'min' => '1880',
                ),
                array(
                    'name' => __('Diretor', 'filmes_reviews'),
                    'desc' => __('Quem dirigiu o filme', 'filmes_reviews'),
                    'id' => self::FIELD_PREFIX.'filme_diretor', 
                    'type' => 'text',
                    'std' => '',
                ),
                array(
                    'name' => 'Site',
                    'desc' => 'Link do site do filme',
                    'id' => self::FIELD_PREFIX.'filme_site',
                    'type' => 'url',
                    'std' => '',
                ),
            ),
        );

        $metabox[] = array(
            'id' => 'review_data',
            'title' => __('Filme Review', 'filmes_reviews'),
            'pages' => array('filmes_reviews'),
            'context' => 'side',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => __('Rating', 'filmes_reviews'),
                    'desc' => __('Em uma escala de 1 - 10, sendo que 10 é a melhor nota', 'filmes_reviews'),
                    'id' => self::FIELD_PREFIX.'review_rating',
                    'type' => 'select',
                    'options' => array(
                        '' => __('Avalie aqui', 'filmes_reviews'),
                        1 => __('1 - Gostei um pouco', 'filmes_reviews'),
                        2 => __('2 - Eu gostei mais ou menos', 'filmes_reviews'),
                        3 => __('3 - Não recomendo', 'filmes_reviews'),
                        4 => __('4 - Deu pra assistir tudo', 'filmes_reviews'),
                        5 => __('5 - Filme descente', 'filmes_reviews'),
                        6 => __('6 - Filme Legal', 'filmes_reviews'),
                        7 => __('7 - Legal, recomendo', 'filmes_reviews'),
                        8 => __('8 - O meu favorito', 'filmes_reviews'),
                        9 => __('9 - Amei um dos meus melhores filmes', 'filmes_reviews'),
                        10 => __('10 - O melhor filmes de todos os tempos, recomendo!!', 'filmes_reviews'),
                    ),
                    'std' =>'',
                ),
            ),
        );

        return $metabox;
    }

    public function addCptTemplate($template)
    {
        if(is_singular( 'filmes_reviews' ))
        {
            if(file_exists(get_stylesheet_directory().'view/single_filme_review.php'))
            {
                return get_stylesheet_directory().'view/single_filme_review.php';
            }

            return plugin_dir_path( __FILE__ ).'view/single_filme_review.php';
        }

        return $template;
    }

    public function addStyleScripts()
    {
        wp_enqueue_style( 'filme_review_style', plugin_dir_url( __FILE__ ).'css/filme_review.css' );
    }

    public static function activate()
    {
        self::register_post_type();
        self::registerTaxonomies();
        flush_rewrite_rules();
    }
}

FilmesReviews::getInstance();

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'FilmesReviews::activate' );