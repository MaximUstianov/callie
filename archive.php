<?php
get_header();
?>
<!-- PAGE HEADER -->
<div class="page-header">
    <div class="page-header-bg" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>);" data-stellar-background-ratio="0.5"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10 text-center">
                <div class="author">
                    <?php
                    the_archive_title('<h1 class="page-title">', '</h1>');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /PAGE HEADER -->
<div class="section">
    <!-- container -->
    <div class="container">
        <div class="row">
            <!-- row -->
            <div class="col-md-8">
                <?php
                $cats = get_the_category();
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 5,
                    'author__in' => array(1),
                    'cat' => $cats[0]->term_id,
                );

                $loop = new WP_Query($args);

                while ($loop->have_posts()) {
                    $loop->the_post();
                    ?>
                    <div class="post post-row">
                        <a class="post-img" href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url(); ?>">
                            <?php endif; ?>
                        </a>
                        <div class="post-body">
                            <div class="post-category">
                                <?php the_category(); ?>

                            </div>
                            <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <ul class="post-meta">
                                <li>
                                    <a href="<?php the_permalink(); ?>"><?php echo get_the_author_meta('display_name', 1); ?></a>
                                </li>
                                <li><?php echo get_the_date('F j, Y'); ?></li>
                            </ul>
                            <p>        <?php the_excerpt() ?></p>
                        </div>
                    </div>


                    <!-- /post -->

                    <?php
                }
                ?>


            </div>
            <div class="col-md-4">
                <!-- ad widget-->
                <div class="aside-widget text-center">
                    <a href="#" style="display: inline-block;margin: auto;">
                        <img class="img-responsive" src="<?php the_field('banner1', 7); ?>" alt="">
                    </a>
                </div>
                <!-- /ad widget -->

                <!-- social widget -->
                <div class="aside-widget">
                    <div class="section-title">
                        <h2 class="title">Social Media</h2>
                    </div>
                    <div class="social-widget">
                        <ul>
                            <li>
                                <a target="_blink"
                                   href="https://www.facebook.com/sharer/sharer.php?u=http://cw22762-wordpress-66.tw1.ru/"
                                   class="social-facebook">
                                    <i class="fa fa-facebook"></i>
                                    <span>21.2K<br>Followers</span>
                                </a>
                            </li>
                            <li>
                                <a target="_blink"
                                   href="http://twitter.com/share?text=http://cw22762-wordpress-66.tw1.ru/&url=http://cw22762-wordpress-66.tw1.ru/"
                                   class="social-twitter">
                                    <i class="fa fa-twitter"></i>
                                    <span>10.2K<br>Followers</span>
                                </a>
                            </li>
                            <li>
                                <a target="_blink"
                                   href="https://plus.google.com/share?url=http://cw22762-wordpress-66.tw1.ru/"
                                   class="social-google-plus">
                                    <i class="fa fa-google-plus"></i>
                                    <span>5K<br>Followers</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /social widget -->

                <!-- category widget -->
                <div class="aside-widget">
                    <div class="section-title">
                        <h2 class="title">Categories</h2>
                    </div>
                    <div class="category-widget">
                        <?php


                        $categories = get_categories();

                        foreach ($categories as $category) {
                            echo '<ul><li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '<span>' . '</span></a></li></ul>';
                        }
                        ?>

                    </div>
                </div>
                <!-- /category widget -->

                <!-- newsletter widget -->
                <div class="aside-widget">
                    <div class="section-title">
                        <h2 class="title">Newsletter</h2>
                    </div>
                    <div class="newsletter-widget">
                        <p>Nec feugiat nisl pretium fusce id velit ut tortor pretium.</p>
                        <?php echo do_shortcode('[contact-form-7 id="27" title="Контактная форма 1"]'); ?>
                    </div>
                </div>
                <!-- /newsletter widget -->

                <!-- post widget -->
                <div class="aside-widget">
                    <div class="section-title">
                        <h2 class="title">Popular Posts</h2>
                    </div>
                    <?php

                    $cats = get_the_category();
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 1,
                        'cat' => $cats[0]->term_id,
                    );

                    $loop = new WP_Query($args);

                    while ($loop->have_posts()) {
                        $loop->the_post();
                        ?>


                        <!-- post -->
                        <div class="post post-widget">
                            <a class="post-img" href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url(); ?>">
                                <?php endif; ?>
                            </a>

                            <div class="post-body">
                                <div class="post-category">
                                    <?php the_category(); ?>
                                </div>
                                <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                            </div>
                        </div>


                        <?php
                    }
                    ?>


                </div>
                <!-- /post widget -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php get_footer(); ?>
