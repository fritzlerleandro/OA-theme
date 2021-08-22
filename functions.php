<?php

function load_stylesheets(){
    wp_register_style('stylesheet', get_template_directory_uri() . '/style.css', '', 1, 'all');
    wp_enqueue_style('stylesheet');

    wp_register_style('custom', get_template_directory_uri() . '/app.css', '', 1, 'all');
    wp_enqueue_style('custom');
}
add_action('wp_enqueue_scripts', 'load_stylesheets');

// wp_enqueue_script( 'jquery-lightbox', get_stylesheet_directory_uri() . '/js/jquery.lightbox-0.5.min.js', array( 'jquery' ) );
// wp_enqueue_style( 'jquery-lightbox', get_stylesheet_directory_uri() . '/css/jquery.lightbox-0.5.css' );

function load_javascript(){
    wp_register_script('custom', get_template_directory_uri() . '/app.js', 'jquery', 1, true);
    wp_enqueue_script('custom');
}
add_action('wp_enqueue_scripts', 'load_javascript');

//Add Theme Support
add_theme_support ('menus');
add_theme_support ('post-thumbnails');

//Register menues
register_nav_menus(

    array (
            'top-menu' => 'Top Menu',
            'con-carrito' => 'Con Carrito',
    )

);

//Add image sizes
add_image_size('post_image', 1100, 750, false);
add_image_size('grid_image', 500, 500, true);

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'THEMENAME' ),
) );

// No usar los estilos de las galerías por defecto
add_filter( 'use_default_gallery_style', '__return_false' );

// Slider para posts de portfolio
add_action('init', 'register_my_scripts');

// Registra el archivo .js del directorio donde lo tengo almacenado
function register_my_scripts() {
	wp_register_script( 'flexslider', get_stylesheet_directory_uri() . '/flexslider/jquery.flexslider-min.js', array('jquery'), '1.0.0', true );
}

// Agrega la etiqueta script a mi archivo footer.php con un condicional para
// que no se cargue en todos los post, sino sólo los que requieren slider
add_action('wp_footer', 'print_my_script', 99);

function print_my_script() {
	global $add_my_script, $ss_atts;
	if ( $add_my_script ) {
		$speed = $ss_atts['slideshowspeed']*1000;
		echo "<script type=\"text/javascript\">
jQuery(document).ready(function($) {
	$('head').prepend($('<link>').attr({
		rel: 'stylesheet',
		type: 'text/css',
		media: 'screen',
		href: '" . get_stylesheet_directory_uri() . "/flexslider/flexslider.css'
	}));
	$('.flexslider').flexslider({
		animation: '".$ss_atts['animation']."',
		slideshowSpeed: ".$speed.",
		controlNav: false
	});
});
</script>";
		wp_print_scripts('flexslider');
	} else {
		return;
	}
}

// Crear un tipo de publicación personalizada para las slides.
// dentro de los argumentos, "'public' => false," está declarado así
//para que no se indexe en mototores de búsqueda.
add_action( 'init', 'create_slider_posttype' );
function create_slider_posttype() {
    $args = array(
      'public' => false,
      'show_ui' => true,
      'menu_icon' => 'dashicons-images-alt',
      'capability_type' => 'page',
      'rewrite' => array( 'slider-loc', 'post_tag' ),
      'label'  => 'Simple slides',
      'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail', 'page-attributes')
    );
    register_post_type( 'slider', $args );
}

add_action( 'init', 'create_slider_location_tax' );
function create_slider_location_tax() {
	register_taxonomy(
		'slider-loc',
		'slider',
		array(
			'label' => 'Slider location',
			'public' => false,
			'show_ui' => true,
			'show_admin_column' => true,
			'rewrite' => false
		)
	);
}

//Crea un post-meta-value para cada slide. 
// Este valor se utiliza como valor de URL predeterminado para el custom field.
add_action('wp_insert_post', 'set_default_slidermeta');

function set_default_slidermeta($post_ID){
    add_post_meta($post_ID, 'slider-url', 'http://', true);
    return $post_ID;
}

// Crea el shortcode para poder usar las slides en cualquier post
add_shortcode( 'simpleslider', 'simple_slider_shortcode' );

function simple_slider_shortcode($atts = null) {
	global $add_my_script, $ss_atts;
	$add_my_script = true;
	$ss_atts = shortcode_atts(
		array(
			'location' => '',
			'limit' => -1,
			'ulid' => 'flexid',
			'animation' => 'slide',
			'slideshowspeed' => 5
		), $atts, 'simpleslider'
	);
	$args = array(
		'post_type' => 'slider',
		'posts_per_page' => $ss_atts['limit'],
		'orderby' => 'menu_order',
		'order' => 'ASC'
	);
	if ($ss_atts['location'] != '') {
		$args['tax_query'] = array(
			array( 'taxonomy' => 'slider-loc', 'field' => 'slug', 'terms' => $ss_atts['location'] )
		);
	}
	$the_query = new WP_Query( $args );
	$slides = array();
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$imghtml = get_the_post_thumbnail(get_the_ID(), 'full');
			$url = get_post_meta(get_the_ID(), 'slider-url', true);
			if ($url != '' && $url != 'http://') {
				$imghtml = '<a href="'.$url.'">'.$imghtml.'</a>';
			}
			$slides[] = '
				<li>
					<div class="slide-media">'.$imghtml.'</div>
					<div class="slide-content">
						<h3 class="slide-title">'.get_the_title().'</h3>
						<div class="slide-text">'.get_the_content().'</div>
					</div>
				</li>';
		}
	}
	wp_reset_query();
	return '
	<div class="flexslider flexslider-custom" id="'.$ss_atts['ulid'].'">
		<ul class="slides">
			'.implode('', $slides).'
		</ul>
	</div>';
}

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 650,
        'single_image_width'    => 1080,

        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 3,
            'min_columns'     => 2,
            'max_columns'     => 3,
        ),
    ) );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

//* Make Font Awesome available
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );
function enqueue_font_awesome() {

	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );

}

/**
 * Place a cart icon with number of items and total cost in the menu bar.
 *
 * Source: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 */
add_filter('wp_nav_menu_items','sk_wcmenucart', 10, 2);
function sk_wcmenucart($menu, $args) {

	// Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'secondary' !== $args->theme_location )
		return $menu;

	ob_start();
		global $woocommerce;
		$viewing_cart = __('View your shopping cart', 'OA%20-%20theme');
		$start_shopping = __('Start shopping', 'OA%20-%20theme');
		$cart_url = $woocommerce->cart->get_cart_url();
		$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
		$cart_contents_count = $woocommerce->cart->cart_contents_count;
		$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'OA%20-%20theme'), $cart_contents_count);
		$cart_total = $woocommerce->cart->get_cart_total();
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		 if ( $cart_contents_count > 0 ) {
			if ($cart_contents_count == 0) {
				$menu_item = '<li class="right"><a class="wcmenucart-contents" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
			} else {
				$menu_item = '<li class="right"><a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';
			}

			$menu_item .= '<i class="fa fa-shopping-cart"></i> ';

			$menu_item .= $cart_contents.' - '. $cart_total;
			$menu_item .= '</a></li>';
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		// }
		echo $menu_item;
	$social = ob_get_clean();
	return $menu . $social;

}}

// Widgets Areas to the footer 
function register_widget_areas() {

  register_sidebar( array(
    'name'          => 'Footer Area 1',
    'id'            => 'footer_area_one',
    'description'   => 'Podés agregar cualquier tipo de contenido acá',
    'before_widget' => '<section class="footer-area footer-area-1 col-sm-12 col-lg-auto col-md-6 mt-3">',
    'after_widget'  => '</section>',
    'before_title'  => '<h5 class="footer-widget-title">',
    'after_title'   => '</h5>',
  ));

  register_sidebar( array(
    'name'          => 'Footer Area 2',
    'id'            => 'footer_area_two',
    'description'   => 'Podés agregar cualquier tipo de contenido acá',
    'before_widget' => '<section class="footer-area footer-area-2 col-sm-12 col-lg-auto col-md-6 mt-3">',
    'after_widget'  => '</section>',
    'before_title'  => '<h5 class="footer-widget-title">',
    'after_title'   => '</h5>',
  ));

  register_sidebar( array(
    'name'          => 'Footer Area 3',
    'id'            => 'footer_area_three',
    'description'   => 'Podés agregar cualquier tipo de contenido acá',
    'before_widget' => '<section class="footer-area footer-area-3 col-sm-12 col-lg-auto col-md-6 mt-3">',
    'after_widget'  => '</section>',
    'before_title'  => '<h5 class="footer-widget-title">',
    'after_title'   => '</h5>',
  ));

  register_sidebar( array(
    'name'          => 'Footer Area 4',
    'id'            => 'footer_area_four',
    'description'   => 'Podés agregar cualquier tipo de contenido acá',
    'before_widget' => '<section class="footer-area footer-area-4 col-sm-12 col-lg-auto col-md-6 mt-3">',
    'after_widget'  => '</section>',
    'before_title'  => '<h5 class="footer-widget-title">',
    'after_title'   => '</h5>',
  ));

    register_sidebar( array(
    'name'          => 'Footer Fijo',
    'id'            => 'footer_area_fixed',
    'description'   => 'Esto queda siempre fijo en pantalla debajo de todo. Es recomendable usar poco texto para no opacar otro contenido. Si le ponés un título, va a aparecer como los del footer, modo contrario, sólo el texto que quieas (correo, lugar, etc)',
    'before_widget' => '<div class="fixed-footer d-flex flex-column pt-2 col-sm-12 col-md-12 col-ls-12 justify-content-end bg-white fixed-bottom">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5 class="footer-widget-title">',
    'after_title'   => '</h5>',
  ));
}

add_action( 'widgets_init', 'register_widget_areas' );

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );

// Disables the block editor from managing widgets. renamed from wp_use_widgets_block_editor
add_filter( 'use_widgets_block_editor', '__return_false' );

function OA_customize_register( $wp_customize ) {
  //All our sections, settings, and controls will be added here
}
add_action( 'customize_register', 'OA_customize_register' );