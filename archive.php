<?php get_header();?>

<div class="container pt-3 mb-5">
        <?php
          $i=0;
          $no_of_columns=4;

          while(have_posts()) : the_post();

            if($i % $no_of_columns == 0) { ?> 

        <div class="row">

        <?php
        }
        ?>

        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xsm-3 mb-3">
            <a href="<?php the_permalink()?>">
                
                <div class="thumb">
                    <div class="thumbnail-portfolio" style= "background-image: url('<?php the_post_thumbnail_url('grid-image')?>'); background-size: cover">
                    </div>

                    <div class="titulo-portfolio mb-6"><?php the_title() ?></div>

                </div>
                

            </a>
        </div>  

            <?php // increment the loop BEFORE we test the variable
             $i++; 
            if($i != 0 && $i % $no_of_columns == 0) { ?>
            </div>

            <?php
            } ?>

            <?php  
            endwhile;
?>
</div>

<?php get_footer();?>