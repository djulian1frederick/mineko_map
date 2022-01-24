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
		jQuery.ajax({
			  url: url,
	                    type: "POST",    
	                    data: "id="+id,
	                    cache: false,
	                    enableMouseTracking: true,
	                    return: false,
	                    success: function(html){  
	                    	
	                        $("#position_result").html(html); 
	                    }  
	                });
}