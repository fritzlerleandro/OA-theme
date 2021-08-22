<?php get_header();?>

<div class="content">

    <div class="container">

        <div class="post-navigation d-flex justify-content-between fixed-top" style="margin: 8rem 1rem 0 1rem">
            <p class="post-nav-desktop"><?php echo get_previous_post_link('%link', '◄ %title')?></p>
            <p class="post-nav-desktop"><?php echo get_next_post_link('%link', '%title ►');?></p>
            <p class="post-nav-mobile"><?php echo get_previous_post_link('%link', '◄ Anterior')?></p>
            <p class="post-nav-mobile"><?php echo get_next_post_link('%link', 'Siguiente ►');?></p>
        </div>
        <h1 class="proyecto"><?php the_title()?></h1>
         <p class="mb-1 text-center subtitulos"><?php the_field('lugar') ?></p>
         <?php if( get_field('metros_cuadrados') ): ?>
         <p class="mb-1 text-center subtitulos">
            <?php the_field('metros_cuadrados'); echo 'm<sup>2</sup>'; ?> </p>
         <?php endif; ?>
         <p class="mb-1 text-center subtitulos"><?php the_field('descripcion') ?></p>
         <?php $post_slug = get_post_field( 'post_name', get_post() ); ?>

        <?php if(have_posts()) : while(have_posts()) : the_post();?>

        <?php the_content();?>         
        
        <?php endwhile; else : endif?>

    </div>
</div>

<?php get_footer();?>