function editmaininfo(){
	var nameorg = $('#nameorg').val();
	var inn = $('#inn').val();
	var ogrn = $('#ogrn').val();
	var sizepr = $('#sizepr').val();
	var viddey = $('#viddey').val();
	var viddeyadd = $('#viddeyadd').val();
	var codeprod = $('#codeprod').val();
	var codeprodadd = $('#codeprodadd').val();
	var year = $('#year').val();
	var codetnved = $('#codetnved').val();

	jQuery.ajax({
		type: "POST",
		url: '../admin/scripts/update_main.php',
		dataType: "text",
		data: {"nameorg" : nameorg, "inn": inn, "ogrn" : ogrn, "sizepr" : sizepr, "viddey" : viddey, "viddeyadd" : viddeyadd, "codeprodadd": codeprodadd, "codeprod" : codeprod, "year" : year, "codetnved" : codetnved},
		success:function(html){
			$('#updateinfo').html(html);
		}

	})

}

function editexports() {
	var orgid = $('#org_id').val();
	var country=$('#exports').val();

	jQuery.ajax({
		type: "POST",
		url: '../admin/scripts/update_exports.php',
		dataType: "text",
		data: {"orgid" : orgid, "country" : country},
		success:function(html){
			$('#updateinfo').html(html);
		}
	})
}