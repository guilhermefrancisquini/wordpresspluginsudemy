<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			/* Start the Loop */
			/*
			* modificação
			*/

			//query_posts( 'posts_per_page=10&order=ASC' );
			//query_posts( 'post_status=draft' );
			//query_posts( 'tag_id=2' );
			//query_posts( 'cat=3,4' );
			//echo "Nome do blog " . bloginfo();
			//echo "<br>Autor " . the_author(); só funciona dentro do loop

			/**
			 * Primeiro loop
			 */

				/*global $wpdb;

				$sql = "SELECT * FROM $wpdb->posts WHERE post_status = 'publish'";
				$listData = $wpdb->get_results($sql);

				foreach($listData as $value)
				{
					echo '<h3>'. $value->post_title.'</h3>';
					echo $value->post_content;
				}*/
			  
			/**
			 * Fim do primeiro loop
			 */

			/**
			 * Segundo loop
			 */

				// $myPost = new WP_Query( 'pots_per_page=2&orderby=rand' );

				// while( $myPost->have_posts()) : $myPost->the_post();

				// 	echo '<h3>' . the_title() . '<h3>';
				// 	echo the_content();

				// endwhile;
			  
			/**
			 * Fim do segundo loop
			 */

			while ( have_posts() ) : the_post();
			

				get_template_part( 'template-parts/post/content', get_post_format() );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				the_post_navigation( array(
					'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'twentyseventeen' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'twentyseventeen' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
				) );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
