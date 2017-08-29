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

  $sprava = NULL;

  $barcode = $_POST['barcode'];
  $me = $_POST['meno'];
  $pr = $_POST['priezvisko'];
  $rc = $_POST['rod_cislo'];
  $d_nar = $_POST['dat_narodenia'];



  if ($barcode OR $d_nar OR $me && $pr OR $rc) {
    require_once('./mysql_pps.php');

    $dotaz = "SELECT cislo, rok, meno, priezvisko, rod_priezvisko, DATE_FORMAT(dat_narodenia, '%d. %m. %Y') AS dat_narodenia, rod_cislo, bydlisko,
    DATE_FORMAT(dat_odberu, '%d. %m. %Y %H:%i') AS dat_odberu, DATE_FORMAT(dat_prebratia, '%d. %m. %Y %H:%i') AS dat_prebratia, utvar, utvar_dopyt, miesto, pps_odobral,
    osoby_pri, odber FROM pps WHERE barcode LIKE '$barcode' OR meno LIKE '$me' AND priezvisko LIKE '$pr' OR rod_cislo LIKE '$rc'
    OR dat_narodenia LIKE '$d_nar'";
    $výsledok = mysql_query ($dotaz);

    if ($výsledok) {

      while ($riadok = mysql_fetch_array($výsledok, MYSQL_NUM)) {

        echo "<br><br><table class=\"frame\" style=\"font-size:16pt;\" cellspacing=\"10\" cellpadding=\"2\">
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Číslo PPS</b></td>
        <th style=\"font-weight:bold;font-size:25pt;color:blue;\" align=\"left\">$riadok[0]/$riadok[1]</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Meno</b></td>
        <th style=\"font-size:25pt;color:red;\" align=\"left\">$riadok[2]</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Priezvisko</b></td>
        <th style=\"font-size:25pt;color:red;text-transform:uppercase\" align=\"left\">$riadok[3]</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Rodné priezvisko</b></td>
        <th align=\"left\">$riadok[4]</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Dátum narodenia</b></td>
        <th align=\"left\">$riadok[5]</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Rod. číslo</b></td>
        <th align=\"left\">$riadok[6]</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Bydlisko</b></td>
        <th align=\"left\">$riadok[7]</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Dátum odberu</b></td>
        <th align=\"left\">$riadok[8]<style=\"%d. %m %Y\"></th>
        <th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Dátum prebratia</b></td>
        <th align=\"left\">$riadok[9]</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Útvar, ktorý žiadal</b></td>
        <th align=\"left\">$riadok[10]</th>
        <th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Útvar, ktorý zaistil</b></td>
        <th align=\"left\">$riadok[11]</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Miesto odberu</b></td>
        <th align=\"left\">$riadok[12]</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>PPS odobral</b></td>
        <th align=\"left\">$riadok[13]</th>
        <th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Prítomné osoby</b></td>
        <th align=\"left\">$riadok[14]</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Odber z</b></td>
        <th align=\"left\">$riadok[15]</th></tr>\n";
      }

      $dotaz = "SELECT cislo, rok FROM pps ORDER BY cislo DESC LIMIT 1";
      $výsledok = mysql_query ($dotaz);

      while ($riadok = mysql_fetch_array($výsledok, MYSQL_NUM)) {

      echo "<table style=\"font-size:14pt;width:1133px;border:thin solid forestgreen;\" cellspacing=\"0\" cellpadding=\"2\">
      <tr><td align=\"center\" style=\"font-size:14pt;border-radius:10px;color:white;background-color:red;width:200px\"><b>Posledné použité číslo pre záznam bolo</b></td>
      <th align=\"left\" style=\"font-size:26pt;color:red;;\">$riadok[0]/$riadok[1]</td></th></tr></table>\n";
      }


    echo '</table>';
    mysql_free_result ($výsledok);


    if ($výsledok) {
      echo '<div align="center"><button style="height:45px;cursor:pointer;" size="30" maxlength="40" class="btn2" type="submit" name="Edit" value=""/>
      <a href="./cislo_pps.php">Priradiť</button></p>';

        include ('views/pages/pata.inc');
        exit();
      }

  } else {
    $sprava .= '<p align=center>Vyhľadávanie prerušené kvôli systémovej chybe. Ospravedlňujeme sa!</p>
    <p>'. mysql_error().'</p>';
  }

  mysql_close();

} else {
  $sprava .= '<p align=center>Skúste to prosím opäť.</p>';
}
}
if (isset($sprava)) {
  echo '<font color="red">', $sprava, '</font>';
}


?>

<br><br>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset style="height:250px;width:400px;border-radius:5px;border:thin solid forestgreen;" class="fieldset">
  <legend><h3 style="color:forestgreen;text-transform:uppercase">Zadajte parametre vyhľadávania:</h3></legend><br>
  <table align="center"><tr><td align="left">Podľa čiarového kódu:&nbsp</td><td  align="left"><input type="text" class="frame" name="barcode" size="20" maxlength="40"
    style="height:30px;font-size:14pt;" value="<?php if (isset($_POST['barcode'])) echo $_POST['barcode']; ?>"/></td></tr>
  <tr><td align="left">Meno:&nbsp</td><td  align="left"><input type="text" class="frame" name="meno" size="20" maxlength="40" style="height:30px;font-size:14pt;"
    value="<?php if (isset($_POST['meno'])) echo $_POST['meno']; ?>"/></td></tr>
  <tr><td align="left">Priezvisko:&nbsp</td><td  align="left"><input type="text" class="frame" name="priezvisko" size="20" maxlength="40" style="height:30px;font-size:14pt;"
    value="<?php if (isset($_POST['priezvisko'])) echo $_POST['priezvisko']; ?>"/></td></tr>
  <tr><td  align="left">Dátum narodenia:&nbsp</td><td align="left"><input type="date" class="frame" name="dat_narodenia" size="30" maxlength="40" style="height:30px;font-size:14pt;"
    value="<?php if (isset($_POST['dat_narodenia'])) echo $_POST['dat_narodenia']; ?>"/></td></tr>
  <tr><td align="left">Rodné číslo:&nbsp</td><td align="left"><input type="text" class="frame" name="rod_cislo" size="20" maxlength="40" style="height:30px;font-size:14pt;"
    value="<?php if (isset($_POST['rod_cislo'])) echo $_POST['rod_cislo']; ?>"/></td></tr></table>
</fieldset>
<div align="center"><input style="height:45px;cursor:pointer;" class="btn2" type="submit" name="odoslat"
  value="Hľadať" /></div>
</form>
<?php

?>
