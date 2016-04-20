$(function () {
	oplclick();
});


function oplclick() {
	$('.buynow').on('click',function() {
		$('.stoim-wrap').hide(50);
		$('.oplatit').show(50);
	});
	$('.svernut').on('click',function() {
		$('.stoim-wrap').show(50);
		$('.oplatit').hide(50);
	});
}