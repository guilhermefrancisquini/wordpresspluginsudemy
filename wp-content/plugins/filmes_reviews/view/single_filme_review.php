<?php 
    //Template Default do Filmes Reviews
    get_header();
?>

<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="content site-main" role="main">
        <?php
            while(have_posts()) : the_post();

                $field_prefix = FilmesReviews::FIELD_PREFIX;
                $image = get_the_post_thumbnail( get_the_ID(), 'medium' );
                $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID(), 'medium' ) );// recupera o thumnail

                $rating = (int)post_custom( $field_prefix . 'review_rating' );
                $show_rating = showRating($rating); // mostrar rating função para exibir dash icon
                
                $director = wp_strip_all_tags( post_custom( $field_prefix.'filme_diretor' ) );
                $link_site = esc_url( post_custom( $field_prefix.'filme_site' ) );
                $year = (int)post_custom( $field_prefix.'filme_ano' );
                $movies = get_the_terms(get_the_ID(), 'tipos_filmes');
                $types_movies = '';

                if($movies && !is_wp_error( $movies )) :
                
                    $types_movies = array();

                    foreach($movies as $cat) :
                    
                        $types_movies[] = $cat->name;
                    endforeach;
                endif;        
        ?>
            <article id="post<?php the_ID();?>" <?php post_class('hentry'); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header>
            
            
                <div class="entry-content">
                    <div class="left">
                        <?php

                            //mostra thumbnail
                            if(isset($image)) :
                                echo '<div class="poster">';
                                if(isset($link_site)) :                        
                                    echo "<a href='$link_site' target='_blank'>$image</a>";                        
                                else :
                                    echo $image;
                                endif;
                                echo '</div>';
                            endif;

                            // mostra rating abaixo da thumbnail
                            if( !empty($show_rating) ) :
                                echo "<div class='rating rating-$rating'>";
                                    echo $show_rating;
                                echo '</div>';
                            endif;

                            //mostra detalhes do filme
                            if( !empty($director) ) :
                                echo '<div class="diretor-filme">';
                                    echo "<label>Digido por: <span style='font-weight: normal;'>$director</span></label>";
                                echo '</div>';
                            endif;

                            //mostra categoria do filme
                            if( !empty($types_movies) ):
                                echo '<div class="tipo">';
                                    echo '<label>Gênero: <span style="font-weight: normal;">'. implode(', ', $types_movies) .'</span></label>';
                                echo '</div>';
                            endif;

                            //mostra ano do filme
                            if( !empty($year) ) :
                                echo '<div class="lancamento-ano">';
                                    echo "<label>Ano: <span style='font-weight: normal;'>$year</span></label>";
                                echo '</div>';
                            endif;

                            //mostra link do filme
                            if( !empty($link_site) ) :
                                echo '<div class="link">';
                                    echo "<label>Site: <a href='$link_site' style='font-weight: normal;'>Visite o site</a></label>";
                                echo '</div>';
                            endif;                    
                        ?>                
                    </div>
                    <div class="right">
                        <div class="review-body">
                            <?= the_content() ?>
                        </div>
                    </div>
                </div>
                <?php
                    edit_post_link( __('Editar'), '<footer class="entry-footer"><span class="edit-link">','</span></footer>' );
                ?>
            </article>
            <?php
                //comentários
                if( comments_open() || get_comments_number()) :
                    comments_template();
                endif;

                //navegação de posts
                the_post_navigation(
                    array(
                        'next_text' => '<span class="meta-nav" aria-hidden="true">'.__('Próximo').'</span>'.
                                       '<span class="screen-reader-text">'.__('Próximo Review').'</span>'.
                                       '<span class="post-title"> %title </span>',

                        'prev_text' => '<span class="meta-nav" aria-hidden="true">'.__('Anterior').'</span>'.
                                       '<span class="screen-reader-text">'.__('Review Anterior').'</span>'.
                                       '<span class="post-title"> %title </span>',
                    )
                )
            ?>
        <?php 
            endwhile; 
        ?>
        </main>
    </div>
</div>
<?php get_footer();?>

<?php

    function showRating($rating=NULL)
    {
        $rating = (int)$rating;

        if($rating > 0):
            $stars_rating = array();
            $show_rating = "";

            for($i=0; $i < floor($rating/2);$i++):
                $stars_rating[] = '<span class="dashicons dashicons-star-filled"></span>';
            endfor;

            if($rating % 2 === 1):
                $stars_rating[] = '<span class="dashicons dashicons-star-half"></span>';
            endif;

            $stars_rating = array_pad($stars_rating, 5, '<span class="dashicons dashicons-star-empty"></span>');

            return implode("\n", $stars_rating);
        endif;

        return FALSE;
    }
?>