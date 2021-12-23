<main class="container">
	<div class="heading">
		<h1>DHBW Mehms</h1>
		<h2>Anmeldung</h2>
	</div>

    <?php
    if (isset($text) && $text != '') {
        $type = $error ? 'error' : '';
        echo "<section class='paper ".$type."'>".$text."</section><br>";
    }
    ?>

	<!-- Login -->
	<section class="paper">
	 	<form action="login" method="post" enctype="multipart/form-data">				
			<label for="benutzer" class="required">Benutzer</label>
			<input id="benutzer" type="text" placeholder="Benutzer" name="mBenutzer">
			<label for="passwort" class="required">Passwort</label>
			<input id="passwort" type="password" placeholder="Passwort" name="mPasswort">
			<br>
			<button name="mAnmelden">Anmelden</button>
		</form>	
	</section>
	<br>
	
	<!-- Registrierung -->
	<section class="paper">	
	<details>
		<summary> <strong>oder registrieren ... </strong></summary>
		 <form action="login" method="post" enctype="multipart/form-data">				
			<label for="benutzerNeu" class="required">Benutzer</label>
			<input id="benutzerNeu" type="text" placeholder="Benutzer" name="mBenutzerNeu">
			<label for="passwort1" class="required">Passwort</label>
			<input id="passwort1" type="password" placeholder="Passwort" name="mPasswort1">
			<label for="passwort2" class="required">Passwort wiederholen</label>
			<input id="passwort2" type="password" placeholder="Passwort wiederholen" name="mPasswort2">
			<br>
			<button name="mRegistrieren">Registrieren</button>
		</form>
	</details>						
	</section>
	
	<br>
	<br> 
	<br>
</main>