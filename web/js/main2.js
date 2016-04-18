// You can also use "$(window).load(function() {"
    $(window).load(function () {

      // Slideshow
      $(".slider").responsiveSlides({
        auto: true,
        pager: false,
        nav: true,
        speed: 950,
        namespace: "callbacks",
        before: function () {
          $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
          $('.events').append("<li>after event fired.</li>");
        }
      });

    });