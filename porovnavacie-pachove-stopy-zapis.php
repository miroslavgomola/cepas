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

  if (empty($_POST['barcode'])) {
    $barcode = FALSE;
    $sprava .= '<p align=center>Zadajte čiarový kód!</p>';
  } else {
    $barcode = odstranit_problemy($_POST['barcode']);
  }


  if (empty($_POST['dat_odberu'])) {
    $dat_odberu = FALSE;
    $sprava .= '<p align=center>Zadajte dátum odberu!</p>';
  } else {
    $dat_odberu = odstranit_problemy($_POST['dat_odberu']);
  }


  if (empty($_POST['priezvisko'])) {
    $pr = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať priezvisko osoby!</p>';
  } else {
    $pr = odstranit_problemy($_POST['priezvisko']);
  }

  if (empty($_POST['meno'])) {
    $me = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať meno osoby!</p>';
  } else {
    $me = odstranit_problemy($_POST['meno']);
  }

  if (empty($_POST['rod_priezvisko'])) {
    $rod_pr = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať rodné priezvisko osoby!</p>';
  } else {
    $rod_pr = odstranit_problemy($_POST['rod_priezvisko']);
  }

  if (empty($_POST['dat_narodenia'])) {
    $d_nar = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať dátum narodenia osoby!</p>';
  } else {
    $d_nar = odstranit_problemy($_POST['dat_narodenia']);
  }

  if (empty($_POST['rod_cislo'])) {
    $rc = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať rodné číslo osoby!</p>';
  } else {
    $rc = odstranit_problemy($_POST['rod_cislo']);
  }

  if (empty($_POST['bydlisko'])) {
    $byd = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať adresu osoby!</p>';
  } else {
    $byd = odstranit_problemy($_POST['bydlisko']);
  }

  if (empty($_POST['utvar_dopyt'])) {
    $u_dopyt = FALSE;
    $sprava .= '<p align=center>Zadajte dopytujúci útvar!</p>';
  } else {
    $u_dopyt = odstranit_problemy($_POST['utvar_dopyt']);
  }

  if (empty($_POST['utvar'])) {
    $u = FALSE;
    $sprava .= '<p align=center>Zabudli ste útvar!</p>';
  } else {
    $u = odstranit_problemy($_POST['utvar']);
  }

  if (empty($_POST['miesto'])) {
    $miesto = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať miesto odberu!</p>';
  } else {
    $miesto = odstranit_problemy($_POST['miesto']);
  }

  if (empty($_POST['pps_odobral'])) {
    $pps_odo = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať meno osoby, ktorá vykonala odber!</p>';
  } else {
    $pps_odo = odstranit_problemy($_POST['pps_odobral']);
  }

  if (empty($_POST['osoby_pri'])) {
    $oso_pri = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať meno prítomných osôb!</p>';
  } else {
    $oso_pri = odstranit_problemy($_POST['osoby_pri']);
  }

  if (empty($_POST['odber'])) {
    $odber = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať miesto odberu z tela!</p>';
  } else {
    $odber = odstranit_problemy($_POST['odber']);
  }

  if ($barcode && $dat_odberu && $pr && $me && $rod_pr && $d_nar
    && $rc && $byd && $u_dopyt && $u && $miesto && $pps_odo && $oso_pri && $odber) {

    $dotaz = "INSERT INTO pps (barcode, dat_odberu, priezvisko, meno,
    rod_priezvisko, dat_narodenia, rod_cislo, bydlisko, utvar_dopyt, utvar, miesto,
    pps_odobral, osoby_pri, odber)
    VALUES ('$barcode', '$dat_odberu', '$pr', '$me', '$rod_pr',
    '$d_nar', '$rc', '$byd', '$u_dopyt', '$u', '$miesto', '$pps_odo', '$oso_pri', '$odber')";
    $výsledok = @mysql_query ($dotaz);
    if ($výsledok) {

    echo '<p align=center><b>ÚSPEŠNE STE NAHRALI OSOBU!</b></p>';
    include ('views/pages/pata.inc');
    exit();

  } else {
    $sprava .= '<p align=center>Prerušené kvôli systémovej chybe. Ospravedlňujeme sa!</p>
    <p>'. mysql_error().'</p>';
  }

  mysql_close();

} else {
  $sprava .= '<p align=center>Skúste to prosím opäť.</p>';
}

if (isset($sprava)) {
  echo '<font color="red">', $sprava, '</font>';
}
}
?>
<br>
<br>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <fieldset style="height:630px;width:900px;align:center;border-radius:5px;border:thin solid forestgreen;" class="fieldset">
    <legend><h3>Odber porovnávacej pachovej stopy v zmysle § 155 Trestného poriadku<br>
    Odber porovnávacej pachovej stopy v zmysle § 20 zák. 171/1993 Z. z. o PZ</h3></legend><br>
    <table cellspacing="0" cellpadding="0">
      <tr><p><b style="text-transform:uppercase">
          Čiarový kód:&nbsp<input class="frame" style="height:30px;font-size:14pt;" type="text" name="barcode" size="10" maxlength="10"
            value="<?php if (isset($_POST['barcode'])) echo $_POST['barcode']; ?>"/>
          Dátum odberu PPS:&nbsp<input class="datetime" style="height:30px;font-size:14pt;" type="datetime-local" name="dat_odberu"
            value="<?php if (isset($_POST['dat_odberu'])) echo $_POST['dat_odberu']; ?>"/></tr></b></p></table><p>
    <table align="center" style="text-transform:uppercase">
      <tr><td align="left">Priezvisko:&nbsp</td><td><input class="frame" style="height:30px;font-size:14pt;" type="text" name="priezvisko"
            value="<?php if (isset($_POST['priezvisko'])) echo $_POST['priezvisko']; ?>"/></td><tr><p>
      <tr><td align="left">Rodné priezvisko:&nbsp</td><td><input class="frame" style="height:30px;font-size:14pt;" type="text" name="rod_priezvisko"
            value="<?php if (isset($_POST['rod_priezvisko'])) echo $_POST['rod_priezvisko']; ?>"/></td></tr>
      <tr><td align="left">Meno:&nbsp</td><td align="left"><input class="frame" style="height:30px;font-size:14pt;" type="text" name="meno"
            value="<?php if (isset($_POST['meno'])) echo $_POST['meno']; ?>"/></td></tr></table><p>
    <table>
      <tr><b style="text-transform:uppercase">
            Dátum narodenia:&nbsp<input class="frame" style="height:30px;font-size:14pt;" class="date" type="date" name="dat_narodenia"
            value="<?php if (isset($_POST['dat_narodenia'])) echo $_POST['dat_narodenia']; ?>"/>
            Rodné číslo:&nbsp<input class="frame" style="height:30px;font-size:14pt;" type="text" name="rod_cislo"
            value="<?php if (isset($_POST['rod_cislo'])) echo $_POST['rod_cislo']; ?>"/></b></tr></table><br>
    <table align="center" style="text-transform:uppercase">
      <tr><td align="left">Bydlisko:&nbsp</td><td align="left"><input class="frame" style="height:30px;width:300px;font-size:14pt;" type="text" name="bydlisko"
            value="<?php if (isset($_POST['bydlisko'])) echo $_POST['bydlisko']; ?>"/></td></tr>
      <tr><td align="left">Útvar, ktorý žiada o odber porovnávacej pachovej stopy:&nbsp</td><td align="left"><input class="frame" style="height:30px;font-size:14pt;" type="text" name="utvar_dopyt"
            value="<?php if (isset($_POST['utvar_dopyt'])) echo $_POST['utvar_dopyt']; ?>"/></td></tr>
      <tr><td align="left">Útvar, kde sa odber vykonal:&nbsp</td><td align="left"><input class="frame" style="height:30px;font-size:14pt;" type="text" name="utvar"
            value="<?php if (isset($_POST['utvar'])) echo $_POST['utvar']; ?>"/></td></tr>
      <tr><td align="left">Miestnosť, kde sa odber PPS vykonal:&nbsp</td><td align="left"><input class="frame" style="height:30px;font-size:14pt;" type="text" name="miesto"
            value="<?php if (isset($_POST['miesto'])) echo $_POST['miesto']; ?>"/></td></tr>
      <tr><td align="left">PPS odobral:&nbsp</td><td align="left"><input class="frame" style="height:30px;font-size:14pt;" type="text" name="pps_odobral"
            value="<?php if (isset($_POST['pps_odobral'])) echo $_POST['pps_odobral']; ?>"/></td></tr>
      <tr><td align="left">Všetky prítomné osoby pri odbere PPS:&nbsp</td><td align="left"><input class="frame" style="height:30px;font-size:14pt;" type="text" name="osoby_pri"
            value="<?php if (isset($_POST['osoby_pri'])) echo $_POST['osoby_pri']; ?>"/></td></tr>
      <tr><td align="left">Odber vykonaný z:&nbsp</td><td align="left"><select class="frame" style="height:30px;font-size:14pt;" name="odber"
            value="<?php if (isset($_POST['odber'])) echo $_POST['odber']; ?>"/><br>
            <option></option>
            <option>bokov nad bedrovou časťou tela na dva snímače</option>
            <option>boku nad bedrovou časťou tela na jeden snímač</option>
            <option>z iného miesta</option></td></tr></table><br>
  </fieldset>
  <div align="center"><input style="height:30px;font-size:14pt;cursor:pointer" class="btn2" type="submit" name="odoslat"
      value="Odoslať" /></div><br><br>
<?php
?>
