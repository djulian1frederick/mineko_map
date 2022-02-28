<div id="popup" style="display: none;">
	<div class="back">
		
	</div>
	<div class="popup" style="height: 250px;">
		<div style="height: 200px;">
			<h6 class="exit" onclick="abort_operation()">X</h6>
			<p style="color: #f43038; font-size: 14px; font-family: Circe Light;">Для того, чтобы сбросить пароль, введите в поле ниже e-mail, который был использован для регистрации</p>
			<br><input type="email" id="email" required placeholder="введите адрес электронной почты" style="width: 90%;">
			<div id="result" style="margin-top: 10px;"></div>
		</div>
		<div style="display: flex; flex-flow: row; margin-top: 10px;">
			<div class="popup-yes" onclick="restore_password()">
				<p>сбросить</p>
			</div>
			<div class="popup-no" onclick="abort_operation()">
				<p>отмена</p>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="../js/functions.js"></script>