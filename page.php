<?php get_header();?>


<div class="content">

    <div class="container">

         <h1 class="page_h1"><?php the_title()?></h1>

        <?php if(have_posts()) : while(have_posts()) : the_post();?>

        <?php the_content();?>

        <?php endwhile; else : endif?>
    </div>
    
</div>

<?php get_footer();?>