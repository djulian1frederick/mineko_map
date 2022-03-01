function position(id) {
	if (id === 'info') {
			var url = "adding_organization/organization_info.php";
		}
		else if (id === 'rukovoditeli') {
			var url = "adding_organization/organization_rukovoditeli.php";
		}
		else if (id === 'addresses') {
			var url = "adding_organization/organization_address.php";
		}
		else if (id === 'mo') {
			var url = "adding_organization/organization_mo.php";
		}
		else if(id === 'mo_rukovoditel') {
			var url = "mo/mo_rukovoditel.php";
		}
		else if(id === 'pic_rukovoditel') {
			var url = "mo/mo_rukovoditel_pic.php";
		}
		else if(id === 'services') {
			var url = "adding_organization/organization_services.php";	
		}
		jQuery.ajax({
			  
	                    type: "POST",    
	                    url: url,
	                    data: "id="+id,
	                    cache: false,
	                    enableMouseTracking: true,
	                    return: false,
	                    success: function(html){  
	                    	
	                        $("#position_result").html(html); 
	                    }  
	                });
}

function open_menu(id) {
	var org_ident = $('#org_ident').val();
	if(id === 'info_upd_organization') {
		var url = "updating_organization/main_info.php";
	}
	else if(id === 'rukovoditeli') {
		var url = "updating_organization/rukovoditel.php";
	}
	else if(id === 'contacts') {
		var url = "updating_organization/contacts.php";
	}
	else if(id === 'attach') {
		var url = "updating_organization/attach.php";
	}
	else if(id === 'exports') {
		var url = "updating_organization/exports.php";
	}
	else if(id === 'addresses') {
		var url = "updating_organization/addresses.php";
	}
	else if(id === 'production') {
		var url = "updating_organization/production.php";
	}
	else if(id === 'services') {
		var url = "updating_organization/organization_services.php";	
	}
	else if(id === 'facilities') {
		var url = "updating_organization/facilities.php";
	}
	jQuery.ajax({
		url: url, 
			type: "POST",
			data: "org_ident="+org_ident,
			cache: false,
	        enableMouseTracking: true,
	        return: false,
	            success: function(html){  
	                $("#position_result").html(html); 
	            } 
	});
}

function openservices() {
	var orga_mo = $('#orga_mo').val();
	jQuery.ajax({
		type: "POST",
		url: '../editor/updating_organization/services_list.php',
		dataType: 'text',
		data: {"orga_mo" : orga_mo },
		success:function(html) {
			$('#services').html(html);
		}
	})
}

function personal(id) {
	if (id === 'pk') {
			var url = "personal_cabinet/pc.php";
		}
		else if (id === 'cont') {
			var url = "personal_cabinet/cont.php";
		}
		else if (id === 'pass') {
			var url = "personal_cabinet/pass.php";
		}
		else if (id === 'cancel_reg') {
			var url = "personal_cabinet/cancel_reg.php";
		}
		
		jQuery.ajax({
			  
	                    type: "POST",    
	                    url: url,
	                    data: "id="+id,
	                    cache: false,
	                    enableMouseTracking: true,
	                    return: false,
	                    success: function(html){  
	                    	
	                        $("#personal").html(html); 
	                    }  
	                });
}