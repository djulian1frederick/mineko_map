<?php
			require_once('admin/connection.php');
				$id = $_POST['id'];
				$sql_select_map = "SELECT * from mo join raions where mo.id_raion = raions.id_raion and mo.id_raion='".$id."'";
				$result_sm = mysqli_query($bd, $sql_select_map);
				$row_sm = mysqli_fetch_array($result_sm);
				$sql_count = "SELECT count(*) from predpriyatiya join mo where mo.id_mo=predpriyatiya.id_mo and mo.id_raion='".$id."'";
				$result_count = mysqli_query($bd, $sql_count);
				$result_cnt = mysqli_fetch_array($result_count);
					echo '<img src="/mo/'.$row_sm['herb'].'" alt="'.$row_sm['raion'].'" height="75px" style="margin: 0 auto;">';
					echo '<p style="border-bottom: 2px solid;padding-bottom: 10px; font-size: 16px;">'.$row_sm['raion'].'</p>';
					echo '<h3>Руководитель</h3><p>'.$row_sm['second_name'].' '.$row_sm['first_name'].' '.$row_sm['last_name'].'</p>';
					echo '<h3>Количество экспортеров</h3><p>'.$result_cnt[0].'</p>';

			?>

			<link rel="stylesheet" href="css/index.css">