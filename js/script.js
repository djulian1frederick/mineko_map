$(function () {
	var address = $('[name="address"]');

	address.fias({
		oneString: true,
		change: function (obj) {
			log(obj);
		}
	});

	function log(obj) {
		var log, i;

		$('.js-log li').hide();

		for (i in obj) {
			log = $('#' + i);

			if (log.length) {
				log.find('.value').text(obj[i]);
				log.show();
			}
		}
	}
});
