<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Anmeldung zur Hamburger Einzelmeisterschaft U15 2018</title>
  <link href="jquery-ui.min.css" rel="stylesheet">
</head>
<body>
<div id="accordion">
  <h2>Neuen Teilnehmer zur Hamburger Einzelmeisterschaft U15 2018 anmelden</h2>
  <div>
    <form action="index.php" method="post">
<?php

$club = $_POST['club'];

if (isset ($_POST['register'])) {
	//this is where the creating of the csv takes place
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$yearOfBirth = $_POST['yearOfBirth'];
	$sex = $_POST['sex'];
	$cvsData = $firstName . "," . $lastName . "," . $yearOfBirth . "," . $sex . "," . $club . "\n";
	$fp = fopen("data.csv", "a"); // $fp is now the file pointer to file $filename
	if ($fp) {
		fwrite($fp, $cvsData); // Write information to the file
		fclose($fp); // Close the file
	}
	echo 
"<div class=\"ui-widget\">
  <div class=\"ui-state-highlight ui-corner-all\" style=\"padding: 0 .7em;\">
    <p>
      <strong>" . $firstName . ' ' . $lastName . "</strong> wurde erfolgreich angemeldet.
    </p>
  </div>
</div>";
}
?>
      <div style="padding: .7em;"><label for="input_firstName">Vorname: </label><input required name="firstName" id="input_fistName" type="text"></div>
      <div style="padding: .7em;"><label for="input_lastName">Nachname: </label><input required name="lastName" id="input_lastName" type="text"></div>
      <div style="padding: .7em;"><label for="input_yearOfBirth">Geburtsjahr: </label><input required name="yearOfBirth" id="input_yearOfBirth" value="2005" min="2004" max="2006" type="number"></div>
      <div style="padding: .7em;">Geschlecht: 
        <div id="radioset">
          <label for="input_male">männlich</label><input id="input_male" type="radio" required name="sex" value="m">
          <label for="input_female">weiblich</label><input id="input_female" type="radio" required name="sex" value="f">
        </div>
      </div>
      <div style="padding: .7em;"><label for="input_club">Verein: </label>
      <select name="club" id="input_club" required >
<option value="">Bitte wählen sie ihren Verein</option>
<option <?php echo $club=="FC Hellbrook" ? "selected" : ""?> value="FC Hellbrook">FC Hellbrook</option>
<option <?php echo $club=="1. SC Norderstedt" ? "selected" : ""?> value="1. SC Norderstedt">1. SC Norderstedt</option>
<option <?php echo $club=="Alster- Dojo Kendo/Kyudo" ? "selected" : ""?> value="Alster- Dojo Kendo/Kyudo">Alster- Dojo Kendo/Kyudo</option>
<option <?php echo $club=="AMTV" ? "selected" : ""?> value="AMTV">AMTV</option>
<option <?php echo $club=="Barsbütteler SV v. 1948 e.V." ? "selected" : ""?> value="Barsbütteler SV v. 1948 e.V.">Barsbütteler SV v. 1948 e.V.</option>
<option <?php echo $club=="BKSV Goliath" ? "selected" : ""?> value="BKSV Goliath">BKSV Goliath</option>
<option <?php echo $club=="Bojutsu- Bushido" ? "selected" : ""?> value="Bojutsu- Bushido">Bojutsu- Bushido</option>
<option <?php echo $club=="Bramfelder SV" ? "selected" : ""?> value="Bramfelder SV">Bramfelder SV</option>
<option <?php echo $club=="Brunsbeker SV" ? "selected" : ""?> value="Brunsbeker SV">Brunsbeker SV</option>
<option <?php echo $club=="Buxtehuder SV von 1862 e.V." ? "selected" : ""?> value="Buxtehuder SV von 1862 e.V.">Buxtehuder SV von 1862 e.V.</option>
<option <?php echo $club=="Eimsbütteler TV" ? "selected" : ""?> value="Eimsbütteler TV">Eimsbütteler TV</option>
<option <?php echo $club=="Freie Sportvereinigung Harburg-Rönneburg" ? "selected" : ""?> value="Freie Sportvereinigung Harburg-Rönneburg">Freie Sportvereinigung Harburg-Rönneburg</option>
<option <?php echo $club=="Harburger TB" ? "selected" : ""?> value="Harburger TB">Harburger TB</option>
<option <?php echo $club=="HNT von 1911 e.V." ? "selected" : ""?> value="HNT von 1911 e.V.">HNT von 1911 e.V.</option>
<option <?php echo $club=="HT 16" ? "selected" : ""?> value="HT 16">HT 16</option>
<option <?php echo $club=="JC Taiyo" ? "selected" : ""?> value="JC Taiyo">JC Taiyo</option>
<option <?php echo $club=="JG Sachsenwald in der TSG Bergedorf von 1860 e.V." ? "selected" : ""?> value="JG Sachsenwald in der TSG Bergedorf von 1860 e.V.">JG Sachsenwald in der TSG Bergedorf von 1860 e.V.</option>
<option <?php echo $club=="Judo-Klub Elmshorn e.V." ? "selected" : ""?> value="Judo-Klub Elmshorn e.V.">Judo-Klub Elmshorn e.V.</option>
<option <?php echo $club=="KSC Bushido Hamburg e.V." ? "selected" : ""?> value="KSC Bushido Hamburg e.V.">KSC Bushido Hamburg e.V.</option>
<option <?php echo $club=="Kummerfelder SV e.V." ? "selected" : ""?> value="Kummerfelder SV e.V.">Kummerfelder SV e.V.</option>
<option <?php echo $club=="Lehmsaler Sportverein von 1967 e.V." ? "selected" : ""?> value="Lehmsaler Sportverein von 1967 e.V.">Lehmsaler Sportverein von 1967 e.V.</option>
<option <?php echo $club=="Meiendorfer SV" ? "selected" : ""?> value="Meiendorfer SV">Meiendorfer SV</option>
<option <?php echo $club=="Mümmelmannsberger SV von 1974 e.V." ? "selected" : ""?> value="Mümmelmannsberger SV von 1974 e.V.">Mümmelmannsberger SV von 1974 e.V.</option>
<option <?php echo $club=="Niendorfer TSV" ? "selected" : ""?> value="Niendorfer TSV">Niendorfer TSV</option>
<option <?php echo $club=="Oststeinbeker SV" ? "selected" : ""?> value="Oststeinbeker SV">Oststeinbeker SV</option>
<option <?php echo $club=="Rellinger TV" ? "selected" : ""?> value="Rellinger TV">Rellinger TV</option>
<option <?php echo $club=="Rissener SV v. 1949 e.V." ? "selected" : ""?> value="Rissener SV v. 1949 e.V.">Rissener SV v. 1949 e.V.</option>
<option <?php echo $club=="S.V. Blankenese v. 1903 e.V." ? "selected" : ""?> value="S.V. Blankenese v. 1903 e.V.">S.V. Blankenese v. 1903 e.V.</option>
<option <?php echo $club=="SC Alstertal- Langenhorn e.V." ? "selected" : ""?> value="SC Alstertal- Langenhorn e.V.">SC Alstertal- Langenhorn e.V.</option>
<option <?php echo $club=="SC Poppenbüttel" ? "selected" : ""?> value="SC Poppenbüttel">SC Poppenbüttel</option>
<option <?php echo $club=="SC Vier- und Marschlande von 1899 e.V." ? "selected" : ""?> value="SC Vier- und Marschlande von 1899 e.V.">SC Vier- und Marschlande von 1899 e.V.</option>
<option <?php echo $club=="Shin-Rin-Dojo im WSV Tangstedt v.1958 e.V." ? "selected" : ""?> value="Shin-Rin-Dojo im WSV Tangstedt v.1958 e.V.">Shin-Rin-Dojo im WSV Tangstedt v.1958 e.V.</option>
<option <?php echo $club=="Sportverein Grün-Weiß Eimsbüttel von 1901 e.V." ? "selected" : ""?> value="Sportverein Grün-Weiß Eimsbüttel von 1901 e.V.">Sportverein Grün-Weiß Eimsbüttel von 1901 e.V.</option>
<option <?php echo $club=="SpVg Blau-Weiß 96 Schenefeld e.V." ? "selected" : ""?> value="SpVg Blau-Weiß 96 Schenefeld e.V.">SpVg Blau-Weiß 96 Schenefeld e.V.</option>
<option <?php echo $club=="SV Polizei" ? "selected" : ""?> value="SV Polizei">SV Polizei</option>
<option <?php echo $club=="SV Wilhelmsburg" ? "selected" : ""?> value="SV Wilhelmsburg">SV Wilhelmsburg</option>
<option <?php echo $club=="TH Eilbeck" ? "selected" : ""?> value="TH Eilbeck">TH Eilbeck</option>
<option <?php echo $club=="TSC Wellingsbüttel von 1937 e.V." ? "selected" : ""?> value="TSC Wellingsbüttel von 1937 e.V.">TSC Wellingsbüttel von 1937 e.V.</option>
<option <?php echo $club=="TSV Hohenhorst v. 1963 e.V." ? "selected" : ""?> value="TSV Hohenhorst v. 1963 e.V.">TSV Hohenhorst v. 1963 e.V.</option>
<option <?php echo $club=="TSV Reinbek" ? "selected" : ""?> value="TSV Reinbek">TSV Reinbek</option>
<option <?php echo $club=="TSV Schwarzenbek von 1899 e.V." ? "selected" : ""?> value="TSV Schwarzenbek von 1899 e.V.">TSV Schwarzenbek von 1899 e.V.</option>
<option <?php echo $club=="TSV Stellingen v. 1888 e.V." ? "selected" : ""?> value="TSV Stellingen v. 1888 e.V.">TSV Stellingen v. 1888 e.V.</option>
<option <?php echo $club=="TSV Uetersen" ? "selected" : ""?> value="TSV Uetersen">TSV Uetersen</option>
<option <?php echo $club=="TSV Wedel" ? "selected" : ""?> value="TSV Wedel">TSV Wedel</option>
<option <?php echo $club=="TSV Gut Heil Heist von 1910 e.V." ? "selected" : ""?> value="TSV Gut Heil Heist von 1910 e.V.">TSV "Gut Heil" Heist von 1910 e.V.</option>
<option <?php echo $club=="TuRa Harksheide" ? "selected" : ""?> value="TuRa Harksheide">TuRa Harksheide</option>
<option <?php echo $club=="TuS Appen" ? "selected" : ""?> value="TuS Appen">TuS Appen</option>
<option <?php echo $club=="TuS Berne e.V." ? "selected" : ""?> value="TuS Berne e.V.">TuS Berne e.V.</option>
<option <?php echo $club=="TuS Esingen" ? "selected" : ""?> value="TuS Esingen">TuS Esingen</option>
<option <?php echo $club=="TuS Finkenwerder von 1893 e.V." ? "selected" : ""?> value="TuS Finkenwerder von 1893 e.V.">TuS Finkenwerder von 1893 e.V.</option>
<option <?php echo $club=="TuS Germania Schnelsen von 1921 e.V." ? "selected" : ""?> value="TuS Germania Schnelsen von 1921 e.V.">TuS Germania Schnelsen von 1921 e.V.</option>
<option <?php echo $club=="TuS Osdorf von 1907 e.V." ? "selected" : ""?> value="TuS Osdorf von 1907 e.V.">TuS Osdorf von 1907 e.V.</option>
<option <?php echo $club=="USC Paloma 1909 e.V." ? "selected" : ""?> value="USC Paloma 1909 e.V.">USC Paloma 1909 e.V.</option>
<option <?php echo $club=="VEJAS Hamburg e.V." ? "selected" : ""?> value="VEJAS Hamburg e.V.">VEJAS Hamburg e.V.</option>
<option <?php echo $club=="Verein Aktive Freizeit" ? "selected" : ""?> value="Verein Aktive Freizeit">Verein Aktive Freizeit</option>
<option <?php echo $club=="VfL 93 Hamburg e.V." ? "selected" : ""?> value="VfL 93 Hamburg e.V.">VfL 93 Hamburg e.V.</option>
<option <?php echo $club=="VfL Börnsen" ? "selected" : ""?> value="VfL Börnsen">VfL Börnsen</option>
<option <?php echo $club=="VfL Geesthacht v. 1885 e.V." ? "selected" : ""?> value="VfL Geesthacht v. 1885 e.V.">VfL Geesthacht v. 1885 e.V.</option>
<option <?php echo $club=="VfL Pinneberg e.V." ? "selected" : ""?> value="VfL Pinneberg e.V.">VfL Pinneberg e.V.</option>
<option <?php echo $club=="Walddörfer SV e.V. von 19241. FC Hellbrook" ? "selected" : ""?> value="Walddörfer SV e.V. von 19241. FC Hellbrook">Walddörfer SV e.V. von 19241. FC Hellbrook</option>
<option <?php echo $club=="Wandsbeker TSV Concordia1. SC Norderstedt" ? "selected" : ""?> value="Wandsbeker TSV Concordia1. SC Norderstedt">Wandsbeker TSV Concordia1. SC Norderstedt</option>
<option <?php echo $club=="Kein Mitglied im Hamburger Judo Verband" ? "selected" : ""?> value="Kein Mitglied im Hamburger Judo Verband">Kein Mitglied im Hamburger Judo Verband</option>
      </select></div>
      <div style="padding: .7em;"><input name="register" type="submit" value="Anmelden"></div>
    </form>
  </div>
  <h2>Bereits vorhandene Anmeldungen ansehen</h2>
  <div>
    <form action="index.php" method="post">
<?php
if (isset ($_POST['show'])) {
  echo "<html><body><table>";
  echo "<tr><td><strong>Vorname</strong></td><td><strong>Nachname</strong></td><td><strong>Geburtsjahr</strong></td><td><strong>Geschlecht</strong></td><td><strong>Verein</strong></td></tr>";
  $f = fopen("data.csv", "r");
  while (($line = fgetcsv($f)) !== false) {
    if ($line['4']==$club){
      echo "<tr>";
      foreach ($line as $cell) {
        echo "<td>" . $cell . "</td>";
      }
      echo "</tr>\n";}
  }
  fclose($f);
  echo "\n</table></body></html>";
}
?>
      <div style="padding: .7em;"><label for="input_club">Verein: </label>
      <select name="club" id="input_club">
<option value="">Bitte wählen sie ihren Verein</option>
<option <?php echo $club=="FC Hellbrook" ? "selected" : ""?> value="FC Hellbrook">FC Hellbrook</option>
<option <?php echo $club=="1. SC Norderstedt" ? "selected" : ""?> value="1. SC Norderstedt">1. SC Norderstedt</option>
<option <?php echo $club=="Alster- Dojo Kendo/Kyudo" ? "selected" : ""?> value="Alster- Dojo Kendo/Kyudo">Alster- Dojo Kendo/Kyudo</option>
<option <?php echo $club=="AMTV" ? "selected" : ""?> value="AMTV">AMTV</option>
<option <?php echo $club=="Barsbütteler SV v. 1948 e.V." ? "selected" : ""?> value="Barsbütteler SV v. 1948 e.V.">Barsbütteler SV v. 1948 e.V.</option>
<option <?php echo $club=="BKSV Goliath" ? "selected" : ""?> value="BKSV Goliath">BKSV Goliath</option>
<option <?php echo $club=="Bojutsu- Bushido" ? "selected" : ""?> value="Bojutsu- Bushido">Bojutsu- Bushido</option>
<option <?php echo $club=="Bramfelder SV" ? "selected" : ""?> value="Bramfelder SV">Bramfelder SV</option>
<option <?php echo $club=="Brunsbeker SV" ? "selected" : ""?> value="Brunsbeker SV">Brunsbeker SV</option>
<option <?php echo $club=="Buxtehuder SV von 1862 e.V." ? "selected" : ""?> value="Buxtehuder SV von 1862 e.V.">Buxtehuder SV von 1862 e.V.</option>
<option <?php echo $club=="Eimsbütteler TV" ? "selected" : ""?> value="Eimsbütteler TV">Eimsbütteler TV</option>
<option <?php echo $club=="Freie Sportvereinigung Harburg-Rönneburg" ? "selected" : ""?> value="Freie Sportvereinigung Harburg-Rönneburg">Freie Sportvereinigung Harburg-Rönneburg</option>
<option <?php echo $club=="Harburger TB" ? "selected" : ""?> value="Harburger TB">Harburger TB</option>
<option <?php echo $club=="HNT von 1911 e.V." ? "selected" : ""?> value="HNT von 1911 e.V.">HNT von 1911 e.V.</option>
<option <?php echo $club=="HT 16" ? "selected" : ""?> value="HT 16">HT 16</option>
<option <?php echo $club=="JC Taiyo" ? "selected" : ""?> value="JC Taiyo">JC Taiyo</option>
<option <?php echo $club=="JG Sachsenwald in der TSG Bergedorf von 1860 e.V." ? "selected" : ""?> value="JG Sachsenwald in der TSG Bergedorf von 1860 e.V.">JG Sachsenwald in der TSG Bergedorf von 1860 e.V.</option>
<option <?php echo $club=="Judo-Klub Elmshorn e.V." ? "selected" : ""?> value="Judo-Klub Elmshorn e.V.">Judo-Klub Elmshorn e.V.</option>
<option <?php echo $club=="KSC Bushido Hamburg e.V." ? "selected" : ""?> value="KSC Bushido Hamburg e.V.">KSC Bushido Hamburg e.V.</option>
<option <?php echo $club=="Kummerfelder SV e.V." ? "selected" : ""?> value="Kummerfelder SV e.V.">Kummerfelder SV e.V.</option>
<option <?php echo $club=="Lehmsaler Sportverein von 1967 e.V." ? "selected" : ""?> value="Lehmsaler Sportverein von 1967 e.V.">Lehmsaler Sportverein von 1967 e.V.</option>
<option <?php echo $club=="Meiendorfer SV" ? "selected" : ""?> value="Meiendorfer SV">Meiendorfer SV</option>
<option <?php echo $club=="Mümmelmannsberger SV von 1974 e.V." ? "selected" : ""?> value="Mümmelmannsberger SV von 1974 e.V.">Mümmelmannsberger SV von 1974 e.V.</option>
<option <?php echo $club=="Niendorfer TSV" ? "selected" : ""?> value="Niendorfer TSV">Niendorfer TSV</option>
<option <?php echo $club=="Oststeinbeker SV" ? "selected" : ""?> value="Oststeinbeker SV">Oststeinbeker SV</option>
<option <?php echo $club=="Rellinger TV" ? "selected" : ""?> value="Rellinger TV">Rellinger TV</option>
<option <?php echo $club=="Rissener SV v. 1949 e.V." ? "selected" : ""?> value="Rissener SV v. 1949 e.V.">Rissener SV v. 1949 e.V.</option>
<option <?php echo $club=="S.V. Blankenese v. 1903 e.V." ? "selected" : ""?> value="S.V. Blankenese v. 1903 e.V.">S.V. Blankenese v. 1903 e.V.</option>
<option <?php echo $club=="SC Alstertal- Langenhorn e.V." ? "selected" : ""?> value="SC Alstertal- Langenhorn e.V.">SC Alstertal- Langenhorn e.V.</option>
<option <?php echo $club=="SC Poppenbüttel" ? "selected" : ""?> value="SC Poppenbüttel">SC Poppenbüttel</option>
<option <?php echo $club=="SC Vier- und Marschlande von 1899 e.V." ? "selected" : ""?> value="SC Vier- und Marschlande von 1899 e.V.">SC Vier- und Marschlande von 1899 e.V.</option>
<option <?php echo $club=="Shin-Rin-Dojo im WSV Tangstedt v.1958 e.V." ? "selected" : ""?> value="Shin-Rin-Dojo im WSV Tangstedt v.1958 e.V.">Shin-Rin-Dojo im WSV Tangstedt v.1958 e.V.</option>
<option <?php echo $club=="Sportverein Grün-Weiß Eimsbüttel von 1901 e.V." ? "selected" : ""?> value="Sportverein Grün-Weiß Eimsbüttel von 1901 e.V.">Sportverein Grün-Weiß Eimsbüttel von 1901 e.V.</option>
<option <?php echo $club=="SpVg Blau-Weiß 96 Schenefeld e.V." ? "selected" : ""?> value="SpVg Blau-Weiß 96 Schenefeld e.V.">SpVg Blau-Weiß 96 Schenefeld e.V.</option>
<option <?php echo $club=="SV Polizei" ? "selected" : ""?> value="SV Polizei">SV Polizei</option>
<option <?php echo $club=="SV Wilhelmsburg" ? "selected" : ""?> value="SV Wilhelmsburg">SV Wilhelmsburg</option>
<option <?php echo $club=="TH Eilbeck" ? "selected" : ""?> value="TH Eilbeck">TH Eilbeck</option>
<option <?php echo $club=="TSC Wellingsbüttel von 1937 e.V." ? "selected" : ""?> value="TSC Wellingsbüttel von 1937 e.V.">TSC Wellingsbüttel von 1937 e.V.</option>
<option <?php echo $club=="TSV Hohenhorst v. 1963 e.V." ? "selected" : ""?> value="TSV Hohenhorst v. 1963 e.V.">TSV Hohenhorst v. 1963 e.V.</option>
<option <?php echo $club=="TSV Reinbek" ? "selected" : ""?> value="TSV Reinbek">TSV Reinbek</option>
<option <?php echo $club=="TSV Schwarzenbek von 1899 e.V." ? "selected" : ""?> value="TSV Schwarzenbek von 1899 e.V.">TSV Schwarzenbek von 1899 e.V.</option>
<option <?php echo $club=="TSV Stellingen v. 1888 e.V." ? "selected" : ""?> value="TSV Stellingen v. 1888 e.V.">TSV Stellingen v. 1888 e.V.</option>
<option <?php echo $club=="TSV Uetersen" ? "selected" : ""?> value="TSV Uetersen">TSV Uetersen</option>
<option <?php echo $club=="TSV Wedel" ? "selected" : ""?> value="TSV Wedel">TSV Wedel</option>
<option <?php echo $club=="TSV Gut Heil Heist von 1910 e.V." ? "selected" : ""?> value="TSV Gut Heil Heist von 1910 e.V.">TSV "Gut Heil" Heist von 1910 e.V.</option>
<option <?php echo $club=="TuRa Harksheide" ? "selected" : ""?> value="TuRa Harksheide">TuRa Harksheide</option>
<option <?php echo $club=="TuS Appen" ? "selected" : ""?> value="TuS Appen">TuS Appen</option>
<option <?php echo $club=="TuS Berne e.V." ? "selected" : ""?> value="TuS Berne e.V.">TuS Berne e.V.</option>
<option <?php echo $club=="TuS Esingen" ? "selected" : ""?> value="TuS Esingen">TuS Esingen</option>
<option <?php echo $club=="TuS Finkenwerder von 1893 e.V." ? "selected" : ""?> value="TuS Finkenwerder von 1893 e.V.">TuS Finkenwerder von 1893 e.V.</option>
<option <?php echo $club=="TuS Germania Schnelsen von 1921 e.V." ? "selected" : ""?> value="TuS Germania Schnelsen von 1921 e.V.">TuS Germania Schnelsen von 1921 e.V.</option>
<option <?php echo $club=="TuS Osdorf von 1907 e.V." ? "selected" : ""?> value="TuS Osdorf von 1907 e.V.">TuS Osdorf von 1907 e.V.</option>
<option <?php echo $club=="USC Paloma 1909 e.V." ? "selected" : ""?> value="USC Paloma 1909 e.V.">USC Paloma 1909 e.V.</option>
<option <?php echo $club=="VEJAS Hamburg e.V." ? "selected" : ""?> value="VEJAS Hamburg e.V.">VEJAS Hamburg e.V.</option>
<option <?php echo $club=="Verein Aktive Freizeit" ? "selected" : ""?> value="Verein Aktive Freizeit">Verein Aktive Freizeit</option>
<option <?php echo $club=="VfL 93 Hamburg e.V." ? "selected" : ""?> value="VfL 93 Hamburg e.V.">VfL 93 Hamburg e.V.</option>
<option <?php echo $club=="VfL Börnsen" ? "selected" : ""?> value="VfL Börnsen">VfL Börnsen</option>
<option <?php echo $club=="VfL Geesthacht v. 1885 e.V." ? "selected" : ""?> value="VfL Geesthacht v. 1885 e.V.">VfL Geesthacht v. 1885 e.V.</option>
<option <?php echo $club=="VfL Pinneberg e.V." ? "selected" : ""?> value="VfL Pinneberg e.V.">VfL Pinneberg e.V.</option>
<option <?php echo $club=="Walddörfer SV e.V. von 19241. FC Hellbrook" ? "selected" : ""?> value="Walddörfer SV e.V. von 19241. FC Hellbrook">Walddörfer SV e.V. von 19241. FC Hellbrook</option>
<option <?php echo $club=="Wandsbeker TSV Concordia1. SC Norderstedt" ? "selected" : ""?> value="Wandsbeker TSV Concordia1. SC Norderstedt">Wandsbeker TSV Concordia1. SC Norderstedt</option>
<option <?php echo $club=="Kein Mitglied im Hamburger Judo Verband" ? "selected" : ""?> value="Kein Mitglied im Hamburger Judo Verband">Kein Mitglied im Hamburger Judo Verband</option>
      </select></div>
      <div style="padding: .7em;"><input name="show" value="Anmeldungen Ansehen" type="submit"></div>
    </form>
    </div>
</div>
<script src="external/jquery/jquery.js"></script>
<script src="jquery-ui.js"></script>
<script>
$( "#accordion" ).accordion({heightStyle: "content"});
<?php
if (isset ($_POST['show'])) {
  echo "$(\"#accordion\").accordion('option', 'active' , 1);";
}
?>
$( "input:submit" ).button();
$('input:text, input:password')
  .button()
  .css({
          'font' : 'inherit',
         'color' : 'inherit',
    'text-align' : 'left',
       'outline' : 'none',
        'cursor' : 'text',
  });
$('select')
  .button()
  .css({
          'font' : 'inherit',
         'color' : 'inherit',
    'text-align' : 'left',
       'outline' : 'none',
  });
$( "#radioset" ).buttonset();
$( "#controlgroup" ).controlgroup();
$( "#input_yearOfBirth" ).spinner();
$( "#tooltip" ).tooltip();
// Hover states on the static widgets
$( "#dialog-link, #icons li" ).hover(
	function() {
		$( this ).addClass( "ui-state-hover" );
	},
	function() {
		$( this ).removeClass( "ui-state-hover" );
	}
);
</script></body>
</html>