<link rel="stylesheet" type="text/css" href="css/circe.css">
<div class="block_organization">
	<div>
		<div class="organization_info_logo">
			<div class="logoblock">
				<img src="logo_organizations/default_logo.png">
			</div>
				<a href=""><h2>ООО "Новохром"</h2></a>
				<h4>Микропредприятие</h4>
		</div>
		
		<div class="info_about">
			<span><b>ИНН</b> <p>5607014758</p></span>
			<span><b>ОГРН</b> <p>1025600820365</p></span>
			<span><b>ОКВЭД</b> <p>20.12 Производство красителей и пигментов</p></span>
			<span><b>Код ТН ВЭД</b> <p>2819100000</p></span>
		</div>

		<div class="main-info-organization">
			<div class="block-with-image">
				<img src="img/calendar.png" class="organization_info_logo_img">
				<p>2005</p>
			</div>
			<div class="block-with-image">
				<img src="img/location.png" class="organization_info_logo_img">
				<p>город Новотроицк</p>
			</div>
			<div class="block-with-image">
				<img src="img/team.png">
				<p>Химическая промышленность</p>
			</div>
		</div>
	</div>
	
	<div class="main-info-organization" style="width: 75%; margin-left: 25%;">
		<div class="block-with-image">
			<img src="img/address.png">
			<p>Адрес 462353, обл. Оренбургская, г. Новотроицк, ул. Промышленная, 51</p>
		</div>
		<div class="block-with-image">
			<img src="img/phone1.png">
			<p>+73537674181</p>
		</div>
		<div class="block-with-image">
			<img src="img/email1.png">
			<p>sales@novochrom.ru</p>
		</div>
		<div class="block-with-image">
			<img src="img/manager.png">
			<p>Руководитель Хавкин Владимир Евгеньевич</p>
		</div>
	</div>
</div>

<style>
	
	body {
		margin: 0;
		padding: 0;
		background: #000;
	}
	.block_organization {
		background: #fff;
		width: 50%;
		padding: 5px 0;
		box-shadow: 0 5px 0 #EF0E19;
		margin: 15px 25%;
	}
	.block_organization img, .organization_info_logo_img {
		width: 16px;
		height: 16px;
	}
	.organization_info_logo {
		background: #fff;
		width: 100%;
		padding: 5px 0;
		margin: 0 auto;
		text-align: center;
	}

	h2, h4, h5 {
		padding: 0;
		margin: 0;
		text-align: center;
	}

	.organization_info_logo img {
		height: 90px;
		width: auto;
		padding: 0;
		margin: 0 auto;
	}

	.organization_info_logo h4{
		font-family: Circe ExtraLight;
		color: #114975;
		border-bottom: 1px solid #dcdcdc;
		width: 50%;
		margin: 0 25%;
	}

	.logoblock {
		width: 100px;
		height: 100px;
		border-radius: 50%;
		margin: 2px auto;
		overflow: hidden;
		background: #2f58d2;
	}

	.organization_info_logo h2 {
		color: #1c75bc;
		font-family: Circe Light;
		text-decoration: none;
		cursor: pointer;
	}

	.block_organization a{
		text-decoration: none;
	}

	.organization_info_logo h5 {
		color: #0d4f84;
		font-size: 14px;
		font-style: italic;
	}

	.main-info-organization {
		width: 50%;
		margin: 0.5% 25%;
		background: #fff;
		padding: 0;
		display: flex;
		flex-flow: column;
	}

	.main-info-organization img {
		padding: 0 15px;
		margin: 0;
	}
	.block-with-image {
		display: inline-flex;
		text-align: left;
	}

	.block-with-image p {
		padding: 0;
		margin: 0;
		color: #1c75bc;
		font-family: Circe Bold;
		border-bottom: 1px dotted;	
	}

	.info_about {
		text-align: center;
		display: inline-flex;
		flex-flow: wrap;
		margin-left: 15%;
		border-bottom: 1px solid #dcdcdc;
		padding-bottom: 10px;
	}

	.info_about span {
		font-family: Circe Light;
		border-bottom: 2px double #ef0e19;
		text-align: center;
		background: #1c75bc;
		color: white;
		padding: 5px 10px;
		margin: 0 2px;
		height: 100%;
		word-wrap: break-word;
	} 
	.info_about span p {
		font-family: Circe ExtraLight;
		text-align: center;
		padding: 0;
		margin: 2px 0;
	} 

</style>