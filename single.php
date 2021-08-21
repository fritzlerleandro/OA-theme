<?php get_header();?>

<div class="content">

    <div class="container">

        <div class="d-flex justify-content-between fixed-top" style="margin: 8rem 1rem 0 1rem">
            <p class="bold"><?php echo get_previous_post_link();?></p>
            <!-- <p class="bold"><a href=<?//php get_next_post_link()?>>Next Post</a></p> -->
            <p class="bold"><?php echo get_next_post_link();?></p>
        </div>
        <h1 class="proyecto"><?php the_title()?></h1>
         <p class="mb-1 text-center subtitulos"><?php the_field('lugar') ?></p>
         <p class="mb-1 text-center subtitulos"><?php the_field('metros_cuadrados')?></p>
         <p class="mb-1 text-center subtitulos"><?php the_field('descripcion') ?></p>

         <?php $post_slug = get_post_field( 'post_name', get_post() ); ?>

        <?php if(have_posts()) : while(have_posts()) : the_post();?>

        <?php the_content();?>         
        
        <?php endwhile; else : endif?>

    </div>
</div>

<?php get_footer();?>