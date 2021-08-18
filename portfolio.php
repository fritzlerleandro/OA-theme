<?php 

/*Template Name: Portfolio*/

get_header();?>

    <ul class="thumbnails">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <li class="span4">
        <a href="<?php the_permalink(); ?>" class="thumbnail">
        <?php the_post_thumbnail('grid-image'); ?>
        </a>
    </li>

    <?php endwhile; endif;?>
    
    </ul>

<?php get_footer();?>