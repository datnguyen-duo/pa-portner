<?php
/* Template Name: Portfolio */
get_header();
$filtered_cat = ( isset($_GET["category"]) ) ? $_GET["category"] : "all";
$show_popup = ( isset($_GET["overview"]) ) ? $_GET["overview"] : "";

$projects_categories = get_terms( 'project-category', array(
    'hide_empty' => false,
) );

$projects_args = array(
    'post_type' => 'projects',
    'post_status' => array( 'publish' ),
    'posts_per_page' => -1,
);

$projects = new WP_Query( $projects_args );
?>
    <div class="template_portfolio_container <?php echo ( $show_popup ) ? ' show_popup' : null; ?> <?php echo ( $filtered_cat ) ? ' category_is_filtered' : null; ?>">
        <div class="hero_section">
            <div class="spinner">
                <div class="swiper-lazy-preloader"></div>
            </div>
            <div class="titles_holder">
                <?php if( get_field('title') ): ?>
                    <h1 class="section_title"><?php the_field('title'); ?></h1>
                <?php endif; ?>

                <?php
                $total_images = 0;
                while( $projects->have_posts() ): $projects->the_post();
                    if( get_field('gallery') ) {
                        $total_images += sizeof(get_field('gallery'));
                    }
                endwhile; wp_reset_postdata();

                if( $total_images ): ?>
                    <h2 class="section_subtitle"><?php echo $total_images ?> PORTFOLIO IMAGES</h2>
                <?php endif; ?>
            </div>

            <div id="response_featured_project">
                <?php print_featured_project($filtered_cat); ?>
            </div>

            <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" id="categories_form" method="POST" class="categories <?php echo ( $filtered_cat ) ? ' white_color' : null; ?>">
                <div class="categories_holder">
                    <label class="category">
                        <input type="radio" name="category" value="all" <?php echo ( $filtered_cat == 'all' ) ? 'checked="checked"' : null; ?>>
                        <span>All</span>
                    </label>

                    <?php foreach ( $projects_categories as $cat ): ?>
                        <label class="category">
                            <input type="radio" name="category" value="<?php echo $cat->slug; ?>" <?php echo ( $filtered_cat == $cat->slug ) ? 'checked="checked"' : null; ?>>
                            <span><?php echo $cat->name; ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </form>
        </div>

        <div class="posts_holder" id="projects">
            <div id="response_portfolio">
                <?php print_portfolio($filtered_cat); ?>
            </div>
        </div>
    </div>
<?php
get_footer(); ?>