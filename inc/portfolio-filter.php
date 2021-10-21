<?php

function print_portfolio($cat='') {
    $args = array(
        'post_type' => 'projects',
        'posts_per_page' => -1,
        'post_status' => array( 'publish' ),
        'tax_query' => array()
    );

    if( $cat == 'all' )
        $cat = '';

    if( $cat ):
        array_push($args['tax_query'], array(
            'taxonomy' => 'project-category',
            'field' => 'slug',
            'terms' => array($cat)
        ));
    endif;

    $query = new WP_Query($args);

    if( $query->have_posts() ): ?>
        <div class="portfolio_gallery_pop_up">
            <div class="closing_area"></div>
            <div class="portfolio_gallery_pop_up_content">
                <div class="gallery_holder">
                    <div class="portfolio_gallery_btn_prev prev">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icons/arrow-white-2.svg" alt="">
                    </div>
                    <div class="portfolio_gallery_btn_next">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icons/arrow-white-2.svg" alt="">
                    </div>

                    <div class="swiper-container portfolio_gallery_container">
                        <div class="swiper-wrapper">
                            <?php while( $query->have_posts() ): $query->the_post(); $gallery = get_field('gallery'); ?>
                                <?php
                                if( $gallery ):
                                    foreach ( $gallery as $item ): ?>
                                        <div class="swiper-slide">
                                            <div class="image_holder">
                                                <img src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['image']['alt']; ?>">
                                            </div>
                                        </div>
                                    <?php endforeach;
                                endif; ?>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="portfolio_images_slider_holder">
            <div class="swiper-container portfolio_images_slider">
                <div class="swiper-wrapper">
                    <?php
                    $counter = 0;
                    while( $query->have_posts() ): $query->the_post();
                        $project_category = get_the_terms( get_the_ID(), 'project-category');
                        $gallery = get_field('gallery');
                        if( $gallery ):
                            foreach ( $gallery as $item ): ?>
                                <div class="swiper-slide" data-src="<?php echo $item['image']['url'] ?>" data-slide-index="<?php echo $counter; ?>">
                                    <div class="swiper-lazy-preloader"></div>
                                    <div class="image_holder">
                                        <?php if( $project_category ): ?>
                                            <div class="category"><?php echo $project_category[0]->name; ?></div>
                                        <?php endif; ?>
                                        <div class="overlay"></div>
                                        <img class="lazy_img" alt="<?php echo $item['image']['alt']; ?>">
                                    </div>
                                </div>
                                <?php $counter++; endforeach;
                        endif; ?>
                    <?php
                    endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>

        <div class="portfolio_gallery_controls">
            <div class="left">
                <div class="portfolio_images_slider_pagination slider_pagination"></div>
            </div>
            <div class="right">
                <div class="portfolio_images_slider_btn_prev slider_button prev">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icons/swiper-btn.svg" alt="">
                </div>
                <div class="portfolio_images_slider_btn_next slider_button">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icons/swiper-btn.svg" alt="">
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="no_results">
            <h2>No results.</h2>
        </div>
    <?php endif;
}

function portfolio_filter() { ?>
    <?php
    $filtered_cat = $_POST['category'];
    print_portfolio($filtered_cat);

    die;
}

add_action('wp_ajax_portfoliofilter', 'portfolio_filter'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_portfoliofilter', 'portfolio_filter');