<?php
/* Template Name: Services */
get_header(); ?>
    <div class="template_services_container">
        <?php
        $hero = get_field('hero');
        ?>
        <div class="hero_section">
            <div class="image_with_desc">
                <div class="left">
                    <div class="right_content">
                        <?php if( $hero['title'] ): ?>
                            <h2 class="section_title"><?php echo $hero['title']; ?></h2>
                        <?php endif; ?>

                        <?php if( $hero['description'] ): ?>
                            <div class="section_description"><?php echo $hero['description']; ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="right">
                    <?php if( $hero['video'] ): ?>
                        <div class="image_container">
                            <div class="image_holder">
                                <video autoplay playsinline muted loop src="<?php echo $hero['video']['url']; ?>" alt="<?php echo $hero['video']['alt']; ?>">
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php
        $blocks = get_field('blocks');
        if( $blocks ): ?>
            <div class="blocks_section">
                <?php foreach ( $blocks as $block ):
                    if( $block['block_color'] == 'dark_blue' ):
                        $icon = 'checkmark.svg';
                    elseif( $block['block_color'] == 'light_blue' ):
                        $icon = 'checkmark-3.svg';
                    elseif( $block['block_color'] == 'green' ):
                        $icon = 'checkmark-4.svg';
                    else:
                        $icon = 'checkmark-2.svg';
                    endif;
                    ?>
                    <div class="block_section <?php echo ' '.$block['block_color']; ?>">
                        <div class="block_section_content">
                            <div class="top">
                                <?php if( $block['icon'] || $block['title'] ): ?>
                                    <div class="title_holder">
                                        <?php if( $block['icon'] ): ?>
                                            <img src="<?php echo $block['icon']['url']; ?>" alt="<?php echo $block['icon']['alt']; ?>">
                                        <?php endif; ?>

                                        <h2><?php echo $block['title']; ?></h2>
                                    </div>
                                <?php endif; ?>

                                <?php if( $block['small_title'] ): ?>
                                    <h3 class="subtitle"><?php echo $block['small_title']; ?></h3>
                                <?php endif; ?>

                                <?php if( $block['description'] ): ?>
                                    <div class="description"><?php echo $block['description']; ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="bottom">
                                <div class="left">
                                    <?php if( $block['image'] ): ?>
                                        <div class="image_container">
                                            <div class="image_holder">
                                                <img src="<?php echo $block['image']['url']; ?>" alt="<?php echo $block['image']['alt']; ?>">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    $link = $block['button'];
                                    if( $link ):
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                        <a class="button_link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                            <span>
                                                <?php echo esc_html( $link_title ); ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/arrow-white.svg" alt="">
                                            </span>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="right">
                                    <div class="right_content">
                                        <?php if( $block['description_2'] ): ?>
                                            <h2 class="list_title"><?php echo $block['description_2'] ?></h2>
                                        <?php endif; ?>

                                        <?php if( $block['list'] ): ?>
                                            <ul class="list">
                                                <?php foreach ( $block['list'] as $item ): ?>
                                                    <li>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/icons/<?php echo $icon; ?>" alt="">
                                                        <?php echo $item['item']; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
<?php
get_footer(); ?>