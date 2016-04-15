
// When title has been entered, run function

$('#LoanTitle').change(checkMel(encodeURIComponent($(this).val())));



function checkMel(title) {
	
	$.ajax({
    	method: "POST",
    	crossdomain: true,
    	url: "https://gvsuliblabs.com/labs/illiadtomel/index.php",
    	data: {t: title}
	}).done(function(msg) {
    	console.log(msg);
    	$('#melCheck').html(msg);
	});
}