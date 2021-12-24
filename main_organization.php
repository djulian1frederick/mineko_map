<?php require_once('admin/connection.php'); ?>
<?php $sql = "SELECT * from predpriyatiya where id_predpriyatiya='1'";
		$select_query = mysqli_query($bd, $sql);
		$row = mysqli_fetch_array($select_query);

		$sql_kved = "SELECT * from code_product where id_code_product='".$row['id_code_product']."'";
		$select_kved = mysqli_query($bd, $sql_kved);
		$okved = mysqli_fetch_array($select_kved);

		$sql_adr = "SELECT * from addresses where id_addr='".$row['id_address']."'";
		$select_adr = mysqli_query($bd, $sql_adr);
		$adr = mysqli_fetch_array($select_adr);

		$sql_size = "SELECT * from size_predpr where id_size='".$row['id_size']."'";
		$select_size = mysqli_query($bd, $sql_size);
		$size=mysqli_fetch_array($select_size);

		$vid_size = "SELECT * from vid_deyat where id_vid_deyat='".$row['id_vid_deyat']."'";
		$select_vid = mysqli_query($bd, $vid_size);
		$vid = mysqli_fetch_array($select_vid);
?>
<div class="up-org">
	<div style="width: 35%;"><img src="img/example.jpg" alt="logo" class="logo"></div>
		<div style="width: 55%; margin: 0 5%"><label>ОГРН</label><?php  echo '<input disabled type="text" name="ogrn" value="'.$row['ogrn'].'">';?><br>
		<label>ИНН</label><?php echo '<input disabled type="text" name="inn" value="'.$row['inn'].'">'; ?><br>
		<label>ТН ВЭД</label><?php echo '<input disabled type="text" name="tnved" value="'.$row[' code_tn_ved '].'">';?></div>
</div>
<div class="middle-org">
	<label>Название организации</label><?php echo '<input disabled type="text" name="name_org" value="'.$row['name'].'">';?><br>
	<label>Адрес</label><?php echo '<input disabled type="text" name="address" value="'.$adr['full_address'].'">';?><br>
	<label>ОКВЭД</label><?php echo '<input type="text" disabled value="'.$okved['code'].'" name="okved">';?><br>
</div>
<div class="down-org">
	<label>Размер</label>
<?php	echo '<input disabled type="text" name="size" value="'.$size['name_size'].'">';?>
	<label>Вид деятельности</label>
<?php	echo '<input disabled type="text" name="deyat" value="'.$vid['vid_deyatelnosti'].'">'; ?>
</div>

<button onclick="update_org()">
	Обновить
</button>