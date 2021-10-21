<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <link rel="stylesheet" href="https://use.typekit.net/wxr2pch.css">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?php
    $is_dark = is_page_template(array('templates/tmplt-services.php','templates/tmplt-about.php'));
    $dark_logo = get_field('logo_2','option');
    $light_logo = get_field('logo','option');
    ?>
    <div id="page" class="site">
        <header class="site_header <?php echo ( $is_dark ) ? ' dark' : ' light'; ?>">
            <div class="header_content">
                <div class="left">
                    <div class="logo_holder">
                        <?php if( !$is_dark && $light_logo ): ?>
                            <a class="logo" href="<?php echo get_site_url(); ?>">
                                <img src="<?php echo $light_logo['url']; ?>" alt="<?php echo $light_logo['alt']; ?>">
                            </a>
                        <?php elseif( $is_dark && $dark_logo ): ?>
                            <a class="logo" href="<?php echo get_site_url(); ?>">
                                <img class="dark" src="<?php echo $dark_logo['url']; ?>" alt="<?php echo $dark_logo['alt']; ?>">
                                <img class="light" src="<?php echo $light_logo['url']; ?>" alt="<?php echo $light_logo['alt']; ?>">
                            </a>
                        <?php endif; ?>
                    </div>

                    <?php if( has_nav_menu('menu-1') ): ?>
                        <nav>
                            <?php wp_nav_menu(
                                array(
                                    'theme_location' => 'menu-1',
                                    'container' => false,
                                )
                            ); ?>
                        </nav>
                    <?php endif; ?>
                </div>

                <?php
                $phone = get_field('phone', 'option');
                $link = get_field('cta', 'option');
                ?>
                <div class="right">
                    <div class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <?php if( $phone ): ?>
                        <div class="phone">
                            <p>Call-us:</p>
                            <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
                        </div>
                    <?php endif; ?>

                    <?php
                    if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>

                        <div class="cta">
                            <a class="button light small" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                <?php echo esc_html( $link_title ); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </header>

        <?php if( has_nav_menu('menu-1') ): ?>
            <div class="mobile_site_nav">
                <div class="mobile_nav_content">
                    <nav>
                        <?php wp_nav_menu(
                            array(
                                'theme_location' => 'menu-1',
                                'container' => false,
                            )
                        ); ?>

                        <?php if( $phone ): ?>
                            <div class="phone">
                                <p>Call-us:</p>
                                <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
                            </div>
                        <?php endif; ?>

                        <?php
                        if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>

                            <div class="cta">
                                <a class="button light" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                    <?php echo esc_html( $link_title ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
        <?php endif; ?>