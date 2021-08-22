<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oficina Ambulante - Arquitectura & Mobiliario</title>
    <?php wp_head();?>

    <script type="text/javascript">
	jQuery(document).ready(function($) {
		var images_dir = '<?php echo get_stylesheet_directory_uri() . "/images/"; ?>';
		$('.gallery-item a').lightBox({
			imageLoading: images_dir + 'lightbox-ico-loading.gif',
			imageBtnPrev: images_dir + 'lightbox-btn-prev.gif',
			imageBtnNext: images_dir + 'lightbox-btn-next.gif',
			imageBtnClose: images_dir + 'lightbox-btn-close.gif',
			imageBlank: images_dir + 'lightbox-blank.gif'
		});
	});
</script>

</head>

<body <?php body_class('test');?>>
<div id="wptime-plugin-preloader"></div>
    <nav id="nav-bar" class="navbar navbar-expand-md navbar-light fixed-top mb-5 white-nav" style="margin-top:.1rem, margin-bottom: 4rem !important; z-index:2000" role="navigation">
        <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand d-flex" href="<?php bloginfo('url');?>/portfolio/todos">
            <img src="<?php bloginfo('template_directory');?>/images/OA-logo.jpg" alt="logo" class="logo" style="height: 3rem">
            <!-- <p class="mobile titulo-nav">OFICINA AMBULANTE</p> -->
        </a>
        <?php
        wp_nav_menu( array(
            'theme_location'    => 'primary',
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse espaciado',
            'container_id'      => 'bs-example-navbar-collapse-1',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker(),
        ) );
        ?>
    </div>
</nav>