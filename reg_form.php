<div id="reg_block"></div>
<form style="margin-bottom: 0;" id="reg">
	<div id="form_reg">
		<div id="org_info_form_reg">
			<input type="text" placeholder="фамилия*" name="secondname" required><br>
				<div class="name-otch">
					<input type="text" placeholder="имя*" name="firstname" required style="width: 150px; padding-right: 1px; margin-right: 2px;">
					<input type="text" placeholder="отчество" name="lastname" style="width: 250px; padding-left: 1px; margin-left: 2px;"><br>
				</div>
					<input type="text" name="inn_org" placeholder="ИНН организации*" maxlength="10" required><br>
				<select name="ra_mo" required>
					<option>Муниципалитет</option>
						<?php 
							$sql = "SELECT id_mo, raion from mo join raions where raions.id_raion=mo.id_raion";
							$rai_q = mysqli_query($bd, $sql);
							$rai_l = mysqli_fetch_array($rai_q);
								do {
									echo '<option value="'.$rai_l['id_mo'].'">'.$rai_l['raion'].'</option>';
								}while ($rai_l=mysqli_fetch_array($rai_q));
						?>	
				</select><br>	
					<input type="text" name="nameorg" placeholder="название организации*">
		</div>
		<div id="man_info_form_reg">
			<input type="email" name="email" required placeholder="email*">
				<br>
			<input type="text" name="phone" maxlength="11" required placeholder="телефон*">
				<br>
			<div class="password">
				<input type="password" name="password" id="password-input" required placeholder="пароль*">
				<a href="#" class="password-control"><img src="img/show.svg" id="img-pwd" width="20px"></a>
			</div>
				<br>
			<button style="margin: 50px auto auto 0;" id="registrate">продолжить<img src="img/enter.png" width="24px" style="float: right;"></button>
		</div>
	</div>
	<br>
<script>
	$('body').on('click', '.password-control', function(){
	if ($('#password-input').attr('type') == 'password'){	
		$('#password-input').attr('type', 'text');
		$('#img-pwd').attr("src", "img/hide.png");
	} else {
		$('#password-input').attr('type', 'password');
		$('#img-pwd').attr("src", "img/show.png");
	}
	return false;
});
	$('#registrate').on('click', function(e) {
			e.preventDefault();
			 var form_data = new FormData($('#reg')[0]); 
	$.ajax({
			url: 'registrate.php', // point to server-side PHP script
			dataType: 'text',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
				success: function(html){
						$('#reg_attach').hide();
						$('#reg').remove();
			            $('#reg_block').html(html);
				}
		});
	});
</script>
</form>
