<?php session_start(); if(isset($_SESSION['user_id'])) {header("Location: editor/index");}?>
<!DOCTYPE html5>
<html>
<head>
	<title>Авторизация</title>
<meta charset="utf-8">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="js/func.js"></script>
<link rel="stylesheet" href="css/index.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
	<div class="content">
		<?php if(!isset($_SESSION['user_id'])) {include('login_form.php');} ?>
	</div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>
