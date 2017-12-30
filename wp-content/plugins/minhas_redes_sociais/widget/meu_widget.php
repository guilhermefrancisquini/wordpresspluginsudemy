<?php

    class MeuWidget extends WP_Widget
    {
        public function __construct()
        {
            parent::WP_Widget(FALSE, $name="Visite minhas redes sociais");
        }

        public function widget($args, $instance)
        {
            extract($args);
            $title = apply_filters( 'widget_title', $instance['title'] );
            $urlFacebook = $instance['urlFacebook'];
            $urlTwitter = $instance['urlTwitter'];
            $urlInstagram = $instance['urlInstagram'];
            $urlYoutube = $instance['urlYoutube'];

            echo $before_widget;
            if($title)
            {
                echo $before_widget . $title . $after_widget;
                echo "<a href='$urlFacebook'><img src='plugin_dir_url(__FILE__)./images/facebook.png' alt='facebook'/></a>";
                echo "<a href='$urlTwitter'><img src='plugin_dir_url(__FILE__)./images/twitter.png' alt='twitter'/></a>";
                echo "<a href='$urlInstagram'><img src='plugin_dir_url(__FILE__)./images/instagram.png' alt='instagram'/></a>";
                echo "<a href='$urlYoutube'><img src='plugin_dir_url(__FILE__)./images/youtube.png' alt='youtube'/></a>";
            }
            echo $after_widget;
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['urlFacebook'] = wp_strip_all_tags( $new_instance['urlFacebook'] );
            $instance['urlTwitter'] = wp_strip_all_tags( $new_instance['urlTwitter'] );
            $instance['urlInstagram'] = wp_strip_all_tags( $new_instance['urlInstagram'] );
            $instance['urlYoutube'] = wp_strip_all_tags( $new_instance['urlYoutube'] );

            return $instance;
        }

        public function form($instance)
        {
            $title = esc_attr( $instance['title'] );
            $urlFacebook = esc_attr( $instance['urlFacebook'] );
            $urlTwitter = esc_attr( $instance['urlTwitter'] );
            $urlInstagram = esc_attr( $instance['urlInstagram'] );
            $urlYoutube = esc_attr( $instance['urlYoutube'] );

            echo "
                <p>
                    <label for='".$this->get_field_id('title')."'>".__('Título')."</label>
                    <input class='widefat' type='text' id='".$this->get_field_id('title')."' name='".$this->get_field_name('title')."' value='$title' />
                </p>
                <p>
                    <label for='".$this->get_field_id('urlFacebook')."'>".__('Facebook')."</label>
                    <input class='widefat' type='text' id='".$this->get_field_id('urlFacebook')."' name='".$this->get_field_name('urlFacebook')."' value='$urlFacebook' />
                </p>
                <p>
                    <label for='".$this->get_field_id('urlTwitter')."'>".__('Twitter')."</label>
                    <input class='widefat' type='text' id='".$this->get_field_id('urlTwitter')."' name='".$this->get_field_name('urlTwitter')."' value='$urlTwitter' />
                </p>
                <p>
                    <label for='".$this->get_field_id('urlInstagram')."'>".__('Instagram')."</label>
                    <input class='widefat' type='text' id='".$this->get_field_id('urlInstagram')."' name='".$this->get_field_name('urlInstagram')."' value='$urlInstagram' />
                </p>
                <p>
                    <label for='".$this->get_field_id('urlYoutube')."'>".__('Youtube')."</label>
                    <input class='widefat' type='text' id='".$this->get_field_id('urlYoutube')."' name='".$this->get_field_name('urlYoutube')."' value='$urlYoutube' />
                </p>
            ";
        }
    }