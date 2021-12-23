<!DOCTYPE html>
<html lang="de">

<head>
	<title>Kontakt - DHBW Mehms</title>
	<link href="../css/formular.css" rel="stylesheet">
	<?php include("includes/meta.php"); ?>
	<style>
		:root {
			--banner-top: #67bfeb;
			--banner-bottom: #20b94f;
		}

        .kontakt {
            animation: 0.2s color-p-primary forwards;
        }
    </style>
    <script>
        function playAudio() {
            new Audio('https://www.soundboard.com/mediafiles/mz/Mzg1ODMxNTIzMzg1ODM3_JzthsfvUY24.MP3').play();
        }
    </script>
</head>


<body>
<?php include("includes/header.php"); ?>

<main class="container">
    <div class="heading">
        <h1>Kontakt</h1>
        <h2>Fragen und Anregungen</h2>
    </div>
    <div class="flex">
        <aside class="paper">
            <p>
                Falls du gerne mehr über uns erfahren möchtest: <br> Hier kannst du dich für unseren Newsletter amelden,
                um Informationen über unsere Projekte und unser <strong>Mehm of the Month</strong> zu erhalten!
            </p>
            <h4> Mehm of the Month (December 2021):</h4>
            <img src="../assets/mehms/rick.gif" alt="good old Rick">
            <button onclick="playAudio()">Registrieren</button>
        </aside>
        <section class="contact paper">
            <div>
                <p>
                    Du hast Fragen oder Anregungen an uns? Dann kontaktiere uns ganz einfach über dieses Formular.<br>
                    Wir versuchen schnellstmöglich auf alle Anfragen zu antworten.
                    Falls du ein Mehm mit uns teilen möchtest, kannst du das <a href="mehm-einsendung"><b>hier</b></a>.
                </p>

                <form action="kontakt-formular.php" method="post">
                    <label for="name" class="required">Name</label>
                    <input id="name" type="text" placeholder="Name" required name="kName">
                    <label for="nachricht" class="required">Nachricht</label>
                    <textarea id="nachricht" placeholder="Nachricht" required name="kNachricht"></textarea>
                    <label for="mail" class="required">Mail</label>
                    <input id="mail" type="email" placeholder="Mailadresse" required name="kMail">
                    <button>Absenden</button>
                </form>
            </div>
        </section>
    </div>

</main>

<?php include("includes/footer.php"); ?>
<?php include("includes/bottom-navigation.php"); ?>
</body>

</html>