(function ($) {
    $(document).ready(function () {
        // Custom Select
        var arrowSrc = site_data.theme_url+'/images/arrow-w.svg';
        var htmlSelectElements = $('.custom_select');

        $(htmlSelectElements).each(function () {
            var select_id = $(this).attr('id');
            var select_classes = $(this).attr('class');
            var custom_arrow = $(this).data('icon');
            if( custom_arrow )
                arrowSrc = custom_arrow;
            $(this).wrap('<div data-select-id="' + select_id + '" class="custom_select_container ' + select_classes + '"></div>');
            $(this).before('<p class="selected_item"> <span></span> <img src="' + arrowSrc + '" alt=""> </p>');
            $(this).after('<ul class="dropdown"></ul>');
        });

        $('.custom_select_container').each(function () {
            var selectedOption = {
                'value': ( $(this).find('select option:disabled').val() ) ? $(this).find('select option:disabled').val() : $(this).find('select option:selected').val() ,
                'text': ( $(this).find('select option:disabled').text() ) ? $(this).find('select option:disabled').text() : $(this).find('select option:selected').text()
            };

            $(this).find('span').text(selectedOption['text']);

            var allSelectOptions = [];
            $(this).find('select > option').each(function () {
                if($(this).is(':enabled')){
                    var selectOption = {'value': $(this).val(), 'text': $(this).text()};
                    allSelectOptions.push(selectOption);
                }
            });

            var dropdown = $(this).find('.dropdown');

            for (let i = 0; i < allSelectOptions.length; i++) {
                dropdown.append('<li class="dropdown_item" data-value="' + allSelectOptions[i]['value'] + '"> <span>' + allSelectOptions[i]['text'] + '</span> </li>');
            }
        });

        //Dropdown slide functionality
        $('.selected_item').on('click', function () {
            if (!$(this).parent().hasClass('active')) {
                $('.dropdown').slideUp();
                $('.custom_select_container').removeClass('active');

                $(this).parent().find('.dropdown').slideDown();
                $('.custom_select_container').css('zIndex', '1');
                $(this).parent().addClass('active').css('zIndex', '2');
            } else {
                $(this).parent().find('.dropdown').slideUp();
                $(this).parent().removeClass('active');
            }
        });

        //Dropdown item click functionality
        $('.dropdown_item').on('click', function () {
            var newItem = {'value': $(this).data('value'), 'text': $(this).text()};

            $(this).parent().parent().find('.selected_item span').text(newItem['text']);
            $(this).parent().slideUp();
            $(this).parent().parent().removeClass('active');
            $(this).parent().parent().find('selected_item').val(newItem['value']);

            var selectElement = '#' + $(this).parent().parent().data('select-id');
            $(selectElement).val(newItem['value']);
            $(selectElement).change();
        });
    });

}(jQuery));