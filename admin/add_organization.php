<?php require_once("connection.php");?>
<?php 
	$nameorg = $_POST['nameorg'];
	$inn = $_POST['inn'];
	$ogrm = $_POST['ogrn'];
	$sizepr = $_POST['sizepr'];
	$viddey = $_POST['viddey'];
	$year = $_POST['year'];
	$null="";
	$viddeyadd = $_POST['viddeyadd'];

	$codeprod = $_POST['codeprod'];
	$codeprodadd = $_POST['codeprodadd'];
if ($viddey <> $null && $codeprod <> $null){
	$sql= "INSERT into predpriyatiya (id_size, id_vid_deyat, id_code_product, name, inn, ogrn, yearstart) values ('".$sizepr."','".$viddey."','".$codeprod."','".$nameorg."','".$inn."','".$ogrm."', '".$year."')";

	$insert_org = mysqli_query($bd, $sql);
}
elseif ($viddey == $null  && $codeprod <> $null) {
	$sql= "INSERT into predpriyatiya (id_size, id_code_product, name, inn, ogrn, yearstart) values ('".$sizepr."','".$codeprod."','".$nameorg."','".$inn."','".$ogrm."',  '".$year."')";
		$viddey_sql = "INSERT into vid_deyat (vid_deyatelnosti) values ('".$viddeyadd."')";
		$viddey_q = mysqli_query($bd, $viddey_sql);
		if($viddey_q) {
			$insert_org = mysqli_query($bd, $sql);
			$vidd_select = "SELECT id_vid_deyat from vid_deyat where vid_deyatelnosti='".$viddey."'";
			$vidd_sel_q=mysqli_query($bd, $vidd_select);
			$vidd_sel_r = mysqli_fetch_array($vidd_sel_q);
			$vidd_id = $vidd_sel_r['id_vid_deyat'];
			if ($vidd_id <> NULL) {
				$sql_select_predp = "SELECT id_predpriyatiya from predpriyatiya where inn='".$inn."'";
				$choose_predrp = mysqli_query($bd, $sql_select_predp);
				$choose_predpr_row = mysqli_fetch_array($choose_predrp);
				$predpr_id = $choose_predpr_row['id_predpriyatiya'];
					$sql_update_vd = "UPDATE predpriyatiya set id_vid_deyat='".$vidd_id."' where id_predpriyatiya='".$predpr_id."'";
					$update_vd = mysqli_query($bd, $sql_update_vd);
			}
		}
}
elseif ($viddey <> $null && $codeprod == $null) {
	$sql= "INSERT into predpriyatiya (id_size, id_vid_deyat, name, inn, ogrn, yearstart) values ('".$sizepr."','".$viddey."','".$nameorg."','".$inn."','".$ogrm."', '".$year."')";
		$codeprod_sql = "INSERT into code_product(code) values ('".$codeprodadd."')";
		$codeprod_q = mysqli_query($bd, $codeprod_sql);
		if($codeprod_q) {
			$insert_org = mysqli_query($bd, $sql);
			$code_prod_sel = "SELECT id_code_product from code_product where code='".$codeprodadd."'";
			$code_prod_q = mysqli_query($bd, $code_prod_sel);
			$code_prod_r = mysqli_fetch_array($code_prod_q);
			$codepr_id = $code_prod_r['id_code_product'];
			if ($codepr_id <> NULL) {
				$sql_select_predp = "SELECT id_predpriyatiya from predpriyatiya where inn='".$inn."'";
				$choose_predrp = mysqli_query($bd, $sql_select_predp);
				$choose_predpr_row = mysqli_fetch_array($choose_predrp);
				$predpr_id = $choose_predpr_row['id_predpriyatiya'];
					$sql_update_cp = "UPDATE predpriyatiya set id_code_product='".$codepr_id."' where id_predpriyatiya='".$predpr_id."'";
					$update_cp =mysqli_query($bd, $sql_update_cp);			
				}
		}
}
elseif ($viddey == $null  && $codeprod == $null) {
	$sql= "INSERT into predpriyatiya (id_size, name, inn, ogrn, yearstart) values ('".$sizepr."','".$nameorg."','".$inn."','".$ogrm."', '".$year."')";
			$viddey_sql = "INSERT into vid_deyat (vid_deyatelnosti) values ('".$viddey."')";
			$viddey_q = mysqli_query($bd, $viddey_sql);
			if($viddey_q) {
				$insert_org = mysqli_query($bd, $sql);
				$vidd_select = "SELECT id_vid_deyat from vid_deyat where vid_deyatelnosti='".$viddey."'";
				$vidd_sel_q=mysqli_query($bd, $vidd_select);
				$vidd_sel_r = mysqli_fetch_array($vidd_sel_q);
				$vidd_id = $vidd_sel_r['id_vid_deyat'];
				if ($vidd_id <> NULL) {
					$sql_select_predp = "SELECT id_predpriyatiya from predpriyatiya where inn='".$inn."'";
					$choose_predrp = mysqli_query($bd, $sql_select_predp);
					$choose_predpr_row = mysqli_fetch_array($choose_predrp);
					$predpr_id = $choose_predpr_row['id_predpriyatiya'];
						$sql_update_vd = "UPDATE predpriyatiya set id_vid_deyat='".$vidd_id."' where id_predpriyatiya='".$predpr_id."'";
						$update_vd = mysqli_query($bd, $sql_update_vd);
				}
		}
			$codeprod_sql = "INSERT into code_product(code) values ('".$codeprodadd."')";
			$codeprod_q = mysqli_query($bd, $codeprod_sql);
			if($codeprod_q) {
				$code_prod_sel = "SELECT id_code_product from code_product where code='".$codeprodadd."'";
				$code_prod_q = mysqli_query($bd, $code_prod_sel);
				$code_prod_r = mysqli_fetch_array($code_prod_q);
				$codepr_id = $code_prod_r['id_code_product'];
				if ($codepr_id <> NULL) {
					$sql_select_predp = "SELECT id_predpriyatiya from predpriyatiya where inn='".$inn."'";
					$choose_predrp = mysqli_query($bd, $sql_select_predp);
					$choose_predpr_row = mysqli_fetch_array($choose_predrp);
					$predpr_id = $choose_predpr_row['id_predpriyatiya'];
						$sql_update_cp = "UPDATE predpriyatiya set id_code_product='".$codepr_id."' where id_predpriyatiya='".$predpr_id."'";
						$update_cp =mysqli_query($bd, $sql_update_cp);			
					}
		}
}


?>