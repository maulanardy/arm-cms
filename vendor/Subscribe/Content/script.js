

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