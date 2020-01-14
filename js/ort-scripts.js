jQuery(document).ready(function ($) {

    /**** Activate object-fit polyfill for IE ****/
    /* We need to set time out since the slider is loaded after this lines.
       After the silder is loaded bind the fix to other images in the slider which are revealed when sliding
    * */
    setTimeout(function(){
        objectFitImages();
        $(".slick-arrow").on("click", function () {
            objectFitImages();
        });
    }, 50);

    // Touch Device Detection
    var isTouchDevice = 'ontouchstart' in document.documentElement;
    if( isTouchDevice ) {
        $('.isreal-pride').addClass('touch-device');
        $('.special-educators').addClass('touch-device');
    }


    /**** Change Icons ****/
    $(".fa-facebook").removeClass("fa-facebook").addClass("fa-facebook-square");
    $(".fa-youtube").removeClass("fa").addClass("fab");

    $("i.eicon").removeClass("eicon").addClass("fa");


    /**** Toggle Title font-weight in top menu ****/
    $(".responsive-menu-pro-subarrow").click(function(){
        var current_li = $(this).parent().parent();
        if(current_li.children("ul").hasClass("responsive-menu-pro-submenu-open")){
            current_li.addClass("submenu-open");
        }
        else{
            current_li.removeClass("submenu-open");
        }
    })


    /***remove desktop banner if empty***/
    if ($(".banner").find(".elementor-image").length !== 0){
      $(".banner").css("display","block");
    }
    else{
      $(".banner").css("display","none");
    }


    /**** Toggle Title font-weight in footer ****/
    $(".elementor-menu-toggle").on('click', function () {
        if ($(this).filter(".elementor-active")) {
            $(".required-title h3").css("font-weight", "bold");
            $(".elementor-menu-toggle").addClass("open-list");
        } else if($(".elementor-menu-toggle").filter(".open-list")) {
            $(".required-title h3").css("font-weight", "normal");
            $(".elementor-menu-toggle").removeClass("open-list");
        }
        else{}
    });

    /**** Calculate the position of the ".sub-menu"s elements of the primary menu ****/
    var max_site_width = 2000,
        header_width = $('#masthead').width(),
        header_padding_right = $('#masthead').css('padding-right'),
        header_padding_left = $('#masthead').css('padding-left');

    // Remove the 'px' from the strings and convert to int
    header_padding_right = parseInt( header_padding_right.substr(0, header_padding_right.length-2));
    header_padding_left = parseInt( header_padding_left.substr(0, header_padding_left.length-2));

    var header_full_width = header_width +header_padding_right + header_padding_left;

    $('.sub-menu').each(function(){
        var parent_li = $(this).parent(),
            parent_li_offset = parent_li.offset(),
            parent_li_padding_right = parent_li.css('padding-right'),
            parent_li_padding_left = parent_li.css('padding-left'),
            parent_li_width = parent_li.width(),
            parent_li_offset_left = parent_li_offset.left;

        // When the screen is very large there are margins to the site. We need to decrease the left margin from the
        // left offset of the sub-menu so it will be relative to the site and not to the document
        if(header_full_width == max_site_width){
            var page_margin_left = $('#page').css('margin-left');
            page_margin_left = parseInt(page_margin_left.substr(0, page_margin_left.length-2));
            parent_li_offset_left = parent_li_offset_left - page_margin_left;
        }

        // Remove the 'px' from the strings and convert to int
        parent_li_padding_right = parseInt( parent_li_padding_right.substr(0, parent_li_padding_right.length-2));
        parent_li_padding_left = parseInt( parent_li_padding_left.substr(0, parent_li_padding_left.length-2));

        var parent_li_right_side = parent_li_offset_left + parent_li_width + parent_li_padding_right + parent_li_padding_left,
            parent_li_right_offset = header_full_width - parent_li_right_side,
            submenu_width = $(this).width(), //if we want the width to get the correct value it should be known when the document is loaded and not when hoverring the element
            padding_left = header_full_width - (submenu_width + parent_li_right_offset);

        //Set the css to the current ".sub-menu" item
        $(this).css('right',-parent_li_right_offset);
        $(this).css('padding-right',Math.floor(parent_li_right_offset));
        $(this).css('padding-left', padding_left);
    });



    /**** City list ****/
    // on load, hide the list of posts
    $(".city-category-wrapper .school-list").addClass("hide");
    $(".city-category-title").click(function () {
        $(this).parent(".city-category-wrapper").toggleClass("closed");
        $(this).siblings(".school-list").toggleClass("hide");
    });



    $( '.popover-parent-search > a' ).on( 'click', function () {
        $( '.popover-parent-search > a' ).not( this ).parent().removeClass( 'active' );
        $( this ).parent().toggleClass( 'active' );
        /*for some reason, putting focus on the search input, needs setTimeot,
         * as described here: http://stackoverflow.com/questions/15859113/focus-not-working/15859155#15859155 */
        setTimeout( function () {
            $( '.search-field' ).focus();
        }, 500 );
    } );


    //Hide the menu when click off
    $( 'html' ).on( 'click focus', function () {
        $( '.popover-parent-search.active' ).removeClass( 'active' );
    } );
    //Don't include button or menu in 'html' click function
    $( '.popover-parent-search > a, .search-form' ).click( function ( event ) {
        event.stopPropagation();
    } );

    if ( $('body').attr('data-elementor-device-mode') == 'mobile' ) {
         $("#primary-menu .mobile").css('display','block');
    }
    else{
        $("#primary-menu .mobile").css('display','none');
    }


    //$('<button class="languages-button"><i class=\"fas fa-globe\"></i></button>').insertAfter(".menu-menu-1-container");
    $(".languages").prepend('<button class="languages-button"><i class=\"fas fa-globe\"></i></button>');


    /****** languages navigation ******/
    $('.languages-button').click(function () {
        if($(this).hasClass('active')){
            $('.languages-button').removeClass('active');
            $('#menu-languages').css('display','none');
        }
        else{
            $('.languages-button').addClass('active');
            $('#menu-languages').css('display','block');
        }

        $('#menu-languages').slideToggle(400);
    });


    /**** List of Sub Categories of News Category ****/
    // set the name of current sub category in the div above the list (.moblie-current)
    // if no sub category is selected - this is the parent category
    var list_categories = $(".list-categories"),
        sub_cat_name = $('.list-categories > .child.current').text();

    if(sub_cat_name == ''){
        sub_cat_name = 'כל הנושאים';
    }
    $('.mobile-current > span').text(sub_cat_name);

    // on load, hide the list of sub categories
    list_categories.addClass("hide");
    $(".mobile-current").click(function () {
        list_categories.toggleClass("hide");
    });

    // to file in "Drushim" page
    $("#upload").change(function(){
        $(".file-upload .pink-button").text("הקובץ עלה בהצלחה");
    })

    $('form').find("input[type=search]").each(function(ev) {

        $(this).attr("placeholder", OrtScriptParams.search);
    });

});