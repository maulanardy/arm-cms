$(document).ready(function(){
	$base = $("body").data("base");
 	var bookTrigger = {
	  "async": true,
	  "crossDomain": true,
	  "url": $base+"book-trigger",
	  "method": "POST"
	}

	checkBook();

	function checkBook(){

		$.ajax(bookTrigger).done(function (response) {
		  var data = JSON.parse(response);

		  if(data.status){
		    if (!$("html").hasClass("notif-card-active")) {
		    	$(".notif-card").find("h4").html(data.name);
		      notif_card();
		    } else {
		      return false;
		    }
		  }
		});

		setTimeout(checkBook, 5000);
	}

	$("#btn_subscribe").on("click", function(e){
		$base = $(this).data("base");
		$email = $("#text_subscribe").val();

		$.post($base + "subscribe",{email: $email, subscribe: "subscribe"} , function(data, status){
        alert(data);
    });

		e.preventDefault();
	})

	$("#btn_unsubscribe").on("click", function(e){
		$base = $(this).data("base");
		$email = $("#text_subscribe").val();

		$.post($base + "subscribe",{email: $email, unsubscribe: "unsubscribe"} , function(data, status){
        alert(data);
    });

		e.preventDefault();
	})

	var inf = $("#page-info");
	var active_page = inf.data("active-page-slug");
	var main_menu = inf.data("menu-target");

  $(main_menu).find("li").each(function() {
  	if(active_page != ""){
      if ($(this).find("a").data("slug") == active_page) {
        $(this).addClass('active');
      }
    }
  });

  $(".popup-gallery").fancybox();

  $("[data-wkwkwk]").on("click", function(e) {
    if (!$("html").hasClass("notif-card-active")) {
      notif_card();
    } else {
      return false;
    }
  });

  $('#installment_program').change(function() {
	  // set the window's location property to the value of the option the user has selected
	  window.location = $(this).find("option:selected").data("url");
	});
})