$(document).ready(function() {

	//List for when the user clicks on the hamburger icon
	$('.hamburger').on('click', function() {
	$('.menu').toggleClass('open');
	});

	var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});



	   var apiKey = '3091dd94ddbbad4f9bbc7d4a24c3d390';
	   var url = 'https://api.forecast.io/forecast/';
	   var lati = 34.924866
	   var longi = -81.025078
	   var data;

	   $.getJSON(url + apiKey + "/" + lati + "," + longi + "?callback=?", function(data) {
              /*CURRENT EVERYTHING*/
              $('.temp_num').html( data.currently.temperature.toFixed(0) + '&deg;');
              $('.detail_word').html( data.currently.summary);
              /*ICON PICS*/
              if (data.currently.icon == "clear-day"){
                $(".detail_sum").css("background", 'url("../images/wc12.png") no-repeat');
                $(".detail_sum").css("background-repeat", 'no-repeat');
              }
              else if (data.currently.icon == "cloudy"){
                $(".detail_sum").css("background", 'url("../images/wc2.png") no-repeat');
                $(".detail_sum").css("background-repeat", 'no-repeat');
              }
              else if (data.currently.icon == "partly-cloudy-day"){
                $(".detail_sum").css("background", 'url("../images/wc10.png") no-repeat');
                $(".detail_sum").css("background-repeat", 'no-repeat');
              }
              else if (data.currently.icon == "clear-night"){
                $(".detail_sum").css("background", 'url("../images/wc13.png") no-repeat');
                $(".detail_sum").css("background-repeat", 'no-repeat');
              }
              else if (data.currently.icon == "rain"){
                $(".detail_sum").css("background", 'url("../images/wc3.png") no-repeat');
                $(".detail_sum").css("background-repeat", 'no-repeat');
                $(".gif1").css("background", 'url("images/rain.gif") no-repeat');
                $(".gif1").css("background-size", 'cover');
              }
              else if (data.currently.icon == "partly-cloudy-night"){
                $(".detail_sum").css("background", 'url("../images/wc7.png") no-repeat');
                $(".detail_sum").css("background-repeat", 'no-repeat');
              }
              else if (data.currently.icon == "fog"){
                $(".detail_sum").css("background", 'url("../images/wc7.png") no-repeat');
                $(".detail_sum").css("background-repeat", 'no-repeat');
              }
              else{
                $(".detail_sum").css("background", 'url("../images/wc6.png") no-repeat');
                $(".detail_sum").css("background-repeat", 'no-repeat');
              }

        });      


});

