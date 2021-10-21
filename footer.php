    <?php
    $hide_jumbotron = is_page_template(array('templates/tmplt-contact.php'));
    $jumbotron = get_field('jumbotron','option');

    if( !$hide_jumbotron && !$jumbotron['title'] && !$jumbotron['description'] && !$jumbotron['button'] ):
        $hide_jumbotron = true;
    endif; ?>
    <footer class="site_footer <?php if( $hide_jumbotron ): echo ' hidden_jumbotron'; endif; ?>">
        <?php if( !$hide_jumbotron ): ?>
            <div class="jumbotron_container">
                <div class="jumbotron">
                    <div class="jumbotron_content">
                        <h2><?php echo $jumbotron['title']; ?></h2>

                        <div class="description">
                            <?php echo $jumbotron['description']; ?>
                        </div>

                        <?php
                        $link = $jumbotron['button'];
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
                </div>
            </div>
        <?php endif; ?>

        <?php
        $logo = get_field('logo','option');
        $partners = get_field('partners','option');
        ?>
        <div class="footer_content">
            <div class="left">
                <div class="logo_holder">
                    <?php if( $logo ): ?>
                        <a class="logo" href="<?php echo get_site_url(); ?>">
                            <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
                        </a>
                    <?php endif; ?>
                </div>

                <?php if( $partners ): ?>
                    <div class="other_logos_holder">
                        <?php foreach( $partners as $partner ): ?>
                            <div class="logo">
                                <img src="<?php echo $partner['logo']['url']; ?>" alt="<?php echo $partner['logo']['alt']; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="right">
                <?php
                $phone = get_field('phone', 'option');
                $address = get_field('address', 'option');

                if( $phone || $address ): ?>
                    <div class="column contact">
                        <div class="column_title">Contact Us</div>
                        <p><?php echo $address; ?></p>
                        <a href="tel:<?php echo $phone; ?>"><?php echo $phone ?></a>
                    </div>
                <?php endif; ?>

                <?php
                $licensed = get_field('licensed_in', 'option');
                if( $licensed ): ?>
                <div class="column">
                    <div class="column_title">Licensed In</div>
                    <p><?php echo $licensed; ?></p>
                </div>
                <?php endif; ?>

                <?php if( has_nav_menu('menu-2') ): ?>
                    <nav class="column">
                        <div class="column_title">Navigation</div>

                        <?php wp_nav_menu(
                            array(
                                'theme_location' => 'menu-2',
                                'container' => false,
                            )
                        ); ?>
                    </nav>
                <?php endif; ?>

                <?php if( has_nav_menu('menu-3') ): ?>
                    <nav class="column">
                        <div class="column_title">Connect</div>

                        <?php wp_nav_menu(
                            array(
                                'theme_location' => 'menu-3',
                                'container' => false,
                            )
                        ); ?>
                    </nav>
                <?php endif; ?>
            </div>
            <?php
            $copyright = get_field('copyright','option');
            if( $copyright ): ?>
                <div class="bottom">
                    <p><?php echo $copyright; ?></p>
                </div>
            <?php endif; ?>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>

</body>

</html>
