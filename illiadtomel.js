$(document).ready(function() {
	$('#LoanTitle').change(function() {

		var title = encodeURIComponent($(this).val());

		$.ajax({
	    	type: "POST",
	    	crossdomain: true,
	    	url: "https://gvsuliblabs.com/labs/illiadtomel/index.php",
	    	data: {t: title}
		})
		.done(function(msg) {
	    	console.log('Data returned:' + msg);
	    	$('#melCheck').html(msg);

	    	$('#mel-redirect').click(function() {
	    		_gaq.push(['_trackEvent', 'Events', 'MeL Redirect', '1']);
	    	});


		});
	});
});