function addto()
{	var rname = $('#r_name').val();
	var	rfam = $('#r_fam').val();
	var rotch =$('#r_otch').val();
	var raion = $('#r_raion').val();
	var phone = $('#phone1').val();
    var email = $('#email').val();
    var post = $('#post').val();
    var ruk = $('#rukids').val();
	 //post variables
	        jQuery.ajax({
            type: 'POST', // HTTP метод  POST или GET
            url: '../editor/scripts/add_rukovoditeli_mo.php', //url-адрес, по которому будет отправлен запрос
            dataType:'text', // Тип данных,  которые пришлет сервер в ответ на запрос ,например, HTML, json
            data:{'phone' : phone, 'post' : post, 'email' : email, 'r_name': rname, 'r_fam': rfam, 'r_otch': rotch, 'rraion': raion}, //данные, которые будут отправлены на сервер (post переменные)
            success:function(html){
           		$('#answer').html(html);
           		$('#r_name').val('');
           		$('#r_fam').val('');
           		$('#r_otch').val('');
           		$('#r_raion').val('1');
                $('#email').val('');
                $('#phone1').val('+7');
                $('#post').val('')
                alert('Успешно!');
        	},
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //выводим ошибку
            }
        });
	}
function addto_responsiblies() {
    var rname = $('#r_name').val();
    var rfam = $('#r_fam').val();
    var rotch =$('#r_otch').val();
    var raion = $('#r_raion').val();
    var post = $('#post').val();
    var phone = $('#phone1').val();
    var email = $('#email').val();
    var ruk = $('#rukids').val();
     //post variables
            jQuery.ajax({
            type: 'POST', // HTTP метод  POST или GET
            url: '../editor/scripts/addto_responsiblies.php', //url-адрес, по которому будет отправлен запрос
            dataType:'text', // Тип данных,  которые пришлет сервер в ответ на запрос ,например, HTML, json
            data:{'phone' : phone, 'post' : post, 'email' : email, 'r_name': rname, 'r_fam': rfam, 'r_otch': rotch, 'rraion': raion}, //данные, которые будут отправлены на сервер (post переменные)
            success:function(html){
                $('#answer').html(html);
                $('#r_name').val('');
                $('#r_fam').val('');
                $('#r_otch').val('');
                $('#r_raion').val('1');
                $('#email').val('');
                $('#post').val('');
                $('#phone1').val('+7');
                alert('Успешно!');
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //выводим ошибку
            }
        });
}
//добавление организации -> admin/organization
function addorganization(){
    var nameorg = $('#nameorg').val();
    var inn = $('#inn').val();
    var ogrn = $('#ogrn').val();
    var year = $('#year').val();
    var ra_mo = $('#ra_mo').val();
    if (nameorg != '' && inn != '' && ogrn != ''){
    jQuery.ajax({
        type: 'POST',
        url: '../editor/scripts/add_organization.php',
        dataType: 'text',
        data: {'ra_mo' : ra_mo, 'nameorg' : nameorg ,'inn' : inn ,'ogrn' : ogrn, 'year' : year},
        success: function(html) {
            $('#nameorg').val('');
            $('#inn').val('');
            $('#ogrn').val('');
            $('#ra_mo').val('0');
            $('#year').val('');
            $('#result').html(html);
            alert('Успешно!');
        },
        error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //выводим ошибку
        }
        
        });
    }
    else {
        alert('Не все обязательные поля заполнены!');
    }

}

function add_address() {
    var address=$('#address').val();
    var numberhouse=$('#numberhouse').val();
    var org=$('#org').val();
     jQuery.ajax({
        type: 'POST',
        url: '../editor/scripts/add_organization_address.php',
        dataType: 'text',
        data: {'organization' : org , 'address' : address, 'numberhouse' : numberhouse},
        success: function(html) {
            $('#address').val('');
            $('#numberhouse').val('');
            $('#org').val('');
            $('#result').html(html);
            alert('Успешно!');
        },
        error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //выводим ошибку
        }
        
    })
}

function addcontacts_to_organization(){
    var fam = $('#o_fam').val();
    var name = $('#o_name').val();
    var otch = $('#o_otch').val();
    var phone = $('#org_phone1').val();
    var organ_email = $('#org_email').val();
    var org_con = $('#org_con').val();
    var post = $('#post').val();
    jQuery.ajax({
            type: 'POST',
            url: '../editor/scripts/add_rukovoditel_to_organization_with_contacts.php',
            dataType: 'text',
            data: {'org_con' : org_con, 'post' : post, 'organ_email' : organ_email, 'phone' : phone, 'fam' : fam, 'name' : name, 'otch' : otch}, 
            success: function(html) {
                $('#o_fam').val('');
                $('#o_name').val('');
                $('#o_otch').val('');
                $('#org_phone1').val('');
                $('#org_email').val('');
                $('#org_con').val('');
                $('#post').val('');
                alert('Добавлено!');
                $('#updateinfo').html(html);
            },
            error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError); //выводим ошибку
            }
            
        })
}

function addservices_to_org() {
    var orga_mo=$('#orga_mo').val();
    var exp_service =$('#exp_service').val();
    jQuery.ajax({
        type: 'POST',
        url: '../editor/scripts/add_services_organization.php',
        dataType: 'text',
        data: {'orga_mo' : orga_mo, 'exp_service' : exp_service},
        success: function(html) {
            $('#orga_mo').val('');
            $('#exp_service').val('');
                $('#result').html(html);
        },
        error:function(xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    })
}

function addcodetn() {
            var codetnved = $('#codetnved').val();
            var orgid = $('#orgid').val();
            var codetnved_descr=$('#codetnved_descr').val();
            $.ajax({
                url: '../editor/scripts/organization_addcodetn.php',
                type: 'POST',
              dataType: 'text',
              data: {'codetnved' : codetnved, 'orgid' : orgid, 'codetnved_descr' : codetnved_descr},
              success: function(html) {
                    $('#result').html(html);
                    $('#codetnved').val('');
                    $('#codetnved_descr').val('');
                    alert('Успешно!');
                }
            })

    }
