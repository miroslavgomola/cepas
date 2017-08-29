<?php
$titul_stranky ='CEPAS';
include ('views/pages/zahlavie.inc');
?>
<head>
<?php
include ('views/pages/zahlavie2.inc')
?>
</head>
<link rel="stylesheet" href="/css/style.css">
<style>
  body    { padding-top:50px; }
</style>
<?php

if (isset($_POST['odoslat'])) {

  require_once('./mysql_pps.php');

  function odstranit_problemy ($data) {
    global $dbc;
    if  (ini_get('magic_quotes_gpc')) {
      $data = stripcslashes($data);
    }
    return mysql_real_escape_string($data, $dbc);
  }

  $sprava = NULL;


  $osobne = $_POST['osobne'];
  $skoda = $_POST['skoda'];
  $utvar_dopyt = $_POST['utvar_dopyt'];
  $dopyt_cislo = $_POST['dopyt_cislo'];
  $cislo_ps2 = $_POST['cislo_ps2'];
  $cislo_ps3 = $_POST['cislo_ps3'];
  $ps2 = $_POST['ps2'];
  $ps3 = $_POST['ps3'];
  $kl_ps2_cas = $_POST['kl_ps2_cas'];
  $kl_ps3_cas = $_POST['kl_ps3_cas'];
  $miesto_ps2 = $_POST['miesto_ps2'];
  $miesto_ps3 = $_POST['miesto_ps3'];
  $podmienky_ps2 = $_POST['podmienky_ps2'];
  $podmienky_ps3 = $_POST['podmienky_ps3'];
  $teplota_ps2 = $_POST['teplota_ps2'];
  $teplota_ps3 = $_POST['teplota_ps3'];
  $porozita_ps2 = $_POST['porozita_ps2'];
  $porozita_ps3 = $_POST['porozita_ps3'];
  $stupen = $_POST['stupen'];
  $rusive_vplyvy = $_POST['rusive_vplyvy'];

  if (empty($_POST['barcode'])) {
    $barcode = FALSE;
    $sprava .= '<p align=center>Zadajte čiarový kód!</p>';
  } else {
    $barcode = odstranit_problemy($_POST['barcode']);
  }


  if (empty($_POST['dat_zaistenia'])) {
    $dat_zaistenia = FALSE;
    $sprava .= '<p align=center>Zadajte dátum zaistenia!</p>';
  } else {
    $dat_zaistenia = odstranit_problemy($_POST['dat_zaistenia']);
  }


  if (empty($_POST['utvar'])) {
    $utvar = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať zaisťujúci útvar!</p>';
  } else {
    $utvar = odstranit_problemy($_POST['utvar']);
  }

  if (empty($_POST['cvs'])) {
    $cvs = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať registratúrne číslo prípadu!</p>';
  } else {
    $cvs = odstranit_problemy($_POST['cvs']);
  }

  if (empty($_POST['trieda'])) {
    $trieda = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať zločineckú triedu!</p>';
  } else {
    $trieda = odstranit_problemy($_POST['trieda']);
  }

  if (empty($_POST['cislo_ps1'])) {
    $cislo_ps1 = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať číslo pachovej stopy!</p>';
  } else {
    $cislo_ps1 = odstranit_problemy($_POST['cislo_ps1']);
  }

  if (empty($_POST['ps1'])) {
    $ps1 = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať pachovú stopu!</p>';
  } else {
    $ps1 = odstranit_problemy($_POST['ps1']);
  }

  if (empty($_POST['porozita_ps1'])) {
    $porozita_ps1 = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať porozitu stopy!</p>';
  } else {
    $porozita_ps1 = odstranit_problemy($_POST['porozita_ps1']);
  }

  if (empty($_POST['kl_ps1_cas'])) {
    $kl_ps1_cas = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať časový úsek zaistenia stopy!</p>';
  } else {
    $kl_ps1_cas = odstranit_problemy($_POST['kl_ps1_cas']);
  }

  if (empty($_POST['miesto_ps1'])) {
    $miesto_ps1 = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať miesto zaistenia!</p>';
  } else {
    $miesto_ps1 = odstranit_problemy($_POST['miesto_ps1']);
  }

  if (empty($_POST['podmienky_ps1'])) {
    $podmienky_ps1 = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať poveternostné podmienky!</p>';
  } else {
    $podmienky_ps1 = odstranit_problemy($_POST['podmienky_ps1']);
  }

  if (empty($_POST['teplota_ps1'])) {
    $teplota_ps1 = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať teplotu!</p>';
  } else {
    $teplota_ps1 = odstranit_problemy($_POST['teplota_ps1']);
  }

  if (empty($_POST['popis'])) {
    $popis = FALSE;
    $sprava .= '<p align=center>Zadajte stručný popis prípadu!</p>';
  } else {
    $popis = odstranit_problemy($_POST['popis']);
  }

  if (empty($_POST['zaistil_ps'])) {
    $zaistil_ps = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať meno osoby, ktorá stopu eviduje!</p>';
  } else {
    $zaistil_ps = odstranit_problemy($_POST['zaistil_ps']);
  }

  if (empty($_POST['kurier'])) {
    $kurier = FALSE;
    $sprava .= '<p align=center>Zabudli označiť kuriéra!</p>';
  } else {
    $kurier = odstranit_problemy($_POST['kurier']);
  }

  if (empty($_POST['vazba'])) {
    $vazba = FALSE;
    $sprava .= '<p align-center>Zabudli ste vyplniť väzbu!</p>';
  } else {
    $vazba = odstranit_problemy($_POST['vazba']);
  }

if ($dat_zaistenia && $utvar && $cvs && $trieda  && $kurier OR $osobne && $vazba && $skoda && $utvar_dopyt && $dopyt_cislo
  && $rusive_vplyvy && $stupen && $popis && $barcode && $zaistil_ps
  && $cislo_ps1 && $ps1 && $porozita_ps1 && $kl_ps1_cas && $miesto_ps1 && $podmienky_ps1 && $teplota_ps1
  OR $cislo_ps2 OR $ps2 OR $porozita_ps2 OR $kl_ps2_cas OR $miesto_ps2 OR $podmienky_ps2 OR $teplota_ps2
  OR $cislo_ps3 OR $ps3 OR $porozita_ps3 OR $kl_ps3_cas OR $miesto_ps3 OR $podmienky_ps3 OR $teplota_ps3) { /// <- to je pre päť stôp

  $dotaz ="INSERT INTO ps (barcode, dat_zaistenia, utvar, cvs, trieda, ps1, kl_ps1_cas, miesto_ps1, podmienky_ps1, teplota_ps1,
  rusive_vplyvy, popis, zaistil_ps, kurier, osobne, skoda, utvar_dopyt, dopyt_cislo, porozita_ps1, stupen, vazba, cislo_ps1, cislo_ps2, ps2,
  porozita_ps2, kl_ps2_cas, miesto_ps2, podmienky_ps2, teplota_ps2, cislo_ps3, ps3, porozita_ps3, kl_ps3_cas, miesto_ps3, podmienky_ps3, teplota_ps3)
  VALUES ('$barcode', '$dat_zaistenia', '$utvar', '$cvs', '$trieda', '$ps1', '$kl_ps1_cas', '$miesto_ps1', '$podmienky_ps1', '$teplota_ps1',
  '$rusive_vplyvy', '$popis', '$zaistil_ps', '$kurier', '$osobne', '$skoda', '$utvar_dopyt', '$dopyt_cislo', '$porozita_ps1', '$stupen', '$vazba', '$cislo_ps1',
  '$cislo_ps2', '$ps2', '$porozita_ps2', '$kl_ps2_cas', '$miesto_ps2', '$podmienky_ps2', '$teplota_ps2', '$cislo_ps3', '$ps3', '$porozita_ps3', '$kl_ps3_cas',
  '$miesto_ps3', '$podmienky_ps3', '$teplota_ps3')";
  $výsledok = @mysql_query ($dotaz);
}

if ($výsledok) {

echo '<p align=center><b>ÚSPEŠNE STE NAHRALI PRÍPAD!</b></p>';
include ('views/pages/pata.inc');
exit();

mysql_close();

} else {
  $sprava .= '<p align=center>Skúste to prosím opäť.</p>';
}

if (isset($sprava)) {
  echo '<font color="red">', $sprava, '</font>';
}
}

?>
<html>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <fieldset style="height:auto;width:1000px;border:thin solid forestgreen; border-radius:5px;" class="fieldset">
  <body>
    <main>
    <h3>EVIDENČNÁ KARTA<br>
    METÓDY PACHOVEJ IDENTIFIKÁCIE</h3>
  </main><br><br>

    <div style="height:30px;font-size:14pt;">Dátum zaistenia PS:&nbsp<input class="datetime" style="height:30px;font-size:14pt;" type="datetime-local" name="dat_zaistenia"
    value="<?php if (isset($_POST['dat_zaistenia'])) echo $_POST['dat_zaistenia']; ?>"/></div></p><br>
    <div style="height:30px;font-size:14pt;">Spôsob doručenia PS na pracovisko MPI:</div>
    <div style="height:30px;font-size:14pt;">KURIER<select class="frame" style="height:30px;font-size:14pt;" name="kurier" value="<?php if (isset($_POST['kurier'])) echo $_POST['kurier']; ?>"/><br>
      <option></option>
      <option>ÁNO</option>
      <option>NIE</option></select>
    Osobne - kto:&nbsp<input type="text"  class="frame" style="height:30px;font-size:14pt;" name="osobne" value="<?php if (isset($_POST['osobne'])) echo $_POST['osobne']; ?>">
    VAZBA**&nbsp<select class="frame" style="height:30px;font-size:14pt;" name="vazba" value="<?php if (isset($_POST['vazba'])) echo $_POST['vazba']; ?>"/>
      <option></option>
      <option>ÁNO</option>
      <option>NIE</option></select>
    Výška škody:&nbsp<input class="frame" style="height:30px;font-size:14pt;" type="text" name="skoda" value="<?php if (isset($_POST['skoda'])) echo $_POST['skoda']; ?>">&nbsp€</div><br><p></p>
    <div style="height:30px;font-size:14pt;">Útvar PZ ktorý PS zaistil:&nbsp<input type="text" style="height:30px;font-size:14pt;" name="utvar" class="frame"
    value="<?php if (isset($_POST['utvar'])) echo $_POST['utvar']; ?>">
    ČVS:&nbsp<input type="text" style="height:30px;font-size:14pt;" name="cvs" class="frame" value="<?php if (isset($_POST['cvs'])) echo $_POST['cvs']; ?>">
    Zločinecká trieda:**<select class="frame" style="height:30px;font-size:14pt;" name="trieda" value="<?php if (isset($_POST['trieda'])) echo $_POST['trieda']; ?>"/><br>
      <option></option>
      <option>A1</option>
      <option>A2</option>
      <option>B1</option>
      <option>D1</option>
      <option>D2</option>
      <option>D7</option>
      <option>INÁ</option></select></div></p><br>
    <div style="height:30px;font-size:14pt;">Výsledok porovania zaslať útvaru:&nbsp<input type="text"  class="frame" style="height:30px;font-size:14pt;" name="utvar_dopyt"
      value="<?php if (isset($_POST['utvar_dopyt'])) echo $_POST['utvar_dopyt']; ?>">&nbsp
      k číslu:&nbsp<input type="text"  class="frame" style="height:30px;font-size:14pt;" name="dopyt_cislo" value="<?php if (isset($_POST['dopyt_cislo'])) echo $_POST['dopyt_cislo']; ?>">
    </div><br><br>
    <div style="font-size:14pt;"><fieldset class="frame">
    Číslo PS:&nbsp<input type="text"  class="frame" style="height:30px;width:30px;font-size:14pt;" name="cislo_ps1" value="<?php if (isset($_POST['cislo_ps1'])) echo $_POST['cislo_ps1']; ?>">
    Miesto zaistenia PS:&nbsp<input type="text"  class="frame" style="height:30px;width:400px;font-size:14pt;" name="ps1" value="<?php if (isset($_POST['ps1'])) echo $_POST['ps1']; ?>">&nbsp
    Absorbent PORÓZNY:&nbsp<select class="frame" style="height:30px;font-size:14pt;" name="porozita_ps1" value="<?php if (isset($_POST['porozita_ps1'])) echo $_POST['porozita_ps1']; ?>"/><br>
      <option></option>
      <option>ÁNO</option>
      <option>NIE</option></select><p style="font-size:12pt;">
    Časový úsek po zaistenie PS:&nbsp<select class="frame" style="height:30px;font-size:12pt;" name="kl_ps1_cas" value="<?php if (isset($_POST['kl_ps1_cas'])) echo $_POST['kl_ps1_cas']; ?>"/>
      <option></option>
      <option>Do 24 hod.</option>
      <option>Do 48 hod.</option>
      <option>Nad 48 hod.</option></select>
    Miesto zaistenia:&nbsp<select class="frame" style="height:30px;font-size:12pt;" name="miesto_ps1" value="<?php if (isset($_POST['miesto_ps1'])) echo $_POST['miesto_ps1']; ?>"/>
      <option></option>
      <option>Interér</option>
      <option>Exteriér</option></select>
    Poveternostné podmienky:&nbsp<select class="frame" style="height:30px;font-size:12pt;" name="podmienky_ps1" value="<?php if (isset($_POST['podmienky_ps1'])) echo $_POST['podmienky_ps1']; ?>"/>
      <option></option>
      <option>Chladno</option>
      <option>Sucho</option>
      <option>Dážď</option></select>
    Teplota:&nbsp<input type="text" class="frame" style="height:30px;width:30px;font-size:12pt;" name="teplota_ps1" value="<?php if (isset($_POST['teplota_ps1'])) echo $_POST['teplota_ps1']; ?>">
    &nbsp°C</fieldset></div>

    <div style="font-size:14pt;"><fieldset class="frame">
    Číslo PS:&nbsp<input type="text"  class="frame" style="height:30px;width:30px;font-size:14pt;" name="cislo_ps2" value="<?php if (isset($_POST['cislo_ps2'])) echo $_POST['cislo_ps2']; ?>">
    Miesto zaistenia PS:&nbsp<input type="text"  class="frame" style="height:30px;width:400px;font-size:14pt;" name="ps2" value="<?php if (isset($_POST['ps2'])) echo $_POST['ps2']; ?>">&nbsp
    Absorbent PORÓZNY:&nbsp<select class="frame" style="height:30px;font-size:14pt;" name="porozita_ps2" value="<?php if (isset($_POST['porozita_ps2'])) echo $_POST['porozita_ps2']; ?>"/><br>
      <option></option>
      <option>ÁNO</option>
      <option>NIE</option></select><p style="font-size:12pt;">
    Časový úsek po zaistenie PS:&nbsp<select class="frame" style="height:30px;font-size:12pt;" name="kl_ps2_cas" value="<?php if (isset($_POST['kl_ps2_cas'])) echo $_POST['kl_ps2_cas']; ?>"/>
      <option></option>
      <option>Do 24 hod.</option>
      <option>Do 48 hod.</option>
      <option>Nad 48 hod.</option></select>
    Miesto zaistenia:&nbsp<select class="frame" style="height:30px;font-size:12pt;" name="miesto_ps2" value="<?php if (isset($_POST['miesto_ps2'])) echo $_POST['miesto_ps2']; ?>"/>
      <option></option>
      <option>Interér</option>
      <option>Exteriér</option></select>
    Poveternostné podmienky:&nbsp<select class="frame" style="height:30px;font-size:12pt;" name="podmienky_ps2" value="<?php if (isset($_POST['podmienky_ps2'])) echo $_POST['podmienky_ps2']; ?>"/>
      <option></option>
      <option>Chladno</option>
      <option>Sucho</option>
      <option>Dážď</option></select>
    Teplota:&nbsp<input type="text" class="frame" style="height:30px;width:30px;font-size:12pt;" name="teplota_ps2" value="<?php if (isset($_POST['teplota_ps2'])) echo $_POST['teplota_ps2']; ?>">
    &nbsp°C</fieldset></div>

    <div style="font-size:14pt;"><fieldset class="frame">
    Číslo PS:&nbsp<input type="text"  class="frame" style="height:30px;width:30px;font-size:14pt;" name="cislo_ps3" value="<?php if (isset($_POST['cislo_ps3'])) echo $_POST['cislo_ps3']; ?>">
    Miesto zaistenia PS:&nbsp<input type="text"  class="frame" style="height:30px;width:400px;font-size:14pt;" name="ps3" value="<?php if (isset($_POST['ps3'])) echo $_POST['ps3']; ?>">&nbsp
    Absorbent PORÓZNY:&nbsp<select class="frame" style="height:30px;font-size:14pt;" name="porozita_ps3" value="<?php if (isset($_POST['porozita_ps3'])) echo $_POST['porozita_ps3']; ?>"/><br>
      <option></option>
      <option>ÁNO</option>
      <option>NIE</option></select><p style="font-size:12pt;">
    Časový úsek po zaistenie PS:&nbsp<select class="frame" style="height:30px;font-size:12pt;" name="kl_ps3_cas" value="<?php if (isset($_POST['kl_ps3_cas'])) echo $_POST['kl_ps3_cas']; ?>"/>
      <option></option>
      <option>Do 24 hod.</option>
      <option>Do 48 hod.</option>
      <option>Nad 48 hod.</option></select>
    Miesto zaistenia:&nbsp<select class="frame" style="height:30px;font-size:12pt;" name="miesto_ps3" value="<?php if (isset($_POST['miesto_ps3'])) echo $_POST['miesto_ps3']; ?>"/>
      <option></option>
      <option>Interér</option>
      <option>Exteriér</option></select>
    Poveternostné podmienky:&nbsp<select class="frame" style="height:30px;font-size:12pt;" name="podmienky_ps3" value="<?php if (isset($_POST['podmienky_ps3'])) echo $_POST['podmienky_ps3']; ?>"/>
      <option></option>
      <option>Chladno</option>
      <option>Sucho</option>
      <option>Dážď</option></select>
    Teplota:&nbsp<input type="text" class="frame" style="height:30px;width:30px;font-size:12pt;" name="teplota_ps3" value="<?php if (isset($_POST['teplota_ps3'])) echo $_POST['teplota_ps3']; ?>">
    &nbsp°C</fieldset></div><br>
    <div style="font-size:14pt;">Priradenie čiarového kódu:&nbsp<input type="text" class="frame" name="barcode" style="height:30px;font-size:14pt;"
      value="<?php if (isset($_POST['barcode'])) echo $_POST['barcode']; ?>">&nbsp
    PS zaistil kriminalistický technik:&nbsp<input type="text" class="frame" name="zaistil_ps" style="height:30px;font-size:14pt;"
      value="<?php if (isset($_POST['zaistil_ps'])) echo $_POST['zaistil_ps']; ?>"></div>
    </fieldset><br>

    <div align="center"><input style="height:30px;font-size:14pt;cursor:pointer;" class="btn2" type="submit" name="odoslat"
          value="Odoslať" /></div><br><br>
    </form>
    </body>
</html>
