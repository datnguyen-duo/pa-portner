<?php
/* Template Name: Home */

$projects_page = get_field('projects_page', 'option');
$projects_page_url = ( $projects_page ) ? get_the_permalink($projects_page->ID) : "";
get_header(); ?>
    <div class="template_home_container">
        <?php
        $projects_categories = get_terms( 'project-category', array(
            'hide_empty' => false,
        ) );

        $hero_section = get_field('hero');
        $hero_slider = get_field('hero_images');
        ?>
        <div class="hero_slider_section">
            <div class="swiper-container hero_slider">
                <?php if( $hero_slider ): ?>
                    <div class="swiper-wrapper">
                        <?php foreach( $hero_slider as $slide ):
                            $img = $slide['hero_images_image'];
                            if( $img ): ?>
                                <div class="swiper-slide">
                                    <div class="image_holder"><img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>"></div>

                                    <a href="<?php echo $projects_page_url ?>" class="link">
                                        Learn More
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/icons/arrow-white.svg" alt="">
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if( $hero_section['small_title'] || $hero_section['title'] || $hero_section['button'] ): ?>
                    <div class="section_content">
                        <?php if( $hero_section['small_title'] ): ?>
                            <div class="small_title"><?php echo $hero_section['small_title']; ?></div>
                        <?php endif; ?>

                        <?php if( $hero_section['title'] ): ?>
                            <div class="title"><?php echo $hero_section['title']; ?></div>
                        <?php endif; ?>

                        <?php
                        $link = $hero_section['button'];
                        if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                <?php echo esc_html( $link_title ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="pagination_holder">
                    <div class="hero_slider_pagination"></div>
                </div>
            </div>
        </div>

        <?php
        $intro = get_field('intro');
        if( $intro['title'] || $intro['small_title'] ): ?>
            <div class="title_section">
                <h3 class="small_title"><?php echo $intro['small_title']; ?></h3>
                <h2 class="section_title"><?php echo $intro['title']; ?></h2>
            </div>
        <?php endif; ?>

        <?php if( $projects_categories ): ?>
            <div class="cards_section">
                <?php if( get_field('categories_title') ): ?>
                    <h2 class="section_title"><?php the_field('categories_title'); ?></h2>
                <?php endif; ?>

                <div class="cards">
                    <?php foreach( $projects_categories as $cat ):
                        $icon = get_field('icon', $cat);
                    ?>
                        <div class="card_holder">
                            <div class="card">
                                <?php if( $projects_page_url ): ?>
                                <a href="<?php echo $projects_page_url.'?category='.$cat->slug; ?>" class="card_title">
                                <?php else: ?>
                                <div class="card_title">
                                <?php endif; ?>
                                    <div class="title">
                                        <?php if( $icon ): ?>
                                            <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
                                        <?php endif; ?>

                                        <h2><?php echo $cat->name; ?></h2>
                                    </div>

                                    <?php if( $projects_page_url ): ?>
                                        <img class="arrow" src="<?php echo get_template_directory_uri(); ?>/images/icons/arrow-black.svg" alt="">
                                    <?php endif; ?>
                                <?php if( $projects_page_url ): ?>
                                </a>
                                <?php else: ?>
                                </div>
                                <?php endif; ?>

                                <?php if( $cat->description ): ?>
                                <div class="card_desc">
                                    <p><?php echo $cat->description; ?></p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php
        $img_with_desc = get_field('img_with_desc');
        $gallery = get_field('gallery');
        $gallery_btn = get_field('gallery_button');
        $gallery_title = get_field('gallery_title');

        if( $img_with_desc['button'] || $img_with_desc['description'] || $img_with_desc['title'] || $img_with_desc['image'] || $img_with_desc['image_2'] || $gallery || $gallery_btn || $gallery_title ): ?>
            <div class="blue_section">
                <?php if( $img_with_desc['button'] || $img_with_desc['description'] || $img_with_desc['title'] || $img_with_desc['image'] || $img_with_desc['image_2'] ): ?>
                    <div class="image_with_desc_container_2">
                        <div class="image_with_desc">
                            <?php if( $img_with_desc['image_2'] ): ?>
                                <div class="small_image">
                                    <div class="small_image_holder">
                                        <img src="<?php echo $img_with_desc['image_2']['url']; ?>" alt="<?php echo $img_with_desc['image_2']['alt']; ?>">
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="left">
                                <div class="left_content">
                                    <?php if( $img_with_desc['title'] ): ?>
                                        <h2 class="section_title"><?php echo $img_with_desc['title']; ?></h2>
                                    <?php endif; ?>

                                    <?php if( $img_with_desc['description'] ): ?>
                                        <div class="section_description">
                                            <?php echo $img_with_desc['description']; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    $link = $img_with_desc['button'];
                                    if( $link ):
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                        <div class="button_holder">
                                            <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                                <?php echo esc_html( $link_title ); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="right">
                                <div class="image_container">
                                    <?php if( $img_with_desc['image'] ): ?>
                                        <div class="image_holder">
                                            <img src="<?php echo $img_with_desc['image']['url']; ?>" alt="<?php echo $img_with_desc['image']['alt']; ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if( $gallery ): ?>
                    <div class="gallery_section">
                        <div class="gallery_section_content">
                            <div class="pagination_holder">
                                <div class="gallery_slider_pagination slider_pagination"></div>
                            </div>
                            <div class="slider_holder">
                                <div class="title_holder">
                                    <div class="left">
                                        <?php if( $gallery_title ): ?>
                                            <h2 class="section_title"><?php echo $gallery_title; ?></h2>
                                        <?php endif; ?>

                                        <?php
                                        $link = $gallery_btn;
                                        if( $link ):
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                            <a class="link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                                <?php echo esc_html( $link_title ); ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/arrow-blue.svg" alt="">
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="right">

                                        <div class="buttons_group">
                                            <div class="gallery_slider_btn_prev slider_button prev">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/swiper-btn-2.svg" alt="">
                                            </div>
                                            <div class="gallery_slider_btn_next slider_button">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/swiper-btn-2.svg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gallery">
                                    <div class="swiper-container gallery_slider">
                                        <div class="swiper-wrapper">
                                            <?php foreach( $gallery as $slide ): ?>
                                                <div class="swiper-slide">
                                                    <div class="image_holder">
                                                        <img src="<?php echo $slide['image']['url']; ?>" alt="<?php echo $slide['image']['alt']; ?>">
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php
        $img_with_desc = get_field('img_with_desc_2');

        if( $img_with_desc['title'] || $img_with_desc['image'] || $img_with_desc['button'] ): ?>
            <div class="image_with_desc_container">
                <div class="image_with_desc">
                    <div class="left">
                        <div class="image_container">
                            <?php if( $img_with_desc['image'] ): ?>
                                <div class="image_holder">
                                    <img src="<?php echo $img_with_desc['image']['url']; ?>" alt="<?php echo $img_with_desc['image']['alt']; ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="right">
                        <div class="right_content">
                            <?php if( $img_with_desc['title'] ): ?>
                                <h2 class="section_title"><?php echo $img_with_desc['title']; ?></h2>
                            <?php endif; ?>

                            <?php if( $img_with_desc['description'] ): ?>
                                <div class="section_description"><?php echo $img_with_desc['description']; ?></div>
                            <?php endif; ?>

                            <?php
                            $link = $img_with_desc['button'];
                            if( $link ):
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <div class="button_holder">
                                    <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                        <?php echo esc_html( $link_title ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php
        $testimonials = get_field('testimonials');
        if( $testimonials ): ?>
        <div class="testimonials_slider_section content_container">
            <div class="testimonials_slider_section_content">
                <div class="title_holder">
                    <div class="left">
                        <?php if( get_field('testimonials_title') ): ?>
                            <h2 class="section_title"><?php the_field('testimonials_title') ?></h2>
                        <?php endif; ?>
                    </div>
                    <div class="right">
                        <div class="testimonials_slider_btn_prev slider_button prev">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/icons/swiper-btn.svg" alt="">
                        </div>
                        <div class="testimonials_slider_btn_next slider_button">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/icons/swiper-btn.svg" alt="">
                        </div>
                    </div>
                </div>

                <div class="slider_holder">
                    <div class="swiper-container testimonials_slider">
                        <div class="swiper-wrapper">
                            <?php foreach( $testimonials as $item ): ?>
                                <div class="swiper-slide">
                                    <div class="testimonial">
                                        <img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/quotes.svg" alt="">
                                        <div class="card_desc"><?php echo $item['description']; ?></div>

                                        <div class="author_info">
                                            <?php if( $item['author_name'] ): ?>
                                                <div class="author_name"><?php echo $item['author_name']; ?></div>
                                            <?php endif; ?>

                                            <?php if( $item['author_company'] ): ?>
                                                <div class="author_company"><?php echo $item['author_company']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="testimonials_slider_pagination slider_pagination"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
<?php
get_footer(); ?>