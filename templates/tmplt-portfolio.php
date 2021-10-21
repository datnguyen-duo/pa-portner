<?php
/* Template Name: Portfolio */
get_header();
$filtered_cat = ( isset($_GET["category"]) ) ? $_GET["category"] : "all";
$show_popup = ( isset($_GET["overview"]) ) ? $_GET["overview"] : "";
$current_page = (isset($_GET["page_"])) ? $_GET["page_"] : 1;

$projects_categories = get_terms( 'project-category', array(
    'hide_empty' => false,
) );

$posts_per_page = 6;

$projects_args = array(
    'post_type' => 'projects',
    'posts_per_page' => $posts_per_page,
    'post_status' => array( 'publish' ),
    'paged' => $current_page,
    'tax_query' => array()
);

if( $filtered_cat != 'all'):
    array_push($projects_args['tax_query'], array(
        'taxonomy' => 'project-category',
        'field' => 'slug',
        'terms' => array($filtered_cat)
    ));
endif;
$featured_project_img = '';

$projects = new WP_Query( $projects_args );
$total_pages = ceil($projects->found_posts / $posts_per_page);

?>
    <div class="template_portfolio_container <?php echo ( $show_popup ) ? ' show_popup' : null; ?>">
        <div class="hero_section">
            <div class="titles_holder">
                <?php if( get_field('title') ): ?>
                    <h1 class="section_title"><?php the_field('title'); ?></h1>
                <?php endif; ?>

                <?php if( get_field('small_title') ): ?>
                    <h2 class="section_subtitle"><?php the_field('small_title'); ?></h2>
                <?php endif; ?>
            </div>

            <?php
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

            <form action="" id="categories_form" class="categories <?php echo ( $featured_project_img ) ? ' white_color' : null; ?>">
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

                <?php if( $total_pages > 1 ): ?>
                    <input type="hidden" id="posts_page" name="page_" value="1">
                <?php endif; ?>
            </form>
        </div>

        <div class="posts_holder" id="projects">
            <?php if( $projects->have_posts() ): ?>

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
                                    <?php while( $projects->have_posts() ): $projects->the_post(); ?>
                                        <div class="swiper-slide">
                                            <div class="image_holder">
                                                <?php the_post_thumbnail(); ?>
                                            </div>
                                        </div>
                                    <?php endwhile; wp_reset_postdata(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="posts">
                    <?php
                    $counter = 0;
                    while( $projects->have_posts() ): $projects->the_post();
                        $project_category = get_the_terms( get_the_ID(), 'project-category');
                    ?>
                        <div class="post_holder">
                            <div class="post" data-slide-index="<?php echo $counter; ?>">
                                <?php if( $project_category ): ?>
                                    <div class="category"><?php echo $project_category[0]->name; ?></div>
                                <?php endif; ?>

                                <?php if( get_the_post_thumbnail() ): ?>
                                    <div class="overlay"></div>
                                    <?php the_post_thumbnail(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php $counter++;
                    endwhile; wp_reset_postdata(); ?>
                </div>
            <?php else: ?>
                <div class="no_results">
                    <h2>No results.</h2>
                </div>
            <?php endif; ?>



            <?php if( $total_pages > 1 ): ?>
                <div class="page_controls">
                    <ul class="page_pagination">
                        <?php for( $i=1; $i<=$total_pages; $i++ ): ?>
                            <li data-page="<?php echo $i; ?>" class="<?php echo ($current_page == $i) ? 'active' : null; ?>">
                                <p><?php echo $i; ?></p>
                            </li>
                        <?php endfor; ?>
                    </ul>

                    <ul class="page_pagination">
                        <li class="prev_next prev" data-page="<?php echo ($current_page == 1) ? $total_pages : $current_page-1; ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/icons/arrow-blue.svg" alt="">
                        </li>

                        <li class="prev_next next" data-page="<?php echo ($current_page == $total_pages) ? 1 : $current_page+1; ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/icons/arrow-blue.svg" alt="">
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php
get_footer(); ?>