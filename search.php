<?php 
	require_once('admin/connection.php');

	$string_search = $_POST['string_search']; 	
	#$string_search = mysql_real_escape_string($bd, $string_search);

	if($string_search <> NULL) {
		$sql_query = "SELECT id_predpriyatiya, name from predpriyatiya where name LIKE '%$string_search%' group by name";	
			$result = mysqli_query($bd, $sql_query);
			$row_result = mysqli_fetch_array($result);

			$query_production = "SELECT name_production, id_product from production where name_production LIKE '%$string_search%' group by name_production";
			$result_production = mysqli_query($bd, $query_production);
			$row_result_production = mysqli_fetch_array($result_production);	
		do {
			$id_predpr_from_production = $row_result_production['id_product'];
			$id = $row_result['id_predpriyatiya'];
					if ($id <> NULL) {
						$sql_info_org = "SELECT name, id_predpriyatiya from predpriyatiya where predpriyatiya.id_predpriyatiya='".$id."'";
						$this_org = mysqli_query($bd, $sql_info_org);
						$org_row = mysqli_fetch_array($this_org);
						do {
							$id_page_o = 'organization?id='.$org_row['id_predpriyatiya'].''; 
							$name_o=$org_row['name']; 
							echo '<div class="block_organization">
									<div>
										<div class="organization_info_logo" style="text-align: center;">
											<a href="'.$id_page_o.'">
											<h2>'.$name_o.'</h2></a>
											<li style="display: none;">'.$name_o.'</li>
										</div>
									</div>
								</div>';}
						while($org_row = mysqli_fetch_array($this_org));
					}
					
					if($id_predpr_from_production <> NULL) {	
						$sql_info_production = "SELECT name_production, id_product from production where production.id_product='".$id_predpr_from_production."'";
						$this_production = mysqli_query($bd, $sql_info_production);
						$production_org = mysqli_fetch_array($this_production);
						do {
							$id_page_p = 'production?id='.$production_org['id_product'].'';
							$name_p=$production_org['name_production'];
							echo '<div class="block_organization">
									<div>
										<div class="organization_info_logo" style="text-align: center;">
											<a href="'.$id_page_p.'">
											<h2>'.$name_p.'</h2></a>
											<li style="display: none;">'.$name_p.'</li>
										</div>
									</div>
								</div>';} 
						while($production_org = mysqli_fetch_array($this_production));
					}
			}
			while ($row_result = mysqli_fetch_array($result) && $row_result_production = mysqli_fetch_array($result_production));
		}
		else {
			echo '<div class="block_organization">Нет результатов поиска</div>';
		}	
?>