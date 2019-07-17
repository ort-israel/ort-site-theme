jQuery(document).ready(function ($) {

    $(".content-details").attr("tabindex", "0");
    $(".postid-29774 li").attr("tabindex", "0");
    $(".elementor-heading-title").attr("tabindex", "0");

    $('.sub-menu a').focus(function () {
        $(this).parents('.sub-menu').addClass('focused');

    })

    // Open and close the sub menu of primary menu when navigating with tab
    if ($("#primary-menu li").hasClass('menu-item-has-children')) {
        $(".menu-item-has-children").attr('aria-expanded', 'true');
        $(".menu-item-has-children a").on("focus", function () {
            $(this).siblings('.sub-menu').addClass('focused');
            $('.sub-menu.focused').css('display', 'flex');
        })
            .keydown(function (evt) {
                if (evt.which === 9) {
                    if (evt.shiftKey === false) {
                        $(this).siblings('.sub-menu').removeClass('focused');

                        //when the last child of sub-menu losses focus display sub-menu to "none"
                        if (($(this).parent()).is(':last-child')) {
                            $('.sub-menu').css('display', 'none').removeClass('focused');
                        }
                    }
                }
            })
            .blur(function () {
                console.log($('.sub-menu'));

                if ($('#primary-menu').children(':focus').length == 0) {
                    console.log('exit primary menu');
                } else {
                    console.log('inside primary menu');
                }

            });
    }


    //Close sub menu when the user tabbed back from the current item of main menu
    $('.menu-item-has-children > a').keydown(function (evt) {
        if (evt.which === 9) {
            if (evt.shiftKey === true) {
                $('.sub-menu').css('display', 'none').removeClass('focused');
            }
        }
    });

    // Open and close the languages menu when navigating with tab
    $('.languages-button').on('focus', function () {
        $(this).addClass('active');
        //**$('#menu-languages').slideToggle(400);
        $('#menu-languages').css('display', 'block');
    });
    $('#menu-languages a').on('focus', function () {
        $(this).addClass('active');
        //**$('#menu-languages').slideToggle(400);
        $('#menu-languages').css('display', 'block');
    });

    $('#menu-languages a').keydown(function (evt) {
        if (evt.which === 9) {
            if (evt.shiftKey === false) {
                //when the last child of menu-languages losses focus display sub-menu to "none"
                if (($(this).parent()).is(':last-child')) {
                    $('.languages-button').removeClass('active');
                    //**$('#menu-languages').slideToggle(400);
                    $('#menu-languages').css('display', 'none');
                }
            }
        }
    });

    $('.languages-button').keydown(function (evt) {
        if (evt.which === 9) {
            if (evt.shiftKey === true) {
                $('.languages-button').removeClass('active');
                //**$('#menu-languages').slideToggle(400);
                $('#menu-languages').css('display', 'none');

            }
        }
    });
      $('.heateor_sss_sharing_ul li').attr("tabindex", "0");
     
   /* $('.heateor_sss_sharing_ul').children().eq(0).attr("tabindex", "0");
       $('.heateor_sss_sharing_ul').children().eq(1).attr("tabindex", "0");
       $('.wcp-slick .slick-dots button ')*/


    var attr = "";
    $(".convar").click(function () {
        attr = $("body").attr('style');
            $(".details-educators").css("background-color","transparent");
            $(".details-educators h3").css("background-color","transparent");
            $(".details-educators .post-exc").css("background-color","transparent");
            $(".details-educators h3").css("color","white");
            $(".details-educators .post-exc").css("color","white");

        if ($("body").attr("style", "background-color:rgb(0, 0, 0)")) {
            $(".logo-tech a").css("background-color", "white");
            $(".ort-logo-words a").css("background-color", "white");
            $(".ort-logo-img a").css("background-color", "white");
            $(".values-educational #carousel-29735.wcp-slick .slick-arrow").addClass("black-color").css("color", "white !important");
            $(".comments-area form .comment-form-author input, .comments-area form .comment-form-email input, .comments-area form .comment-form-url input, #submit").css("color","#000");
            $(".responsive-menu-pro-box").css("border","red");

        }
        if ($("body").attr("style", "background-color:rgb(255, 255, 255)")) {
            $(".footer-bottom img").css("background-color", "black");
            $(".footer-bottom img").css("padding", "10px");
            $("form #subscribe").addClass("white-color");
            $("form #subscribe").attr("style", "background-color:rgb(0, 0, 0)");
            $("form .wpcf7-form-control").attr("style", "background-color:rgb(0, 0, 0)");
            $(".elementor-menu-toggle").addClass("elementor-active");
            $(".heateorSssSharingRound i ss").css("background-color","rgb(0, 0, 0)");
            $(".comments-area form .comment-form-author input, .comments-area form .comment-form-email input, .comments-area form .comment-form-url input, #submit").css("background-color","#ececec");
            $(".responsive-menu-pro-box").css("background-color","white");
            $(".responsive-menu-pro-inner").css("background-color","black");
        }
    });

    /*when teh page is refreshed with specific color*/
    attr = $("body").attr('style');
    if (typeof attr !== typeof undefined && attr.length !== 0) {
            $(".details-educators").css("background-color","transparent");
            $(".details-educators h3").css("background-color","transparent");
            $(".details-educators .post-exc").css("background-color","transparent");
            $(".details-educators h3").css("color","white");
            $(".details-educators .post-exc").css("color","white");

        if ($("body").attr("style", "background-color:rgb(0, 0, 0)")) {
            $(".logo-tech a").css("background-color", "white");
            $(".ort-logo-words a").css("background-color", "white");
            $(".ort-logo-img a").css("background-color", "white");
            $("#carousel-29735.wcp-slick .slick-arrow.slick-next").addClass("black-color");
            $(".comments-area form .comment-form-author input, .comments-area form .comment-form-email input, .comments-area form .comment-form-url input, #submit").css("color","#000");
            $(".responsive-menu-pro-box").css("background-color","white");
        }

        if ($("body").attr("style", "background-color:rgb(255, 255, 255)")) {
            $(".footer-bottom  img").css("background-color", "black");
            $(".footer-bottom  img").css("padding", "10px");
            $("form #subscribe").addClass("white-color");
            $("form #subscribe").attr("style", "background-color:rgb(0, 0, 0)");
            $("form .wpcf7-form-control").attr("style", "background-color:rgb(0, 0, 0)");
            $(".elementor-menu-toggle").addClass("elementor-active");
            $(".heateorSssSharingRound i ss").css("background-color","rgb(0, 0, 0)");
            $(".comments-area form .comment-form-author input, .comments-area form .comment-form-email input, .comments-area form .comment-form-url input, #submit").css("background-color","#ececec");
            $(".responsive-menu-pro-box").css("background-color","white");
            $(".responsive-menu-pro-inner").css("background-color","black");
            $(".elementor-social-icons-wrapper .elementor-icon .fa-youtube").addClass("aaa");
            $(".site-footer .footer-details > .elementor-container > .elementor-row .elementor-icon i.aaa").css("color","black");
        }

        $("#menu-languages a").first().attr('lang', OrtScriptParams.langEnglish);
        $("#menu-languages li:nth-child(2) a").attr('lang', OrtScriptParams.langArabic);
    }

        $('.elementor-page-29813 .elementor-widget-wrap .elementor-widget-text-editor p').attr('tabindex','0');

    $(".wah-call-readable-fonts").click(function (){

        $(".newsletter-sign .wpcf7-submit").css("background-position","left calc(70% - 12rem) top 0rem");
        $(".file-upload").css("width","250px");
        

        if($("body").attr("data-elementor-device-mode","tablet")){
            $(".page-id-31149 .title-fact-numbers").css("width","100vh");
            $(".page-id-31149 .title-fact-numbers").css("margin","0");
            $(".page-id-31149 .fact-numbers").css("width","100vh");
            $(".page-id-31149 .fact-numbers").css("margin","0");
            $(".postid-29774 li strong:nth-of-type(2)").css("width","225px");
            $(".postid-116 .title-fact-numbers").css("width","100vh");
            $(".postid-116 .title-fact-numbers").css("margin","0");
            $(".postid-116 .fact-numbers").css("width","100vh");
            $(".postid-116 .fact-numbers").css("margin","0");
            $(".title-desc .page-title").css("max-width","45%");
        }
       });

    fix_special_educators_size_when_zooming();

    document.addEventListener('keydown', function(event) {
        if(event.keyCode === 17){
            fix_special_educators_size_when_zooming()
        }
    });

});

/* This function removes the last educator when the zoom is more than 175%,
*  so the text would not run out of the educator's block.
*  When the zoom is scaled down again return to the original style*/
function fix_special_educators_size_when_zooming() {
    if(window.devicePixelRatio > 1 && window.devicePixelRatio < 1.75) {
        $('#page section.special-educators ul li:last-child').css('display', 'block');
        $('#page section.special-educators ul li').css('width', '33%');
    }
    else if(window.devicePixelRatio >= 1.75 && window.devicePixelRatio < 2) {
        $('#page section.special-educators ul li:last-child').css('display', 'none');
        $('#page section.special-educators ul li').css('width', '50%');
    }
}