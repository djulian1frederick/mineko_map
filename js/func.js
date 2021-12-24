	

	function shoow(id){
		var l, t = 0
		var ind = Number(id)
			switch(ind) {
				case 1: //абдулинский
				l = '24.5%';
				t = '3.25%';
				break;
				case 2: //адамовский
				l = '47.75%';
				t = '8.5%';
				break;
				case 3: //акбулакский
				l = '39.75%';
				t = '8.25%';
				break;
				case 4: //александровский
				l = '30.75%';
				t = '5.25%';
				break;
				case 5: // асекеевский
				l = '22.5%';
				t = '4.25%';
				break;
				case 6: // беляевский
				l = '22.5%';
				t = '6.5%';
				break;
				case 7: //бугурусланский
				l = '22.5%';
				t = '6.5%';
				break;
				case 8: //бузулукский
				l = '23.5%';
				t = '8.5%';
				break;
				case 9: //гайский
				l = '36.75%';
				t = '6.5%';
				break;
				case 10: //грачевский
				l = '21.5%';
				t = '5.25%';
				break;
				case 11: //домбаровский
				l = '43.75%';
				t = '8.5%';
				break;
				case 12: //илекский
				l = '30.75%';
				t = '6.25%';
				break;
				case 13: //кваркенский
				l = '43.75%';
				t = '6.5%';
				break;
				case 14: //красногвардейский
				l = '28.5%';
				t = '7.25%';
				break;
				case 15: //кувандыкский
				l = '29.5%';
				t = '6.5%';
				break;
				case 16: //курманаевский
				l = '15.5%';
				t = '9.25%';
				break;
				case 17: //матвеевский
				l = '26.5%';
				t = '5.25%';
				break;
				case 18: //новоорский
				l = '43.75%';
				t = '6.5%';
				break;
				case 19: //новосергиевский
				l = '30.75%';
				t = '6.25%';
				break;
				case 20: //октябрьский
				l = '37.75%';
				t = '8.25%';
				break;
				case 21: //оренбургский
				l = '39.75%';
				t = '8.25%';
				break;
				case 22: //первомайский
				l = '15.5%';
				t = '7.25%';
				break;
				case 23: //переволоцкий
				l = '32.75%';
				t = '6.25%';
				break;
				case 24: //пономарёвский
				l = '28.75%';
				t = '3.25%';
				break;
				case 25: //сакмарский
				l = '39.75%';
				t = '8.25%';
				break;
				case 26: // саракташский
				l = '22.5%';
				t = '6.5%';
				break;
				case 27: //светлинский
				l = '58.75%';
				t = '8.5%';
				break;
				case 28: // северный
				l = '20%';
				t = '5%';
				break;
				case 29: // соль-илецкий
				l = '40.75%';
				t = '8.25%';
				break;
				case 30: //сорочинский
				l = '26.5%';
				t = '8.25%';
				break;
				case 31: //ташлинский
				l = '26.25%';
				t = '7.25%';
				break;
				case 32: //тоцкий
				l = '17.5%';
				t = '9.25%';
				break;
				case 33: //тюльганский
				l = '22.5%';
				t = '6.5%';
				break;
				case 34: //шарлыкский
				l = '36.75%';
				t = '5.25%';
				break;
				case 35: //ясненский 
				l = '47.75%';
				t = '8.5%';
				break;
				case 36: //орский
				l = '40.75%';
				t = '6.5%';
				break;
				case 37: //Новотроицк
				l = '38.75%';
				t = '6.5%';
				break;
				case 38: //оренбург
				l = '39.75%';
				t = '8.25%';
				break;
				case 39: //бугуруслан
				l = '22.5%';
				t = '6.5%';
				break;
				case 40: //бузулук
				l = '22.5%';
				t = '10.5%';
				break;
				case 42: // ЗАТО комаровский
				l = '51.75%';
				t = '8.5%';
				break;
				default: 
					l = 300;
					t = 200;
				}
	$.ajax({  
	                    url: "hover.php",
	                    type: "POST",    
	                    data: "id="+id,
	                    cache: false,
	                    enableMouseTracking: true,
	                    return: false,
	                    success: function(html){  
	                        let target = $(".tooltip")
				    	   	target.show()
					  		$(".tooltip").css({ "left": l, "top": t, });
				    	   	$("#raion").html(html); 
	                    }  
	});      		  
		}
	function hide(id) {
		 let target = $(".tooltip")
			    	   	target.hide()
	}

    function hovermap(id) {
        for (elem of document.getElementsByClassName('raion-hover')){
            elem.classList.remove('raion-hover')
        }

		document.getElementById(id).classList.add("raion-hover");

        setTimeout( () => {
            document.getElementById(id).classList.remove('raion-hover');
        },3000)
        
	}

	function open_info(id) {
		if (id === 'main') {
			var url = "main_organization.php";
		}
		else if (id === 'contacts') {
			var url = "contacts_organization.php";
		}
		else if (id === 'production') {
			var url = "production_orgranization.php";
		}
		else if (id === 'profile') {
			var url = "profile_for_user.php";
		}

		$.ajax({  
	                    url: url,
	                    type: "POST",    
	                    data: "id="+id,
	                    cache: false,
	                    enableMouseTracking: true,
	                    return: false,
	                    success: function(html){  
	                    	
	                        $("#window").html(html); 
	                    }  
	});
	}

	function toggle(ownid, id, sid) {
  
  var thisid = document.getElementById(ownid); 
  if (thisid.checked == true) {
    document.getElementById(id).style.display = "block";
    document.getElementById(sid).style.display = "none";
  }
  if (thisid.checked == false) {
   document.getElementById(id).style.display = "none";
    document.getElementById(sid).style.display = "block";
  }
}
