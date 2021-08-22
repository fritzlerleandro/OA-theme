<footer class="d-flex container main-footer mt-5 mb-5 bg-white justify-content-lg-between justify-content-md-between justify-content-sm-center">
    <div class="d-flex full footer-content">

        <?php if ( !function_exists('dynamic_sidebar') ||
 !dynamic_sidebar('footer_area_one') ) : ?>
<?php endif; ?>    

        <?php if ( !function_exists('dynamic_sidebar') ||
 !dynamic_sidebar('footer_area_two') ) : ?>
<?php endif; ?>    

        <?php if ( !function_exists('dynamic_sidebar') ||
 !dynamic_sidebar('footer_area_three') ) : ?>
<?php endif; ?>   

        <?php if ( !function_exists('dynamic_sidebar') ||
 !dynamic_sidebar('footer_area_four') ) : ?>
<?php endif; ?>   

        <?php if ( !function_exists('dynamic_sidebar') ||
 !dynamic_sidebar('footer_area_fixed') ) : ?>
<?php endif; ?>

        <div class="chivo pt-3 col-sm-12 col-md-12 col-ls-12 d-flex justify-content-center"><p>Desarrollado por <a href="https://www.leandrofritzler.com.ar">Leandro Andrés Fritzler</a></p></div>
    </div>
</footer>
 <?php wp_footer();?>
</body>
</html>