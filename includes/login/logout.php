<main class="container">
	<div class="heading">
		<h1>DHBW Mehms</h1>
		<h2>Abmelden/Passwort ändern</h2>
	</div>
	
	<section class="paper">
	<h1> Passwort ändern: </h1>
	 <form action="login" method="post" enctype="multipart/form-data">				
			<label for="passwort1" class="required">Neues Passwort</label>
			<input id="passwort1" type="password" placeholder="Passwort" name="mPasswort1">
			<label for="passwort2" class="required">Passwort wiederholen</label>
			<input id="passwort2" type="password" placeholder="Passwort wiederholen" name="mPasswort2">
		<br>
		<button name="mPwAendern">Passwort ändern</button>
	</form>	
	</section>
	<br>
	
	<section class="paper">
		<h1> Abmelden: </h1>
		<form action="login" method="post" enctype="multipart/form-data">
			<button name="mAbmelden">Abmelden</button>
		</form>
	</section>
</main>