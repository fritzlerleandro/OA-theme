<?php get_header('no-menu');?>
<div>

    <div class="parent d-flex">

    <div id="cf" class="d-flex">
        <img class="img-fluid" src="<?php the_field('imagen_1') ?>" />
        <img class="img-fluid" src="<?php the_field('imagen_2') ?>" />
        <img class="img-fluid" src="<?php the_field('imagen_3') ?>" />
        <img class="img-fluid" src="<?php the_field('imagen_4') ?>" />
        <img class="img-fluid" src="<?php the_field('imagen_5') ?>" />
        
    </div>
    
    <div class="d-flex col-sm-12 justify-content-center">
        <a class="home-access align-self-center" href="<?php bloginfo('url');?>/portfolio/todos">
            <div class="p-1 titulo-principal"> OFICINA AMBULANTE</div>
            <div class="h5 subtitulo-principal"> ESCRITORIO DE ARQUITECTURA </div>
        </a>
    </div>


    </div>

</div>
<?php get_footer('no-links');?>
