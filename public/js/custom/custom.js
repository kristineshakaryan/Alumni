$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 100) {
        $(".header-wrp").addClass("header-sticky");
    } else {
        $(".header-wrp").removeClass("header-sticky");
    }
});


/*==================
	Wow js
==============*/

var wow = new WOW(
  {
    boxClass:     'wow',     
    animateClass: 'animated',
    offset:       0,         
    mobile:       true,      
    live:         true,      
    callback:     function(box) {

    },
    scrollContainer: null 
  }
);
wow.init();



/*====================
    Tesimonial js
================*/

jQuery('.home-banner-slider').owlCarousel({
    loop:true,
    margin:0,
    dots: false,
    nav: true,
    items: 1,
    navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
})



/*====================
    section1c
================*/

jQuery('.section1c-left-slider').owlCarousel({
    loop:true,
    margin:20,
    dots: false,
    nav: true,
    items: 3,
    navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
})

$('.VoirPlus').click(function () {
    var token = $('meta[name="token"]').attr('content');
    var url = decodeURIComponent($(this).attr('data_url'));
    var page = url.replace('#', '')
    page = page.split("page=")[1];
    var _this = this;
    $.ajax({
        type:'get',
        url: url,
        success: function(r){
            $('.more_content').append(r);
            $('.more_content>div').show('slow')
            if ($(_this).attr('count') == page) {
                $(_this).remove()
            }else{
                $(_this).attr('data_url',url.replace(page,Number(page)+1))
            }
        }
    })
})
