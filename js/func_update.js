function choose_org() {
	var org = $('#organization').val();
	 jQuery.ajax({
        type: "POST",
        url: '../editor/choose_org.php',
        dataType: "text",
        data: {"org" : org},
        success: function(html) {
            $('#result').html(html);
            open_menu('info_upd_organization');
		}
	})
}