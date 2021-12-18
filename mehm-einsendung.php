<!DOCTYPE html>
<html lang="de">

<head>
	<title>Dein Mehm - DHBW Mehms</title>
	<link href="styles/formular.css" rel="stylesheet">
	<?php include("includes/meta.php"); ?>
	<style>
		:root {
			--banner-top: #67bfeb;
			--banner-bottom: #fdea04;
		}

		.kontakt {
			animation: 0.2s color-p-primary forwards;
		}
	</style>
</head>

<body>
	<?php include("includes/header.php"); ?>

	<main class="container">
		<div class="heading">
			<h1>Kontakt</h1>
			<h2>Dein Mehm</h2>
		</div>
		<section class="paper">
			<p>Du hast selbsterstellte Mehms oder Vines, die du gerne mit anderen teilen möchtest? Diese Website lebt von euren Einsendungen!<br> Außerdem wird jede Einsendung auf Einmaligkeit überprüft, daher kann es sein, dass es einige Tage dauert, bis dein Mehm auf dieser Website sichtbar wird. Wir bitten um Verständnis. </p>

			<form action="mehm-formular" method="post" enctype="multipart/form-data">
				<label for="datei" class="required">Datei</label><input type="file" name="mDatei" id="datei" required>
				<b> Achtung! Es sind nur die Dateiformate .png .jpg .jepg .gif .webp erlaubt! </b>
				<br>
				<br>
				<label for="kategorie" class="required">Kategorie</label>
				<select name="mKategorie" id="kategorie" required>
					<option value="">Kategorie...</option>
					<option value="Programmieren">Programmieren</option>
					<option value="DHBW">DHBW</option>
					<option value="Aandere">Andere</option>
				</select>
				<label for="autor">Autor</label><input id="autor" type="text" placeholder="Autor des Mehms" name="mAutor"> <!-- Autor ist einfach der Eingeloggte User; evtl hier anzeigen?-->
				<br>
				<label for="bildbeschreibung">Bildbeschreibung</label><textarea id="bildbeschreibung" placeholder="Bildbeschreibung" name="mbildbeschreibung"></textarea>

				<button>Absenden</button>
			</form>

			<p>Bitte sende nur selbsterstellte Mehms ein. <em>Keiner mag geklaute Mehms!</em>
				<br>Außerdem erheben wir keinerlei Anspruch auf die hier veröffentlichten Bilder.
			</p>
			<details>
				<summary>Mehr zum Thema Urheberrecht</Summary>

				<p>Das Urheberrecht schützt den Urheber in seinen geistigen und persönlichen Beziehungen zum Werk und in der Nutzung des Werkes. Es dient zugleich der Sicherung einer angemessenen Vergütung für die Nutzung des Werkes.</p>

				<article>
					<h2 class="document">Urheberpersönlichkeitsrecht</h2>

					<h3 class="document">§ 12 Veröffentlichungsrecht</h3>
					(1) Der Urheber hat das Recht zu bestimmen, ob und wie sein Werk zu veröffentlichen ist.
					(2) Dem Urheber ist es vorbehalten, den Inhalt seines Werkes öffentlich mitzuteilen oder zu beschreiben, solange weder das Werk noch der wesentliche Inhalt oder eine Beschreibung des Werkes mit seiner Zustimmung veröffentlicht ist.

					<h3 class="document">§ 13 Anerkennung der Urheberschaft</h3>
					Der Urheber hat das Recht auf Anerkennung seiner Urheberschaft am Werk. Er kann bestimmen, ob das Werk mit einer Urheberbezeichnung zu versehen und welche Bezeichnung zu verwenden ist.

					<h3 class="document">§ 14 Entstellung des Werkes</h3>
					Der Urheber hat das Recht, eine Entstellung oder eine andere Beeinträchtigung seines Werkes zu verbieten, die geeignet ist, seine berechtigten geistigen oder persönlichen Interessen am Werk zu gefährden.

					<h2 class="document">Verwertungsrechte</h2>
					(1) Der Urheber hat das ausschließliche Recht, sein Werk in körperlicher Form zu verwerten; das Recht umfaßt insbesondere

					<h3 class="document">§ 16 Vervielfältigungsrecht</h3>
					(1) Das Vervielfältigungsrecht ist das Recht, Vervielfältigungsstücke des Werkes herzustellen, gleichviel ob vorübergehend oder dauerhaft, in welchem Verfahren und in welcher Zahl.
					(2) Eine Vervielfältigung ist auch die Übertragung des Werkes auf Vorrichtungen zur wiederholbaren Wiedergabe von Bild- oder Tonfolgen (Bild- oder Tonträger), gleichviel, ob es sich um die Aufnahme einer Wiedergabe des Werkes auf einen Bild- oder Tonträger oder um die Übertragung des Werkes von einem Bild- oder Tonträger auf einen anderen handelt.

					<h3 class="document">§ 17 Verbreitungsrecht</h3>
					(1) Das Verbreitungsrecht ist das Recht, das Original oder Vervielfältigungsstücke des Werkes der Öffentlichkeit anzubieten oder in Verkehr zu bringen.
					(2) Sind das Original oder Vervielfältigungsstücke des Werkes mit Zustimmung des zur Verbreitung Berechtigten im Gebiet der Europäischen Union oder eines anderen Vertragsstaates des Abkommens über den Europäischen Wirtschaftsraum im Wege der Veräußerung in Verkehr gebracht worden, so ist ihre Weiterverbreitung mit Ausnahme der Vermietung zulässig.
					(3) Vermietung im Sinne der Vorschriften dieses Gesetzes ist die zeitlich begrenzte, unmittelbar oder mittelbar Erwerbszwecken dienende Gebrauchsüberlassung. Als Vermietung gilt jedoch nicht die Überlassung von Originalen oder Vervielfältigungsstücken
					1.
					von Bauwerken und Werken der angewandten Kunst oder
					2.
					im Rahmen eines Arbeits- oder Dienstverhältnisses zu dem ausschließlichen Zweck, bei der Erfüllung von Verpflichtungen aus dem Arbeits- oder Dienstverhältnis benutzt zu werden.

					<h3 class="document">§ 18 Ausstellungsrecht</h3>
					Das Ausstellungsrecht ist das Recht, das Original oder Vervielfältigungsstücke eines unveröffentlichten Werkes der bildenden Künste oder eines unveröffentlichten Lichtbildwerkes öffentlich zur Schau zu stellen.

					<h3 class="document">§ 19 Vortrags-, Aufführungs- und Vorführungsrecht</h3>
					(1) Das Vortragsrecht ist das Recht, ein Sprachwerk durch persönliche Darbietung öffentlich zu Gehör zu bringen.
					(2) Das Aufführungsrecht ist das Recht, ein Werk der Musik durch persönliche Darbietung öffentlich zu Gehör zu bringen oder ein Werk öffentlich bühnenmäßig darzustellen.
					(3) Das Vortrags- und das Aufführungsrecht umfassen das Recht, Vorträge und Aufführungen außerhalb des Raumes, in dem die persönliche Darbietung stattfindet, durch Bildschirm, Lautsprecher oder ähnliche technische Einrichtungen öffentlich wahrnehmbar zu machen.
					(4) Das Vorführungsrecht ist das Recht, ein Werk der bildenden Künste, ein Lichtbildwerk, ein Filmwerk oder Darstellungen wissenschaftlicher oder technischer Art durch technische Einrichtungen öffentlich wahrnehmbar zu machen. Das Vorführungsrecht umfaßt nicht das Recht, die Funksendung oder öffentliche Zugänglichmachung solcher Werke öffentlich wahrnehmbar zu machen (§ 22).

					<h3 class="document">§ 19a Recht der öffentlichen Zugänglichmachung</h3>
					Das Recht der öffentlichen Zugänglichmachung ist das Recht, das Werk drahtgebunden oder drahtlos der Öffentlichkeit in einer Weise zugänglich zu machen, dass es Mitgliedern der Öffentlichkeit von Orten und zu Zeiten ihrer Wahl zugänglich ist.

					<h3 class="document">§ 20 Senderecht</h3>
					Das Senderecht ist das Recht, das Werk durch Funk, wie Ton- und Fernsehrundfunk, Satellitenrundfunk, Kabelfunk oder ähnliche technische Mittel, der Öffentlichkeit zugänglich zu machen.

					<h4 class="document">§ 20a Europäische Satellitensendung</h4>
					(1) Wird eine Satellitensendung innerhalb des Gebietes eines Mitgliedstaates der Europäischen Union oder Vertragsstaates des Abkommens über den Europäischen Wirtschaftsraum ausgeführt, so gilt sie ausschließlich als in diesem Mitgliedstaat oder Vertragsstaat erfolgt.
					(2) Wird eine Satellitensendung im Gebiet eines Staates ausgeführt, der weder Mitgliedstaat der Europäischen Union noch Vertragsstaat des Abkommens über den Europäischen Wirtschaftsraum ist und in dem für das Recht der Satellitensendung das in Kapitel II der Richtlinie 93/83/EWG des Rates vom 27. September 1993 zur Koordinierung bestimmter urheber- und leistungsschutzrechtlicher Vorschriften betreffend Satellitenrundfunk und Kabelweiterverbreitung (ABl. EG Nr. L 248 S. 15) vorgesehene Schutzniveau nicht gewährleistet ist, so gilt sie als in dem Mitgliedstaat oder Vertragsstaat erfolgt,
					1.
					in dem die Erdfunkstation liegt, von der aus die programmtragenden Signale zum Satelliten geleitet werden, oder
					2.
					in dem das Sendeunternehmen seine Niederlassung hat, wenn die Voraussetzung nach Nummer 1 nicht gegeben ist.
					Das Senderecht ist im Fall der Nummer 1 gegenüber dem Betreiber der Erdfunkstation, im Fall der Nummer 2 gegenüber dem Sendeunternehmen geltend zu machen.
					(3) Satellitensendung im Sinne von Absatz 1 und 2 ist die unter der Kontrolle und Verantwortung des Sendeunternehmens stattfindende Eingabe der für den öffentlichen Empfang bestimmten programmtragenden Signale in eine ununterbrochene Übertragungskette, die zum Satelliten und zurück zur Erde führt.

					<h4 class="document">§ 20b Weitersendung</h4>
					(1) Das Recht, ein gesendetes Werk im Rahmen eines zeitgleich, unverändert und vollständig weiterübertragenen Programms weiterzusenden (Weitersendung), kann nur durch eine Verwertungsgesellschaft geltend gemacht werden. Dies gilt nicht für
					1.
					Rechte an einem Werk, das ausschließlich im Internet gesendet wird,
					2.
					Rechte, die ein Sendeunternehmen in Bezug auf seine Sendungen geltend macht.
					(1a) Bei der Weitersendung über einen Internetzugangsdienst ist Absatz 1 nur anzuwenden, wenn der Betreiber des Weitersendedienstes ausschließlich berechtigten Nutzern in einer gesicherten Umgebung Zugang zum Programm bietet.
					(1b) Internetzugangsdienst im Sinne von Absatz 1a ist ein Dienst gemäß Artikel 2 Absatz 2 Nummer 2 der Verordnung (EU) 2015/2120 des Europäischen Parlaments und des Rates vom 25. November 2015 über Maßnahmen zum Zugang zum offenen Internet und zur Änderung der Richtlinie 2002/22/EG über den Universaldienst und Nutzerrechte bei elektronischen Kommunikationsnetzen und -diensten sowie der Verordnung (EU) Nr. 531/2012 über das Roaming in öffentlichen Mobilfunknetzen in der Union (ABl. L 310 vom 26.11.2015, S. 1), die zuletzt durch die Richtlinie (EU) 2018/1972 (ABl. L 321 vom 17.12.2018, S. 36; L 334 vom 27.12.2019, S. 164) geändert worden ist.
					(2) Hat der Urheber das Recht der Weitersendung einem Sendeunternehmen oder einem Tonträger- oder Filmhersteller eingeräumt, so hat der Weitersendedienst gleichwohl dem Urheber eine angemessene Vergütung für die Weitersendung zu zahlen. Auf den Vergütungsanspruch kann nicht verzichtet werden. Er kann im Voraus nur an eine Verwertungsgesellschaft abgetreten und nur durch eine solche geltend gemacht werden. Diese Regelung steht Tarifverträgen, Betriebsvereinbarungen und gemeinsamen Vergütungsregeln von Sendeunternehmen nicht entgegen, soweit dadurch dem Urheber eine angemessene Vergütung für jede Weitersendung eingeräumt wird.

					<h4 class="document">§ 20c Europäischer ergänzender Online-Dienst</h4>
					(1) Ein ergänzender Online-Dienst eines Sendeunternehmens ist
					1.
					die Sendung von Programmen im Internet zeitgleich mit ihrer Sendung in anderer Weise,
					2.
					die öffentliche Zugänglichmachung bereits gesendeter Programme im Internet, die für einen begrenzten Zeitraum nach der Sendung abgerufen werden können, auch mit ergänzenden Materialien zum Programm.
					(2) Die Vervielfältigung und die öffentliche Wiedergabe von Werken zur Ausführung eines ergänzenden Online-Dienstes eines Sendeunternehmens in einem Mitgliedstaat der Europäischen Union oder einem Vertragsstaat des Abkommens über den Europäischen Wirtschaftsraum gelten ausschließlich als in dem Mitgliedstaat oder Vertragsstaat erfolgt, in dem das Sendeunternehmen seine Hauptniederlassung hat. Der Rechtsinhaber und das Sendeunternehmen können den Umfang von Nutzungsrechten für ergänzende Online-Dienste des Sendeunternehmens beschränken.
					(3) Absatz 2 gilt bei Fernsehprogrammen nur für Eigenproduktionen des Sendeunternehmens, die vollständig von ihm finanziert wurden, sowie für Nachrichtensendungen und die Berichterstattung über Tagesereignisse, nicht aber für die Übertragung von Sportveranstaltungen.

					<h4 class="document">§ 20d Direkteinspeisung</h4>
					(1) Überträgt ein Sendeunternehmen die programmtragenden Signale an einen Signalverteiler, ohne sie gleichzeitig selbst öffentlich wiederzugeben (Direkteinspeisung), und gibt der Signalverteiler diese programmtragenden Signale öffentlich wieder, so gelten das Sendeunternehmen und der Signalverteiler als Beteiligte einer einzigen öffentlichen Wiedergabe.
					(2) § 20b gilt entsprechend.

					<h3 class="document">§ 21 Recht der Wiedergabe durch Bild- oder Tonträger</h3>
					Das Recht der Wiedergabe durch Bild- oder Tonträger ist das Recht, Vorträge oder Aufführungen des Werkes mittels Bild- oder Tonträger öffentlich wahrnehmbar zu machen. § 19 Abs. 3 gilt entsprechend.

					§ 22 Recht der Wiedergabe von Funksendungen und von öffentlicher Zugänglichmachung
					Das Recht der Wiedergabe von Funksendungen und der Wiedergabe von öffentlicher Zugänglichmachung ist das Recht, Funksendungen und auf öffentlicher Zugänglichmachung beruhende Wiedergaben des Werkes durch Bildschirm, Lautsprecher oder ähnliche technische Einrichtungen öffentlich wahrnehmbar zu machen. § 19 Abs. 3 gilt entsprechend.

					<h3 class="document">§ 23 Bearbeitungen und Umgestaltungen</h3>
					(1) Bearbeitungen oder andere Umgestaltungen eines Werkes, insbesondere auch einer Melodie, dürfen nur mit Zustimmung des Urhebers veröffentlicht oder verwertet werden. Wahrt das neu geschaffene Werk einen hinreichenden Abstand zum benutzten Werk, so liegt keine Bearbeitung oder Umgestaltung im Sinne des Satzes 1 vor.
					(2) Handelt es sich um
					1.
					die Verfilmung eines Werkes,
					2.
					die Ausführung von Plänen und Entwürfen eines Werkes der bildenden Künste,
					3.
					den Nachbau eines Werkes der Baukunst oder
					4.
					die Bearbeitung oder Umgestaltung eines Datenbankwerkes,
					so bedarf bereits das Herstellen der Bearbeitung oder Umgestaltung der Zustimmung des Urhebers.
					(3) Auf ausschließlich technisch bedingte Änderungen eines Werkes bei Nutzungen nach § 44b Absatz 2, § 60d Absatz 1, § 60e Absatz 1 sowie § 60f Absatz 2 sind die Absätze 1 und 2 nicht anzuwenden.

					<h3 class="document">§ 25 Zugang zu Werkstücken</h3>
					(1) Der Urheber kann vom Besitzer des Originals oder eines Vervielfältigungsstückes seines Werkes verlangen, daß er ihm das Original oder das Vervielfältigungsstück zugänglich macht, soweit dies zur Herstellung von Vervielfältigungsstücken oder Bearbeitungen des Werkes erforderlich ist und nicht berechtigte Interessen des Besitzers entgegenstehen.
					(2) Der Besitzer ist nicht verpflichtet, das Original oder das Vervielfältigungsstück dem Urheber herauszugeben.

					<h3 class="document">§ 26 Folgerecht</h3>
					(1) Wird das Original eines Werkes der bildenden Künste oder eines Lichtbildwerkes weiterveräußert und ist hieran ein Kunsthändler oder Versteigerer als Erwerber, Veräußerer oder Vermittler beteiligt, so hat der Veräußerer dem Urheber einen Anteil des Veräußerungserlöses zu entrichten. Als Veräußerungserlös im Sinne des Satzes 1 gilt der Verkaufspreis ohne Steuern. Ist der Veräußerer eine Privatperson, so haftet der als Erwerber oder Vermittler beteiligte Kunsthändler oder Versteigerer neben ihm als Gesamtschuldner; im Verhältnis zueinander ist der Veräußerer allein verpflichtet. Die Verpflichtung nach Satz 1 entfällt, wenn der Veräußerungserlös weniger als 400 Euro beträgt.
					(2) Die Höhe des Anteils des Veräußerungserlöses beträgt:
					1.
					4 Prozent für den Teil des Veräußerungserlöses bis zu 50.000 Euro,
					2.
					3 Prozent für den Teil des Veräußerungserlöses von 50.000,01 bis 200.000 Euro,
					3.
					1 Prozent für den Teil des Veräußerungserlöses von 200.000,01 bis 350.000 Euro,
					4.
					0,5 Prozent für den Teil des Veräußerungserlöses von 350.000,01 bis 500.000 Euro,
					5.
					0,25 Prozent für den Teil des Veräußerungserlöses über 500.000 Euro.
					Der Gesamtbetrag der Folgerechtsvergütung aus einer Weiterveräußerung beträgt höchstens 12.500 Euro.
					(3) Das Folgerecht ist unveräußerlich. Der Urheber kann auf seinen Anteil im Voraus nicht verzichten.
					(4) Der Urheber kann von einem Kunsthändler oder Versteigerer Auskunft darüber verlangen, welche Originale von Werken des Urhebers innerhalb der letzten drei Jahre vor dem Auskunftsersuchen unter Beteiligung des Kunsthändlers oder Versteigerers weiterveräußert wurden.
					(5) Der Urheber kann, soweit dies zur Durchsetzung seines Anspruchs gegen den Veräußerer erforderlich ist, von dem Kunsthändler oder Versteigerer Auskunft über den Namen und die Anschrift des Veräußerers sowie über die Höhe des Veräußerungserlöses verlangen. Der Kunsthändler oder Versteigerer darf die Auskunft über Namen und Anschrift des Veräußerers verweigern, wenn er dem Urheber den Anteil entrichtet.
					(6) Die Ansprüche nach den Absätzen 4 und 5 können nur durch eine Verwertungsgesellschaft geltend gemacht werden.
					(7) Bestehen begründete Zweifel an der Richtigkeit oder Vollständigkeit einer Auskunft nach Absatz 4 oder 5, so kann die Verwertungsgesellschaft verlangen, dass nach Wahl des Auskunftspflichtigen ihr oder einem von ihm zu bestimmenden Wirtschaftsprüfer oder vereidigten Buchprüfer Einsicht in die Geschäftsbücher oder sonstige Urkunden so weit gewährt wird, wie dies zur Feststellung der Richtigkeit oder Vollständigkeit der Auskunft erforderlich ist. Erweist sich die Auskunft als unrichtig oder unvollständig, so hat der Auskunftspflichtige die Kosten der Prüfung zu erstatten.
					(8) Die vorstehenden Bestimmungen sind auf Werke der Baukunst und der angewandten Kunst nicht anzuwenden.

					<h3 class="document">§ 27 Vergütung für Vermietung und Verleihen</h3>
					(1) Hat der Urheber das Vermietrecht (§ 17) an einem Bild- oder Tonträger dem Tonträger- oder Filmhersteller eingeräumt, so hat der Vermieter gleichwohl dem Urheber eine angemessene Vergütung für die Vermietung zu zahlen. Auf den Vergütungsanspruch kann nicht verzichtet werden. Er kann im voraus nur an eine Verwertungsgesellschaft abgetreten werden.
					(2) Für das Verleihen von Originalen oder Vervielfältigungsstücken eines Werkes, deren Weiterverbreitung nach § 17 Abs. 2 zulässig ist, ist dem Urheber eine angemessene Vergütung zu zahlen, wenn die Originale oder Vervielfältigungsstücke durch eine der Öffentlichkeit zugängliche Einrichtung (Bücherei, Sammlung von Bild- oder Tonträgern oder anderer Originale oder Vervielfältigungsstücke) verliehen werden. Verleihen im Sinne von Satz 1 ist die zeitlich begrenzte, weder unmittelbar noch mittelbar Erwerbszwecken dienende Gebrauchsüberlassung; § 17 Abs. 3 Satz 2 findet entsprechende Anwendung.
					(3) Die Vergütungsansprüche nach den Absätzen 1 und 2 können nur durch eine Verwertungsgesellschaft geltend gemacht werden.
				</article>
			</details>
			<p>Siehe auch: <a href="https://www.gesetze-im-internet.de/urhg/BJNR012730965.html#BJNR012730965BJNG000801377" target="_blank">Gesetz über Urheberrecht und verwandte Schutzrechte (Urheberrechtsgesetz)</a> </p>
		</section>
	</main>

	<?php include("includes/footer.php"); ?>
	<?php include("includes/bottom-navigation.php"); ?>
</body>

</html>