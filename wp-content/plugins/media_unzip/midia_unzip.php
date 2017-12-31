<?php
/*
Plugin Name: Media Unzip
Plugin URI: http://exemplo.com
Description: Plugin desenvolvido para envio de imagens zipadas
Version: 1.0
Author: Guilherme Francisquini
Author URI: http://meusite.com.br
Text Domain: midia-unzip
License: GPL2
*/

$url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
$url .= $_SERVER['SERVER_NAME'];

if(!defined('ABSPATH')) header('Location:'. $url); //segurança plugin

class MidiaUnzip {
    private static $instance;

    public static function getInstance() {
    if (self::$instance == NULL) {
        self::$instance = new self();
    }

    return self::$instance;
    }

    private function __construct() {
        add_action( 'admin_menu', array($this, 'startMediaFileUnzip') );
    }

    public function startMediaFileUnzip()
    {
        add_menu_page('Upload Media Zip', 'Upload Media Zip', 'manage_options', 'upload-media-zips', 'MidiaUnzip::uploadMediaZips', 'dashicons-media-archive', 10);
    }

    public function allowedFileType($fileType)
    {
        $allowedFileType = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');   

        if(in_array($fileType, $allowedFileType))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function uploadMediaZips()
    {
        _e('<h3>Upload de Arquivos ZIP</h3>', 'media-unzip');

        if(isset($_FILES['fileToUpload'])):
            //Preparar os arquivos para serem enviados para o servidor
            //Obter o diretório de upload atual      
            $dir = "../wp-content/uploads".wp_upload_dir()['subdir'];

            //Usar o PHP para carregar o arquivo zip para o diretório de upload
            $target_file = $dir.'/'.basename($_FILES['fileToUpload']['name']);
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
            $file_name = basename($_FILES['fileToUpload']['name']);

            //Criar a instancia de um objeto utilitário zip
            $zip = new ZipArchive();

            //Abri o arquivo zip
            $res = $zip->open($target_file);

            if($res == TRUE):
                $zip->extractTo($dir);
                echo "<h3 style='color:#090;'> O arquivo zip $file_name foi descompactado com êxito </h3>".wp_upload_dir()['url'];

                //exibe uma mensagem com o número de arquivos de mídia  no arquivo zip
                echo " Tem $zip->numFiles Arquivos neste arquivo zip<br>";

                for($i=0;$i<$zip->numFiles;$i++):
                    //obter URL do arquivo de mídia
                    $media_file_name = wp_upload_dir()['url'].'/'.$zip->getNameIndex($i);   
                    
                    //obter o tipo de arquivo mídia
                    $fileType = wp_check_filetype( basename($media_file_name), null );
                    $allowed = MidiaUnzip::allowedFileType($fileType['type']);

                    // Informações dos anexos que será utilizado pela biblioteca de midia
                    if($allowed === true) :
                        //Exibir um link para o usário ver o arquivo de upload.. 
                        echo "<a href='$media_file_name' target='_blank'>$media_file_name</a> Tipos:". $fileType['type']."<br>";
                        $attachment = array(
                            'guid' => $media_file_name,
                            'post_mime_type' => $fileType['type'],
                            'post_title' => preg_replace('/\.[^.]+$/', '', $zip->getNameIndex($i)),
                            'post_content' => '',
                            'post_status' => 'inherit',
                        );

                        $attach_id = wp_insert_attachment( $attachment, $dir.'/'.$zip->getNameIndex($i) );

                        //Metadados para o anexo
                        $attach_data = wp_generate_attachment_metadata( $attach_id, $dir.'/'.$zip->getNameIndex($i) );
                        wp_update_attachment_metadata( $attach_id, $attach_data );
                    else:
                        echo $zip->getNameIndex($i) . ' Não pode ser enviado, o tipo ' . $fileType['type'] . 'não é permitido <br>';
                    endif;

                endfor;

            else:
                echo "<h3 style='color:#F00'>O arquivo zip  não foi descompactado com êxito!</h3>";
            endif;
        endif;
        echo '
            <form style="margin-top:20px" action="/wp-admin/admin.php?page=upload-media-zips" enctype="multipart/form-data" method="post">
                <label> Selecione o arquivo zip <input type="file" name="fileToUpload" id="fileToUpload"/>
                <br>
                <input type="submit" value="Upload de arquivo ZIP" value="submit">
            </form>
        ';
    }

}

MidiaUnzip::getInstance();