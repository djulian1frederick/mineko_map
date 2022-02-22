function addto()
{	var rname = $('#r_name').val();
	var	$rfam = $('#r_fam').val();
	var rotch =$('#r_otch').val();
	var raion = $('#r_raion').val();
	var phone = $('#phone1').val();
    var email = $('#email').val();
    var ruk = $('#rukids').val();
	 //post variables
	        jQuery.ajax({
            type: "POST", // HTTP метод  POST или GET
            url: "../editor/scripts/add_rukovoditeli_mo.php", //url-адрес, по которому будет отправлен запрос
            dataType:"text", // Тип данных,  которые пришлет сервер в ответ на запрос ,например, HTML, json
            data:{"phone" : phone, "email" : email, "r_name": rname, "r_fam": rfam, "r_otch": rotch, "rraion": raion}, //данные, которые будут отправлены на сервер (post переменные)
            success:function(html){
           		$("#answer").html(html);
           		$("#r_name").val('');
           		$("#r_fam").val('');
           		$("#r_otch").val('');
           		$("#r_raion").val('1');
                $("#email").val('');
                $("#phone1").val('+7');
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
    var sizepr = $('#sizepr').val();
    var viddey = $('#viddey').val();
    var codeprod = $('#codeprod').val();
    var viddeyadd = $('#viddeyadd').val();
    var codeprodadd = $('#codeprodadd').val();
    var year = $('#year').val();
    if (nameorg != '' && inn != '' && ogrn != ''){
    jQuery.ajax({
        type: "POST",
        url: '../editor/scripts/add_organization.php',
        dataType: "text",
        data: {"nameorg" : nameorg ,"inn" : inn ,"ogrn" : ogrn ,"sizepr" : sizepr ,"viddey" : viddey , "viddeyadd" : viddeyadd ,"codeprod" : codeprod, "codeprodadd" : codeprodadd, "year" : year},
        success: function(html) {
            $('#result').html(html);
            $('#nameorg').val('');
            $('#inn').val('');
            $('#ogrn').val('');
            $('#sizepr').val('');
            $('#viddey').val('0');
            $('#codeprod').val('0');
            $('#viddeyadd').val('');
            $('#codeprodadd').val('');
            $('#year').val('');
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
        type: "POST",
        url: '../editor/scripts/add_organization_address.php',
        dataType: "text",
        data: {"organization" : org , "address" : address, "numberhouse" : numberhouse},
        success: function(html) {
            $('#address').val('');
            $('#numberhouse').val('');
            $('#org').val('');
            $('#result').html(html);
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
    jQuery.ajax({
            type: "POST",
            url: '../editor/scripts/add_rukovoditel_to_organization_with_contacts.php',
            dataType: "text",
            data: {"org_con" : org_con, "organ_email" : organ_email, "phone" : phone, "fam" : fam, "name" : name, "otch" : otch}, 
            success: function(html) {
                $("#result").html(html);
                $('#o_fam').val('');
                $('#o_name').val('');
                $('#o_otch').val('');
                $('#org_phone1').val('');
                $('#org_email').val('');
                $('#org_con').val('');

            },
            error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError); //выводим ошибку
            }
            
        })
}

function addmo_to_org() {
    var ra_mo=$('#ra_mo').val();
    var organization =$('#orga_mo').val();
    jQuery.ajax({
        type: "POST",
        url: '../editor/scripts/add_mo_organization.php',
        dataType: "text",
        data: {"ra_mo" : ra_mo, "organization" : organization},
        success: function(html) {
            $('#ra_mo').val('');
            $('#orga_mo').val('');
                $("#result").html(html);
        },
        error:function(xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    })
}

function addservices_to_org() {
    var orga_mo=$('#orga_mo').val();
    var exp_service =$('#exp_service').val();
    jQuery.ajax({
        type: "POST",
        url: '../editor/scripts/add_services_organization.php',
        dataType: "text",
        data: {"orga_mo" : orga_mo, "exp_service" : exp_service},
        success: function(html) {
            $('#orga_mo').val('');
            $('#exp_service').val('');
                $("#result").html(html);
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
                type: "POST",
              dataType: "text",
              data: {"codetnved" : codetnved, "orgid" : orgid, "codetnved_descr" : codetnved_descr},
              success: function(html) {
                    $('#result').html(html);
                    $('#codetnved').val('');
                    $('#codetnved_descr').val('');
                }
            })

    }
