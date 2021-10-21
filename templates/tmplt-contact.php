<?php
/* Template Name: Contact */
get_header(); ?>
    <div class="template_contact_container">
        
        <div class="hero_section">
            <div class="hero_section_content">
                <div class="left">
                    <div class="left_content">
                        <?php if( get_field('title') ): ?>
                            <div class="form_holder">
                                <h2><?php the_field('title') ?></h2>
                            </div>
                        <?php endif; ?>

                        <?php if( get_field('description') ): ?>
                            <div class="section_description">
                                <?php the_field('description') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="right">
                    <div class="right_content">
                        <?php if( get_field('form_shortcode') ): ?>
                            <div class="form_holder">
                                <?php echo do_shortcode(get_field('form_shortcode')); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $card_1 = get_field('card_1');
        $card_2 = get_field('card_2');
        ?>
        <div class="map_section">
            <div id="map"></div>

            <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
            <script
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMBUiCaQ45x8dPP_v-qKicBffXoppRiy0&callback=initMap&libraries=&v=weekly&channel=2"
                    async
            ></script>
            <script>
                const myLatLng = { lat: 38.997796335556636, lng:-77.18565784069271 };

                function initMap() {
                    // Create the map.
                    const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: ( window.innerWidth > 760) ? 10 : 9,
                        center: myLatLng,
                        // mapTypeId: "terrain",
                        styles: [
                            {
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#f5f5f5"
                                    }
                                ]
                            },
                            {
                                "elementType": "labels.icon",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#616161"
                                    }
                                ]
                            },
                            {
                                "elementType": "labels.text.stroke",
                                "stylers": [
                                    {
                                        "color": "#f5f5f5"
                                    }
                                ]
                            },
                            {
                                "featureType": "administrative.land_parcel",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#bdbdbd"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#eeeeee"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#757575"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi.park",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#e5e5e5"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi.park",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#9e9e9e"
                                    }
                                ]
                            },
                            {
                                "featureType": "road",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#ffffff"
                                    }
                                ]
                            },
                            {
                                "featureType": "road.arterial",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#757575"
                                    }
                                ]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#dadada"
                                    }
                                ]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#616161"
                                    }
                                ]
                            },
                            {
                                "featureType": "road.local",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#9e9e9e"
                                    }
                                ]
                            },
                            {
                                "featureType": "transit.line",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#e5e5e5"
                                    }
                                ]
                            },
                            {
                                "featureType": "transit.station",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#eeeeee"
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#c9c9c9"
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "color": "#9e9e9e"
                                    }
                                ]
                            }
                        ],
                        // zoomControl: true,
                        mapTypeControl: false,
                        // scaleControl: boolean,
                        // streetViewControl: boolean,
                        // rotateControl: boolean,
                        fullscreenControl: false
                    });

                    new google.maps.Marker({
                        position: {lat:39.17175639637745, lng:-77.15862507170496},
                        map,
                        title: "Hello World!",
                    });

                    // Construct the circle for each value in citymap.
                    // Note: We scale the area of the circle based on the population.
                        // Add the circle for this city to the map.
                    const cityCircle = new google.maps.Circle({
                        // strokeColor: "#FF0000",
                        // strokeOpacity: 0.8,
                        strokeWeight: 0,
                        fillColor: "#cfdbee",
                        fillOpacity: 0.5,
                        map,
                        center: myLatLng,
                        radius: Math.sqrt(2714856) * 24,
                    });
                }
            </script>

            <div class="locations_holder">
                <div class="left">
                    <div class="locations">
                        <h2 class="title"><?php echo $card_1['title']; ?></h2>
                        <p><?php echo $card_1['description'] ?></p>
                        <?php
                        $link = $card_1['link'];
                        if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="right">
                    <div class="locations">
                        <h2 class="title"><?php echo $card_2['title']; ?></h2>
                        <p><?php echo $card_2['description'] ?></p>

                        <?php
                        $link = $card_2['link'];
                        if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="instagram_section">
            <div class="instagram">
                <div class="title_holder">
                    <div class="group">
                        <?php if( get_field('insta_title') ): ?>
                            <h2 class="section_title"><?php the_field('insta_title') ?></h2>
                        <?php endif; ?>

                        <div id="instagram_arrows_holder">
                        </div>
                    </div>

                    <?php
                    $link = get_field('insta_link');
                    if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="instagram_link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                            <?php echo esc_html( $link_title ); ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/icons/arrow-blue.svg" alt="">
                        </a>
                    <?php endif; ?>
                </div>
                <div class="instagram_feed_holder">
                    <?php echo do_shortcode('[instagram-feed]'); ?>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer(); ?>