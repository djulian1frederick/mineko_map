function editmaininfo(){
	var orgid = $('#org_id').val();
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
	var descr_organization = $('#descr_organization').val();

	jQuery.ajax({
		type: "POST",
		url: '../admin/scripts/update_main.php',
		dataType: "text",
		data: {"orgid" : orgid, "nameorg" : nameorg, "descr_organization" : descr_organization, "inn": inn, "ogrn" : ogrn, "sizepr" : sizepr, "viddey" : viddey, "viddeyadd" : viddeyadd, "codeprodadd": codeprodadd, "codeprod" : codeprod, "year" : year, "codetnved" : codetnved},
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

function updaterukovod(){
	var o_fam = $('#o_fam').val();
	var o_name = $('#o_name').val();
	var o_otch = $('#o_otch').val();
	var org_id = $('#org_id').val();
	var ruk_id = $('#ruk_id').val();

	jQuery.ajax({
		type: "POST",
		url: '../admin/scripts/update_rukovoditel.php',
		dataType: "text",
		data: {"ruk_id" : ruk_id, "org_id" : org_id , "o_name" : o_name, "o_otch" : o_otch, "o_fam" : o_fam},
		success:function(html){
			$('#updateinfo').html(html);
		}
	})
}

function updatecontact() {
	var con_id = $('#con_id').val();
	var org_id = $('#org_id').val();
	var org_phone1 = $('#org_phone1').val();
	var org_email = $('#org_email').val();

	jQuery.ajax({
		type: "POST",
		url: '../admin/scripts/update_contacts.php',
		dataType: 'text',
		data: {"con_id" : con_id , "org_id" : org_id, "org_phone1" : org_phone1, "org_email" : org_email},
		success:function(html) {
			$('#updateinfo').html(html);
		}
	})
}