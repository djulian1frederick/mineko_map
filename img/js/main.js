

$('.raion').hover (function() {
		$('.onle').html($(this).attr('twonk'));
		$('.onle').fadeIn()
	},
	function() {
		$('.twonk').fadeOut(50);
	});