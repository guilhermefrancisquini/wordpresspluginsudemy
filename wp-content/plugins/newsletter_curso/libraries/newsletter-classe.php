<?php

class NewsletterCursoWidget extends WP_Widget 
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct() 
    {
        parent::__construct(
            'newsletterCursoWidget', // Base ID
            esc_html__( 'Newsletter Curso', 'ns_domain' ), // Name
            array( 'description' => esc_html__( 'Newsletter Curso', 'ns_domain' ), ) // Args
        );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) 
    {
        // outputs the content of the widget
        echo $args['before_widget'];
        echo $args['before_title'];

        if(!empty($instance['title'])):
            echo $instance['title'];
        endif;

        echo $args['after_title'];

        echo "
            <div id='form-msg'>
            </div>
            <form id='subscriber-form' method='post' action='".plugins_url('libraries/newsletter-mailer.php', dirname(__FILE__))."'>
                <div class='form-group'>
                    <label for='name'>Nome:</label>
                    <input type='text' id='name' name='name' class='form-control' required/>
                </div>
                <br>
                <div class='form-group'>
                    <label for='email'>E-mail:</label>
                    <input type='text' id='email' name='email' class='form-control' required/>
                </div>
                <br>
                <input type='hidden' name='recipient' value='".$instance['recipient']."'/>
                <input type='hidden' name='subject' value='".$instance['subject']."'/>
                <input type='submit' class='btn btn-primary' name='subscriber_submit' value='Inscreva-se'/>
            </form>
            <br>
            <br>
        ";
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) 
    {
        // outputs the options form on admin
        $title = !empty($instance['title']) ? $instance['title'] : __('Newsletter Curso', 'ns_domain');
        $recipient = $instance['recipient'];
        $subject = !empty($instance['subject']) ? $instance['subject'] : __('Você tem um novo inscrito', 'ns_domain');

        //form 
        echo "            
            <p>
                <label for='".$this->get_field_id('title')."'>".__('Título')."</label><br>
                <input type='text' id='".$this->get_field_id('title')."' name='".$this->get_field_name('title')."' value='".esc_attr( $title ) ."'/>
            </p>
            <p>
                <label for='".$this->get_field_id('recipient')."'>".__('Destinatário')."</label><br>
                <input type='text' id='".$this->get_field_id('recipient')."' name='".$this->get_field_name('recipient')."' value='".esc_attr( $recipient ) ."'/>
            </p>
            <p>
                <label for='".$this->get_field_id('subject')."'>".__('Assunto')."</label><br>
                <input type='text' id='".$this->get_field_id('subject')."' name='".$this->get_field_name('subject')."' value='".esc_attr( $subject ) ."'/>
            </p>
        ";
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) 
    {
        // processes widget options to be saved
        $instance = array(
            'title' => !empty($new_instance['title']) ? $new_instance['title'] : '',
            'recipient' => !empty($new_instance['recipient']) ? $new_instance['recipient'] : '',
            'subject' => !empty($new_instance['subject']) ? $new_instance['subject'] : '',
        );

        return $instance;
    }
}