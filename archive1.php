<?php get_header();?>

<div class="content">

    <div class="container">

    <?php if(have_posts()) : while(have_posts()) : the_post();?>

        <img src="<?php the_post_thumbnail_url('post_image');?>" class="img-fluid mb-5">   

        <?php the_excerpt();?>

        <?php endwhile; else : endif?>
    </div>

</div>


<?php get_footer();?>

