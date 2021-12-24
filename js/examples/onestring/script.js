$(function () {
	var $address = $('[name="address"]'),
		$parent = $('[name="parent"]');

	$address.fias({
		oneString: true,
		change: function (obj) {
			log(obj);
		}
	});

	$parent.change(function () {
		changeParent($(this).val());
	});

	changeParent($('[name="parent"]:checked').val());

	function changeParent(value) {
		var parentType = null,
			parentId = null;
		$address.fias({
			parentType: parentType,
			parentId: parentId
		});
	}

	function log(obj) {
		var $log, i;

		$('.js-log li').hide();

		for (i in obj) {
			$log = $('#' + i);

			if ($log.length) {
				$log.find('.value').text(obj[i]);
				$log.show();
			}
		}
	}
});
