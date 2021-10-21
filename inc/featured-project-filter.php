<?php

function print_featured_project($filtered_cat = '') {
    $projects_categories = get_terms( 'project-category', array(
        'hide_empty' => false,
    ) );

    foreach ( $projects_categories as $cat ):
        if( $filtered_cat == $cat->slug ):
            $featured_project = get_field('featured_project', $cat);

            if( $featured_project ):
                $gallery = get_field('gallery', $featured_project[0]->ID );
                $description = get_field('description', $featured_project[0]->ID );
                $before = get_field('before', $featured_project[0]->ID);
                $after = get_field('after', $featured_project[0]->ID);

                if( get_the_post_thumbnail($featured_project[0]->ID)  ):
                    $featured_project_img = get_the_post_thumbnail($featured_project[0]->ID);
                endif;
                ?>
                <div class="featured_project_popup">
                    <div class="popup_header">
                        <h2>Featured <?php echo $cat->name; ?> Project</h2>
                        <img class="close_popup" src="<?php echo get_template_directory_uri(); ?>/images/icons/close.svg" alt="">
                    </div>
                    <div class="featured_project_popup_content">
                        <div class="gallery">
                            <h2><?php echo $featured_project[0]->post_title; ?></h2>

                            <?php
                            if( $gallery ): ?>
                                <div class="swiper-container featured_project_slider">
                                    <div class="swiper-wrapper">
                                        <?php foreach( $gallery as $item ): ?>
                                            <div class="swiper-slide">
                                                <div class="image_holder">
                                                    <img src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['image']['alt']; ?>">
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="gallery_controls">
                                    <div class="left">
                                        <div class="featured_project_slider_pagination slider_pagination"></div>
                                    </div>
                                    <div class="right">
                                        <div class="featured_project_slider_btn_prev slider_button prev">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/icons/swiper-btn-2.svg" alt="">
                                        </div>
                                        <div class="featured_project_slider_btn_next slider_button">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/icons/swiper-btn-2.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if( $description ): ?>
                            <div class="description"><?php echo $description; ?></div>
                        <?php endif; ?>

                        <?php if( $before || $after ): ?>
                            <div class="before_after">
                                <div class="left">
                                    <?php if( $before ): ?>
                                        <h2>Before</h2>
                                        <div class="image_holder">
                                            <img src="<?php echo $before['url']; ?>" alt="<?php echo $before['alt']; ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="right">
                                    <?php if( $after ): ?>
                                        <h2>After</h2>
                                        <div class="image_holder">
                                            <img src="<?php echo $after['url']; ?>" alt="<?php echo $after['alt']; ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="featured_project">
                <?php if( $featured_project ):
                    if( $featured_project_img ): ?>
                        <div class="overlay"></div>
                        <div class="featured_img">
                            <?php echo $featured_project_img; ?>
                        </div>
                    <?php endif;
                endif; ?>

                <div class="featured_project_content">
                    <h2 class="project_title"><?php echo $cat->name; ?></h2>

                    <?php if( $cat->description ): ?>
                        <p class="cat_desc"><?php echo $cat->description; ?></p>
                    <?php endif; ?>

                    <?php if( $featured_project ): ?>
                        <p class="featured_project_popup_opener">
                            View Featured Project
                            <img src="<?php echo get_template_directory_uri(); ?>/images/icons/arrow-white.svg" alt="">
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        <?php
        endif;
    endforeach; ?>
<?php }

function featured_project_filter() {
    $filtered_cat = $_POST['category'];
    print_featured_project($filtered_cat);
    die;
}

add_action('wp_ajax_featuredprojectfilter', 'featured_project_filter'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_featuredprojectfilter', 'featured_project_filter');