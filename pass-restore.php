<div id="popup" style="display: none;">
	<div class="back">
		
	</div>
	<div class="popup" style="height: 250px;">
		<div style="height: 200px;">
			<p style="color: #7b6f6f;">Для того, чтобы сбросить пароль, введите в поле ниже e-mail, который был использован для регистрации</p>
			<br><input type="email" id="email" required placeholder="введите адрес электронной почты">
			<div id="result" style="margin-top: 15px;"></div>
		</div>
		<div style="display: flex; flex-flow: row;">
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