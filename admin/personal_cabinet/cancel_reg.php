<?php 	session_start(); ?>
<?php require_once('../connection.php'); ?>
<div class="blocks_info">
	<form action="../scripts/delete_account.php" method="post" target="information">
	<?php echo '<input type="hidden" name="userid" value="'.$_SESSION['user_id'].'">';?>
	<button onclick="confirm_cancel()" value="personal" name="button" type="submit">Я хочу удалить свою учетную запись</button>
<?php if($_SESSION['level'] == '0') { echo'<button onclick="confirm_cancel()" value="zayavka" name="button" type="submit">Я хочу удалить заявку на регистрацию организации в системе и свою учетную запись</button>';}?>

	<p>Будьте аккуратны, данные действия нельзя отменить.</p>
	</form>
	<iframe borderless style="height: 40px; width: 100%;" name="information"></iframe>
</div>


<script>
	function confirm_cancel(){
		if(confirm('Это действие нельзя отменить, Вы уверены, что хотите продолжить?')){
			return true;
		}
	}
</script>	