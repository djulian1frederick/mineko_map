function choose_org() {
	var org = $('#organization').val();
	 jQuery.ajax({
        type: "POST",
        url: '../admin/choose_org.php',
        dataType: "text",
        data: {"org" : org},
        success: function(html) {
            $('#result').html(html);
		}
	})
}