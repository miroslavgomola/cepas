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

  $me = $_POST['meno'];
  $pr = $_POST['priezvisko'];
  $rc = $_POST['rod_cislo'];
  $d_nar = $_POST['dat_narodenia'];
  $odber = $_POST['odber'];

  if ($me OR $pr OR $rc OR $d_nar OR $odber) {
    require_once('./mysql_pps.php');

    $dotaz = "SELECT cislo, rok, meno, priezvisko, rod_priezvisko, DATE_FORMAT(dat_narodenia, '%d. %m. %Y') AS dat_narodenia, rod_cislo, bydlisko,
    DATE_FORMAT(dat_odberu, '%d. %m. %Y') AS dat_odberu, DATE_FORMAT(dat_prebratia, '%d. %m. %Y') AS dat_prebratia, utvar, utvar_dopyt, miesto, pps_odobral,
    osoby_pri, odber, id_pps FROM pps WHERE  meno LIKE '$me' OR priezvisko LIKE '$pr' OR rod_cislo LIKE '$rc'
    OR dat_narodenia LIKE '$d_nar' OR odber LIKE '$odber'";
    $výsledok = mysql_query ($dotaz);

    if ($výsledok) {

      echo '<br><br><table align="center" class="frame" style="font-size:12pt;" cellspacing="10" cellpadding="2">
      <tr><td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Číslo PPS</b></td>
      <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Meno</b></td>
      <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Priezvisko</b></td>
      <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Rodné priezvisko</b></td>
      <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Dátum narodenia</b></td>
      <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Rod. číslo</b></td>
      <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Bydlisko</b></td>
      <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Dátum odberu</b></td>
      <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Dátum prebratia</b></td>
      <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Útvar, ktorý žiadal</b></td>
      <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Útvar, ktorý zaistil</b></td>
      <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Miesto odberu</b></td>
      <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>PPS odobral</b></td>
      <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Prítomné osoby</b></td>
      <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Odber z</b></td>';

      if (isset($_GET['zapis'])) {
        echo '<td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"></td>';
      }

      echo '</tr>';



      while ($riadok = mysql_fetch_array($výsledok, MYSQL_NUM)) {

        echo "<tr><td style=\"font-weight:bold\" align=\"left\">$riadok[0]/$riadok[1]</td>
        <td align=\"left\">$riadok[2]</td>
        <td style=\"text-transform:uppercase\" align=\"left\">$riadok[3]</td>
        <td align=\"left\">$riadok[4]</td>
        <td align=\"left\">$riadok[5]</td>
        <td align=\"left\">$riadok[6]</td>
        <td align=\"left\">$riadok[7]</td>
        <td align=\"left\">$riadok[8]</td>
        <td align=\"left\">$riadok[9]</td>
        <td align=\"left\">$riadok[10]</td>
        <td align=\"left\">$riadok[11]</td>
        <td align=\"left\">$riadok[12]</td>
        <td align=\"left\">$riadok[13]</td>
        <td align=\"left\">$riadok[14]</td>
        <td align=\"left\">$riadok[15]</td>";

        if (isset($_GET['zapis'])) {
          echo '<td align="left"><a href="./zapis-pi.php?osoba=' . $riadok[16];
          if (isset($_GET['pripad'])) {
            echo '&pripad=' . $_GET['pripad'];
          }
          echo '"><button type="button">Vybrat</button></a></td>';
        }
          echo "</tr>\n";
        }

    echo '</table>';
    mysql_free_result ($výsledok);

    if ($výsledok) {
      $výsledok = FALSE;
      $sprava .= '<p>Ďalší požadovaný záznam sa nenašiel!</p>';


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
}
?>

<br><br>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<fieldset style="height:250px;width:400px;border-radius:5px;border:thin solid forestgreen;" class="fieldset">
  <legend><h3 style="color:forestgreen;text-transform:uppercase">Zadajte parametre vyhľadávania:</h3></legend><br>
  <table  align="center">
    <tr><td align="left">Meno:&nbsp</td><td align="left"><input type="text" class="frame" name="meno" size="20" maxlength="40" style="height:30px;font-size:14pt;"
    value="<?php if (isset($_POST['meno'])) echo $_POST['meno']; ?>"/></td></tr>
    <tr><td align="left">Priezvisko:&nbsp</td><td align="left"><input type="text" class="frame" name="priezvisko" size="20" maxlength="40" style="height:30px;font-size:14pt;"
    value="<?php if (isset($_POST['priezvisko'])) echo $_POST['priezvisko']; ?>"/></td></tr>
    <tr><td align="left">Dátum narodenia:&nbsp</td><td align="left"><input type="date" class="frame" name="dat_narodenia" size="30" maxlength="40" style="height:30px;font-size:14pt;"
    value="<?php if (isset($_POST['dat_narodenia'])) echo $_POST['dat_narodenia']; ?>"/></td></tr>
    <tr><td align="left">Rodné číslo:&nbsp</td><td align="left"><input type="text" class="frame" name="rod_cislo" size="20" maxlength="40" style="height:30px;font-size:14pt;"
    value="<?php if (isset($_POST['rod_cislo'])) echo $_POST['rod_cislo']; ?>"/></td></tr>
    <tr><td align="left">Odber vykonaný z:&nbsp</td><td align="left"><select class="frame" style="height:30px;font-size:14pt;width:223px;" name="odber"
    value="<?php if (isset($_POST['odber'])) echo $_POST['odber']; ?>"/><br>
      <option></option>
      <option>bokov nad bedrovou časťou tela na dva snímače</option>
      <option>boku nad bedrovou časťou tela na jeden snímač</option>
      <option>z iného miesta</option></select></td></tr></table><br>


</fieldset>
<div align="center"><input style="height:45px;cursor:pointer;" class="btn2" type="submit" name="odoslat"
  value="Hľadať" /></div>
</form>
<?php
?>
