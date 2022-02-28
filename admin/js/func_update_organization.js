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
	var descr_organization = $('#descr_organization').val();

	jQuery.ajax({
		type: "POST",
		url: '../editor/scripts/update_main.php',
		dataType: "text",
		data: {"orgid" : orgid, "nameorg" : nameorg, "descr_organization" : descr_organization, "inn": inn, "ogrn" : ogrn, "sizepr" : sizepr, "viddey" : viddey, "viddeyadd" : viddeyadd, "codeprodadd": codeprodadd, "codeprod" : codeprod, "year" : year},
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
		url: '../editor/scripts/update_exports.php',
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
		url: '../editor/scripts/update_rukovoditel.php',
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
		url: '../editor/scripts/update_contacts.php',
		dataType: 'text',
		data: {"con_id" : con_id , "org_id" : org_id, "org_phone1" : org_phone1, "org_email" : org_email},
		success:function(html) {
			$('#updateinfo').html(html);
		}
	})
}

function update_personal_info() {
	var firstname = $('#name').val();
	var second = $('#second').val();
	var last = $('#last').val();
	var id_check = $('#id_check').val();
	var id_con = $('#id_con_people').val();
	var null_var = undefined;
	if (id_check != null_var) {
		$.ajax({
			url: '../editor/scripts/update_personal.php',
			type: "POST",
		    dataType: "text",
		    data: {"firstname" : firstname, "second" : second, "last" : last, "id_check" : id_check},
		    success: function(html) {
		        $('#result').html(html);
			}
		})
	}
	else if(id_con != null_var && id_con != '') {
		$.ajax({
			url: '../editor/scripts/update_personal.php',
			type: "POST",
		    dataType: "text",
		    data: {"firstname" : firstname, "second" : second, "last" : last, "id_con" : id_con},
		    success: function(html) {
		        $('#result').html(html);
			}
		})
	}
	else if(id_con == '') {
		$.ajax({
			url: '../editor/scripts/update_personal.php',
			type: "POST",
		    dataType: "text",
		    data: {"firstname" : firstname, "second" : second, "last" : last},
		    success: function(html) {
		        $('#result').html(html);
			}
		})
	}
}

function update_personal_contacts(){
	var phone = $('#phone').val();
	var email = $('#email').val();
	var id_check = $('#id_check').val();
	var id_con = $('#id_con_people').val();
	var null_var = undefined;
	if (id_check != null_var) {
		$.ajax({
			url: '../editor/scripts/update_personal_contacts.php',
			type: "POST",
		    dataType: "text",
		    data: {"phone" : phone, "email" : email, "id_check" : id_check},
		    success: function(html) {
		        $('#result').html(html);
			}
		})
	}
	else if(id_con != null_var && id_con != '') {
		$.ajax({
			url: '../editor/scripts/update_personal_contacts.php',
			type: "POST",
		    dataType: "text",
		    data: {"phone" : phone, "email" : email, "id_con" : id_con},
		    success: function(html) {
		        $('#result').html(html);
			}
		})
	}
	else if(id_con == '') {
		$.ajax({
			url: '../editor/scripts/update_personal_contacts.php',
			type: "POST",
		    dataType: "text",
		    data: {"phone" : phone, "email" : email},
		    success: function(html) {
		        $('#result').html(html);
			}
		})
	}
}

function update_address(){
	var address = $('#address').val();
	var numberhouse = $('#numberhouse').val();
	var addr = $('#addr').val();
	var organization = $('#organization').val();
	$.ajax({
		url: '../editor/scripts/update_address.php',
		type: "POST",
		dataType: "text",
		data: {"address" : address,"numberhouse":numberhouse,"addr":addr, "organization" : organization},
		success: function(html){
			$('#result').html(html);
		}
	})

}