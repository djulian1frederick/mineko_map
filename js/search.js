function search() {
	var string_search = $('#searchinput').val();
	$('#search_result').show();

	jQuery.ajax({
		type: "POST",
		url: "../search.php",
		datatype: "text",
		data: {"string_search" : string_search},
		success: function(html){
            $('#search_result').html(html);
	        if (string_search = '') {
			$('#search_result').hide();
	}
		},
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //выводим ошибку
            }
	});
}