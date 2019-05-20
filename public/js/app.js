(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle").on('click',function(e) {
    e.preventDefault();
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll',function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    event.preventDefault();
  });

})(jQuery); // End of use strict

$(document).ready(function(){
    $('[name=idGamme]').on('change',function(){
         $('.wrapGamme').addClass('d-none');
         var gamme=$(this).val();
         $('.gamme'+gamme).removeClass('d-none');
    });
    $('[name=addSectionProduct]').on('click',function(e){
      e.preventDefault();
      var copie = $('.cardSectionToDuplicate:first').clone();
      copie.css('display','block');
      copie.appendTo('[name=wrapSectionProducts]');

    });
    $('[name=addMontantProduct]').on('click',function(e){
      e.preventDefault();
      var copie = $('.cardMontantToDuplicate:first').clone();
      copie.css('display','block');
      copie.appendTo('[name=wrapMontantProducts]');

    });
    $('[name=addRempliProduct]').on('click',function(e){
      e.preventDefault();
      var copie = $('.cardRempliToDuplicate:first').clone();
      copie.css('display','block');
      copie.appendTo('[name=wrapRempliProducts]');

    });

    $(document).on('click','.deteleCardProduct',function(){
      var child=$(this).children();
      console.log(child);
      child.val('0');
      var parent=$(this).parent();
      $(parent).css('display','none');
    });
    
});