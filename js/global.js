(function ($) {
    $(document).ready(function () {
        $('.site_header .hamburger').on('click', function(){
            $('.site_header').toggleClass('mobile_nav_is_opened');
            $(this).toggleClass('open');
            $('.mobile_site_nav').fadeToggle();
            $('body').toggleClass('no_scroll');
        });

        var nav = $('.site_header');
        var win = $(window);
        var winH = win.height();   // Get the window height.

        win.on("scroll", function () {
            if ($(this).scrollTop() > winH ) {
                nav.addClass("background");
            } else {
                nav.removeClass("background");
            }
        }).on("resize", function(){ // If the user resizes the window
            winH = $(this).height(); // you'll need the new height value
        });

        //Template Contact
        if( $('.template_contact_container').length ) {
            setTimeout( function(){
                $("#sbi_images").slick({
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    appendArrows:'#instagram_arrows_holder',
                    prevArrow: '<div class="social_media_slick_slider_btn prev"><img src="'+site_data.theme_url+'/images/icons/swiper-btn-2.svg" alt=""></div>',
                    nextArrow: '<div class="social_media_slick_slider_btn next"><img src="'+site_data.theme_url+'/images/icons/swiper-btn-2.svg" alt=""></div>',
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: { slidesToShow: 1, slidesToScroll: 1, autoplay: !0 },
                        },
                    ],
                });
            },2000);
        }
        //Template Contact end

        //Template Home
        if( $('.template_home_container').length ) {
            var heroSlider = new Swiper(".hero_slider", {
                slidesPerView: 1,
                spaceBetween: 0,
                effect: "fade",
                watchOverflow: true,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                speed: 1000,
                pagination: {
                    el: ".hero_slider_pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: '.hero_slider_btn_next',
                    prevEl: '.hero_slider_btn_prev',
                },
            });
        }
        //Template Home end


        //Template portfolio
        if( $('.template_portfolio_container').length ) {

            $(document).on('keyup', function(e) {
                $('body').removeClass('no_scroll');

                if (e.key == "Escape") {
                    $('.featured_project_popup').fadeOut();

                    $('.portfolio_gallery_pop_up').fadeOut();
                }
            });

            portfolioImagesSliderArgs = {
                slidesPerView: 2,
                preloadImages: false,
                watchSlidesVisibility: true,
                slidesPerColumn: 4,
                slidesPerColumnFill: 'row',
                spaceBetween: 20,
                watchOverflow: true,
                observer: true,
                pagination: {
                    el: ".portfolio_images_slider_pagination",
                    clickable: true,
                    renderBullet: function (index, className) {
                        return '<span class="'+className+'"><p>'+(index+1)+'</p></span>';
                    },
                },
                navigation: {
                    nextEl: '.portfolio_images_slider_btn_next',
                    prevEl: '.portfolio_images_slider_btn_prev',
                },

                breakpoints: {
                    550: {
                        spaceBetween: 20,
                        slidesPerView: 3,
                        slidesPerColumn: 6,
                    },

                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 45,
                        slidesPerColumn: 6,
                    },
                    1400: {
                        slidesPerView: 3,
                        spaceBetween: 90,
                        slidesPerColumn: 6,
                    }
                },

                on: {
                    init: function(){
                        $('.swiper-slide-visible').each(function(){
                            $(this).find('.lazy_img').attr('src',$(this).data('src'));
                            $(this).find('.swiper-lazy-preloader').fadeOut();
                        });
                    },
                    slideChangeTransitionEnd: function () {
                        $('.swiper-slide-visible').each(function(){
                            $(this).find('.lazy_img').attr('src',$(this).data('src'));
                            $(this).find('.swiper-lazy-preloader').fadeOut();
                        });
                    },
                },
            };

            var portfolioImagesSlider = new Swiper(".portfolio_images_slider", portfolioImagesSliderArgs);

            function portfolioGallery() {
                $('.portfolio_images_slider .swiper-slide').on('click', function(){
                    $('.portfolio_gallery_pop_up').fadeIn();

                    var portfolioGallery = new Swiper(".portfolio_gallery_container", {
                        slidesPerView: 1,
                        spaceBetween: 30,
                        watchOverflow: true,
                        initialSlide: $(this).data('slide-index'),
                        navigation: {
                            nextEl: '.portfolio_gallery_btn_next',
                            prevEl: '.portfolio_gallery_btn_prev',
                        },
                    });
                });

                $('.portfolio_gallery_pop_up .closing_area').on('click', function(){
                    $('.portfolio_gallery_pop_up').fadeOut();
                });
            }

            portfolioGallery();

            function featuredProjectFunctionality() {
                $('.close_popup').on('click', function(){
                    $('body').removeClass('no_scroll');
                    $('.featured_project_popup').fadeOut();
                });

                $('.featured_project_popup_opener').on('click', function(){
                    $('.featured_project_popup').fadeIn();
                    $('body').addClass('no_scroll');

                    var featuredProjectSlider = new Swiper(".featured_project_slider", {
                        slidesPerView: 1,
                        spaceBetween: 30,
                        watchOverflow: true,
                        pagination: {
                            el: ".featured_project_slider_pagination",
                            clickable: true,
                            renderBullet: function (index, className) {
                                return '<span class="'+className+'"><p>'+(index+1)+'</p></span>';
                            },
                        },
                        navigation: {
                            nextEl: '.featured_project_slider_btn_next',
                            prevEl: '.featured_project_slider_btn_prev',
                        },
                    });
                });
            }

            $( "#categories_form .category" ).change(function() {
                var form = $('#categories_form');
                var chosenCat = $('input[name="category"]:checked').val();
                var responsePortfolioDiv = document.getElementById('response_portfolio');
                var responseFeaturedProjectDiv = document.getElementById('response_featured_project');

                // var myURL = document.location;
                // var newURL = myURL + '?category='+chosenCat;
                // URLSearchParams.set(name, value)
                // // history.replaceState(null, null, newURL);
                // window.history.pushState({path: newURL}, '', myURL + newURL);

                const url = new URL(location);
                url.searchParams.set('category', chosenCat);
                history.replaceState(null, null, url);

                if( chosenCat == 'all') {
                    url.searchParams.delete('category');
                    history.replaceState(null, null, url);
                }

                //Portfolio filter ajax
                $.ajax({
                    url: form.attr('action'),
                    data: {
                        action: 'portfoliofilter',
                        category: chosenCat
                    },
                    // data: form.serialize(), // form data
                    type: form.attr('method'), // POST
                    beforeSend: function (xhr) {
                        responsePortfolioDiv.style.opacity = '0';
                    },
                    success: function (data) {
                        responsePortfolioDiv.innerHTML = data;
                        var portfolioImagesSlider = new Swiper(".portfolio_images_slider", portfolioImagesSliderArgs);
                        portfolioGallery();
                        responsePortfolioDiv.style.opacity = '1';
                    },
                    // complete: function (xhr, status) {}
                });
                //Portfolio filter ajax end

                //Featured Project filter ajax
                $.ajax({
                    url: form.attr('action'),
                    data: {
                        action: 'featuredprojectfilter',
                        category: chosenCat
                    },
                    type: form.attr('method'), // POST
                    beforeSend: function (xhr) {
                        responseFeaturedProjectDiv.style.opacity = '0';
                        $('.titles_holder').addClass('hide');
                        $('.spinner').addClass('show');
                    },
                    success: function (data) {
                        responseFeaturedProjectDiv.innerHTML = data;
                        responseFeaturedProjectDiv.style.opacity = '1';
                        $('.spinner').removeClass('show');

                        if( chosenCat !== 'all' ) {
                            form.addClass('white_color');
                            $('.titles_holder').addClass('hide');
                        } else {
                            $('.titles_holder').removeClass('hide');
                            form.removeClass('white_color');
                        }
                        featuredProjectFunctionality();
                    },
                    // complete: function (xhr, status) {}
                });
                //Featured Project filter ajax end
            });

            if( $('.category_is_filtered').length || $('.show_popup').length  ) {
                featuredProjectFunctionality();
            }

            if( $('.show_popup').length ) {
                $('.featured_project_popup_opener').trigger('click');
                const url = new URL(location);
                url.searchParams.delete('overview');
                history.replaceState(null, null, url);
            }
        }

        //Template portfolio end

        //Template about
        var awardsSlider = new Swiper(".awards_slider", {
            slidesPerView: 1,
            spaceBetween: 30,
            watchOverflow: true,
            navigation: {
                nextEl: '.awards_slider_btn_next',
                prevEl: '.awards_slider_btn_prev',
            },
            breakpoints: {
                800: {
                    spaceBetween: 40,
                },

                1200: {
                    spaceBetween: 65,
                },

                1500: {
                    spaceBetween: 80,
                },

                1800: {
                    spaceBetween: 92,
                }
            }
        });
        //Template about end

        var testimonialSlider = new Swiper(".testimonials_slider", {
            slidesPerView: 1,
            spaceBetween: 20,
            watchSlidesVisibility: true,
            pagination: {
                el: ".testimonials_slider_pagination",
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="'+className+'"><p>'+(index+1)+'</p></span>';
                },
            },
            navigation: {
                nextEl: '.testimonials_slider_btn_next',
                prevEl: '.testimonials_slider_btn_prev',
            },
            // breakpoints: {
            //     600: {
            //         slidesPerView: 2,
            //     },
            //
            //     800: {
            //         spaceBetween: 35,
            //     },
            //
            //     1100: {
            //         slidesPerView: 3,
            //     },
            //
            //     1500: {
            //         slidesPerView: 3,
            //         spaceBetween: 65,
            //     },
            //
            //     1650: {
            //         slidesPerView: 3,
            //         spaceBetween: 82,
            //     }
            // }
        });

        var gallerySlider = new Swiper(".gallery_slider", {
            slidesPerView: 1,
            spaceBetween: 97,
            pagination: {
                el: ".gallery_slider_pagination",
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="'+className+'"><p>'+(index+1)+'</p></span>';
                },
            },
            navigation: {
                nextEl: '.gallery_slider_btn_next',
                prevEl: '.gallery_slider_btn_prev',
            },
        });

    });

    $(window).on('scroll', function () {
        // animateInViewEl();
    });

    $(window).on('resize', function () {
        // animateInViewEl();
    });

    // function animateInViewEl() {
    //     var winHeight = $(window).height();
    //     var bodyScroll = $(document).scrollTop();
    //     var calcHeight = bodyScroll + winHeight - 0;
    //
    //     $('.animate_el').each(function (index, el) {
    //         if ($(this).offset().top < calcHeight && $(this).offset().top + $(this).height() > bodyScroll) {
    //             if (!$(this).hasClass('in_view')) {
    //                 $(this).addClass('in_view');
    //             }
    //         }
    //     });
    // }
}(jQuery));