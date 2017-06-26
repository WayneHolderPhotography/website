<?php
/*
Template Name:gallery
*/
get_header(); ?>

<div class="page">
    <div class="contentwrapper">
		<div class="album-title">
		    <h2 class="entry-title">CLIENT AREA</h2>
		</div>
        <div class="row smallgrid">
            <?php
                $args = array( 'post_type' => 'gallery', 'order' => 'ASC', 'posts_per_page' => -1);
                $news = new WP_Query( $args );
                while ( $news->have_posts() ) : $news->the_post();
                $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
            ?>

            <div class="col span_4 portfoliotile">
                <a href="<?php the_permalink(); ?>" class="imgwrapper">
                    <img src="<?php echo $url;?>" alt="Best of&#8230;2016">
                    <span class="overlay">
                        <span class="liner">
                            <span class="title">Best of&#8230;2016</span>
                            <span class="subtitle ellip">Top 100 moments of the year!</span>
                        </span>
                    </span>
                    <span class="sectiontype">Blog</span>
                </a>
            </div>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
        </div>
	</div>
</div>
<?php get_footer(); ?>
					   