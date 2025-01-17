<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<!-- FOOTER -->
<footer id="footer">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-3">
                <div class="footer-widget">
                    <div class="footer-logo">
                        <a href="<?php echo get_option('home'); ?>/" class="logo">
                            <?php
                            $options3 = get_theme_mod('img-upload');
                            if (strlen($options3) > 0) {
                                echo '<img class="footer-logo" src="' . $options3 . '" alt="logo">';
                            } else {
                                echo '<img class="footer-logo" src="./wp-content/themes/twentytwenty/assets/new/img/logo-alt.png" alt="logo">';
                            }
                            ?>
                        </a>
                    </div>
                    <p>Nec feugiat nisl pretium fusce id velit ut tortor pretium. Nisl purus in mollis nunc sed. Nunc
                        non blandit massa enim nec.</p>
                    <ul class="contact-social">
                        <?php
                        $link = get_theme_mod('Facebook link');
                        if (strlen($link) > 0) {
                            echo '<li><a class="social-facebook" href=' . $link . '><i class="fa fa-facebook"></i></a></li>';
                        }
                        $link2 = get_theme_mod('Twitter link');
                        if (strlen($link2) > 0) {
                            echo '<li><a class="social-twitter" href=' . $link2 . '><i class="fa fa-twitter"></i></a></li>';
                        }
                        $link3 = get_theme_mod('GooglePlusLink');
                        if (strlen($link3) > 0) {
                            echo '<li><a class="social-google-plus" href=' . $link3 . '><i class="fa fa-google-plus"></i></a></li>';
                        }
                        $link4 = get_theme_mod('Instagram Link');
                        if (strlen($link4) > 0) {
                            echo '<li><a class="social-instagram" href=' . $link4 . '><i class="fa fa-instagram"></i></a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-widget">
                    <h3 class="footer-title">Categories</h3>
                    <div class="category-widget">
                        <ul>
                            <?php
                            $categories = get_categories();
                            foreach ($categories as $category) {
                                echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '<span>' . '</span></a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-widget">
                    <div class="tags-widget">
                        <ul>
                            <?php
                            dynamic_sidebar('test-1');
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-widget">
                    <h3 class="footer-title">Newsletter</h3>
                    <div class="newsletter-widget">
                        <p>Nec feugiat nisl pretium fusce id velit ut tortor pretium.</p>
                        <?php echo do_shortcode('[contact-form-7 id="27" title="Контактная форма 1"]'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->

        <!-- row -->
        <div class="footer-bottom row">
            <div class="col-md-6 col-md-push-6">
                <?php
                wp_nav_menu(
                    array(
                        'menu' => 'primary',
                        'container' => '',
                        'theme_location' => 'primary',
                        'items_wrap' => '<ul id="" class="footer-nav">%3$s</ul>',
                    )
                );
                ?>
            </div>
            <div class="col-md-6 col-md-pull-6">
                <div class="footer-copyright">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                    All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                            href="https://colorlib.com" target="_blank">Colorlib</a> &amp; distributed by <a
                            href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</footer>
<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script src="<?php echo get_stylesheet_directory_uri() ?>/assets/new/js/jquery.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/assets/new/js/bootstrap.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/assets/new/js/jquery.stellar.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/assets/new/js/main.js"></script>

<?php wp_footer(); ?>
</body>

</html>

