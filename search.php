<?php 
	require_once('admin/connection.php');

	$string_search = $_POST['string_search']; 	
	#$string_search = mysql_real_escape_string($bd, $string_search);

	if($string_search <> NULL) {
		$sql_query = "SELECT id_predpriyatiya, name from predpriyatiya where name LIKE '%$string_search%' group by name";
		$query_production = "SELECT name_production, id_predpriyatia from production where name_production LIKE '%$string_search%'";
			$result_production = mysqli_query($bd, $query_production);	
			$result = mysqli_query($bd, $sql_query);
			$row_result_production = mysqli_fetch_array($result_production);
			$row_result = mysqli_fetch_array($result);
		if ($row_result <> NULL || $row_result_production <> NULL) {
		do {
				if ($row_result_production <> NULL) { $id_predpr_from_production = $row_result_production['id_predpriyatia'];}

			$id = $row_result['id_predpriyatiya'];
			if(isset($id)) {
			$sql_info_org = "SELECT name, id_predpriyatiya from predpriyatiya where id_predpriyatiya='".$id."'";}
			elseif(isset($id_predpr_from_production)) {
				$sql_info_org = "SELECT name, id_predpriyatiya from predpriyatiya where id_predpriyatiya = '".$id_predpr_from_production."'";
			}
			$this_org = mysqli_query($bd, $sql_info_org);
			$org_row = mysqli_fetch_array($this_org);
			echo '<div class="block_organization">
					<div>
						<div class="organization_info_logo" style="text-align: center;">
							<a href="organization.php?id='.$org_row['id_predpriyatiya'].'">
							<h2>'.$org_row['name'].'</h2></a>
							<li style="display: none;">'.$org_row['name'].'</li>
						</div>
					</div>
				</div>';

			}
			while ($row_result = mysqli_fetch_array($result));
		}
		else {
			echo '<div class="block_organization">Нет результатов поиска</div>';
		}
	}
?>