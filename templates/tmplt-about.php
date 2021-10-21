<?php
/* Template Name: About */
get_header(); ?>
    <div class="template_about_container">
        <div class="hero_section">
            <?php
            $hero = get_field('hero');
            if( $hero['title'] || $hero['small_title'] ): ?>
                <div class="top">
                    <h3 class="section_subtitle"><?php echo $hero['small_title']; ?></h3>
                    <h2 class="section_title"><?php echo $hero['title']; ?></h2>
                </div>
            <?php endif; ?>

            <?php
            $img_with_desc = get_field('image_with_description');

            if( $img_with_desc['small_title'] || $img_with_desc['small_title'] || $img_with_desc['small_title'] ): ?>
            <div class="bottom  <?php echo ( !$img_with_desc['image'] ) ? ' without_image' : null; ?>">
                <div class="bottom_content">
                    <?php if( $img_with_desc['image'] ): ?>
                        <div class="image_holder">
                            <img src="<?php echo $img_with_desc['image']['url']; ?>" alt="<?php echo $img_with_desc['image']['alt']; ?>">
                        </div>
                    <?php endif; ?>

                    <div class="info">
                        <?php if( $img_with_desc['title'] ): ?>
                            <h2 class="section_title"><?php echo $img_with_desc['title']; ?></h2>
                        <?php endif; ?>

                        <?php if( $img_with_desc['small_title'] ): ?>
                            <h3 class="section_subtitle"><?php echo $img_with_desc['small_title']; ?></h3>
                        <?php endif; ?>

                        <?php if( $img_with_desc['description'] ): ?>
                            <div class="section_description"><?php echo $img_with_desc['description']; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <?php
        $members = get_field('members');
        $members_title = get_field('members_title');
        $members_desc = get_field('members_description');
        
        if( $members || $members_title || $members_desc ): ?>
            <div class="posts_holder">
                <?php if( $members_title ): ?>
                    <h2 class="section_title"><?php echo $members_title; ?></h2>
                <?php endif; ?>

                <?php if( $members_desc ): ?>
                    <div class="section_description">
                        <?php echo $members_desc; ?>
                    </div>
                <?php endif; ?>
                <div class="posts">
                    <?php foreach( $members as $member ): ?>
                        <div class="post_holder">
                            <div class="post">

                                <?php if( $member['image'] ): ?>
                                    <div class="post_image">
                                        <img src="<?php echo $member['image']['url']; ?>" alt="<?php echo $member['image']['alt']; ?>">
                                    </div>
                                <?php endif; ?>

                                <?php if( $member['name'] || $member['title'] ): ?>
                                    <div class="post_description">
                                        <?php if( $member['name'] ): ?>
                                            <h3><?php echo $member['name']; ?></h3>
                                        <?php endif; ?>

                                        <?php if( $member['title'] ): ?>
                                            <p><?php echo $member['title']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php
        $jumbotron = get_field('jumbotron');
        ?>
        <div class="jumbotron_section">
            <div class="jumbotron_section_content">
                <div class="left">
                    <div class="box">
                        <div class="box_content">
                            <?php if( $jumbotron['block_icon'] ): ?>
                                <img src="<?php echo $jumbotron['block_icon']['url']; ?>" alt="<?php echo $jumbotron['block_icon']['alt']; ?>">
                            <?php endif; ?>

                            <?php if( $jumbotron['block_small_title_1'] ): ?>
                                <div class="small_title"><?php echo $jumbotron['block_small_title_1']; ?></div>
                            <?php endif; ?>

                            <?php if( $jumbotron['block_title'] ): ?>
                                <div class="title"><?php echo $jumbotron['block_title']; ?></div>
                            <?php endif; ?>

                            <?php if( $jumbotron['block_small_title_2'] ): ?>
                                <div class="small_title"><?php echo $jumbotron['block_small_title_2']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <?php if( $jumbotron['title'] ): ?>
                        <h2 class="section_title"><?php echo $jumbotron['title']; ?></h2>
                    <?php endif; ?>

                    <?php if( $jumbotron['description'] ): ?>
                        <div class="section_description">
                            <?php echo $jumbotron['description']; ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    $link = $jumbotron['link'];
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
            </div>
        </div>

        <?php
        $awards = get_field('awards');
        $awards_title = get_field('awards_title');

        if( $awards ): ?>
            <div class="gallery_section">
                <div class="gallery_section_content">
                    <div class="left">
                        <?php if( $awards_title ): ?>
                            <h2 class="section_title"><?php echo $awards_title; ?></h2>
                        <?php endif; ?>

                        <div class="slider_controls">
                            <div class="awards_slider_btn_prev slider_button prev">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/swiper-btn.svg" alt="">
                            </div>
                            <div class="awards_slider_btn_next slider_button">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/swiper-btn.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="swiper-container awards_slider">
                            <div class="swiper-wrapper">
                                <?php foreach( $awards as $slide ): ?>
                                    <div class="swiper-slide">
                                        <div class="image_holder">
                                            <?php if( $slide['image'] ): ?>
                                                <img src="<?php echo $slide['image']['url']; ?>" alt="<?php echo $slide['image']['alt']; ?>">
                                            <?php endif; ?>
                                        </div>

                                        <div class="slide_info">
                                            <?php if( $slide['title'] ): ?>
                                                <h3><?php echo $slide['title']; ?></h3>
                                            <?php endif; ?>

                                            <?php if( $slide['subtitle'] ): ?>
                                                <p><?php echo $slide['subtitle']; ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php
get_footer(); ?>