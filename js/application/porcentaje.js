$(function() {
				$("#slider").slider({
				value:10,
				min: 0,
				max: 100,
				step: 5,
				slide: function( event, ui ) {
					$("#amount").val("$" + ui.value);
				}
			});
		$("#amount").val( "$" + $( "#slider" ).slider( "value" ) );
	});
