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

  $cvs = $_POST['cvs'];



  if ($cvs) {
    require_once('./mysql_pps.php');

    $dotaz = "SELECT cislo, rok, DATE_FORMAT(dat_zaistenia, '%d. %m. %Y') AS dat_zaistenia, kurier, osobne, vazba, skoda, utvar, cvs, trieda, utvar_dopyt, dopyt_cislo,
    cislo_ps1, ps1, porozita_ps1, kl_ps1_cas, miesto_ps1, podmienky_ps1, teplota_ps1,
    cislo_ps2, ps2, porozita_ps2, kl_ps2_cas, miesto_ps2, podmienky_ps2, teplota_ps2,
    cislo_ps3, ps3, porozita_ps3, kl_ps3_cas, miesto_ps3, podmienky_ps3, teplota_ps3,
    cislo_ps4, ps4, porozita_ps4, kl_ps4_cas, miesto_ps4, podmienky_ps4, teplota_ps4,
    cislo_ps5, ps5, porozita_ps5, kl_ps5_cas, miesto_ps5, podmienky_ps5, teplota_ps5,
    rusive_vplyvy, stupen, popis, barcode, zaistil_ps,
    DATE_FORMAT(dat_prijatia, '%d. %m. %Y %H:%i') AS dat_prijatia, DATE_FORMAT(dat_vyradenia, '%d. %m. %Y %H:%i') AS dat_vyradenia FROM ps WHERE cvs LIKE '$cvs'";
    $výsledok = mysql_query ($dotaz);

    if ($výsledok) {

      while ($riadok = mysql_fetch_array($výsledok, MYSQL_NUM)) {

        echo "<br><br><table class=\"frame\" style=\"font-size:14pt;width:1230px;\" cellspacing=\"10\" cellpadding=\"2\">
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Číslo PS</b></td>
        <th style=\"font-weight:bold;font-size:25pt;color:blue;\" align=\"left\">$riadok[0]/$riadok[1]</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Dátum zaistenia</b></td>
        <th style=\"font-size:25pt;color:red;\" align=\"left\">$riadok[2]</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Dátum prijatia</b></td>
        <th align=\"left\">$riadok[52]</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Kuriér</b></td>
        <th align=\"left\">$riadok[3]</th>
        <th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen;width:120px;\"><b>Osobne</b></td>
        <th align=\"left\">$riadok[4]</th>
        <th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen;width:120px;\"><b>Väzba</b></td>
        <th align=\"left\">$riadok[5]
        <td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Škoda</b></td>
        <th align=\"left\">$riadok[6] €</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Útvar PZ ktorý PS zaistil</b></td>
        <th align=\"left\">$riadok[7]</th>
        <th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>ČVS</b></td>
        <th align=\"left\">$riadok[8]</th>
        <th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Zločinecká trieda</b></td>
        <th align=\"left\">$riadok[9]</th></tr>
        <tr><th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>Výsledok porovania zaslať útvaru</b></td>
        <th align=\"left\">$riadok[10]</th>
        <th><td align=\"center\" style=\"border-radius:5px;color:white;background-color:forestgreen\"><b>k číslu</b></td>
        <th align=\"left\">$riadok[11]</th></tr></table>

        <table style=\"font-size:12pt;width:1230px;border:thin solid forestgreen;\" cellspacing=\"10\" cellpadding=\"2\">
        <tr><td><th align=\"center\" style=\"color:forestgreen\"><h2>PACHOVÉ STOPY</h2></th></td></tr></table>

        <table style=\"font-size:14pt;width:1230px;border:thin solid forestgreen;\" cellspacing=\"0\" cellpadding=\"2\">
        <tr><td align=\"center\" style=\"color:white;background-color:forestgreen;width:120px;\"><b>Číslo PS</b></td>
        <td align=\"center\" style=\"color:white;background-color:forestgreen;width:120px;\"><b>Zaistená z</b></td>
        <td align=\"center\" style=\"color:white;background-color:forestgreen;width:120px;\"><b>Absorbent PORÓZNY</b></td>
        <td align=\"center\" style=\"color:white;background-color:forestgreen;width:120px;\"><b>Časový úsek po zaistenie PS</b></td>
        <td align=\"center\" style=\"color:white;background-color:forestgreen;width:120px;\"><b>Miesto zaistenia</b></td>
        <td align=\"center\" style=\"color:white;background-color:forestgreen;width:120px;\"><b>Poveternostné podmienky</b></td>
        <td align=\"center\" style=\"color:white;background-color:forestgreen;width:120px;\"><b>Teplota</b></td></tr>
        <tr><td align=\"center\" style=\"font-weight:bold;\">$riadok[12]</td>
        <td align=\"left\">$riadok[13]</td>
        <td align=\"center\">$riadok[14]</td>
        <td align=\"center\">$riadok[15]</td>
        <td align=\"center\">$riadok[16]</td>
        <td align=\"center\">$riadok[17]</td>
        <td align=\"center\">$riadok[18] °C</td></tr>
        <tr style=\"background-color:#f6debc\"><td align=\"center\" style=\"font-weight:bold;\">$riadok[19]</td>
        <td align=\"left\">$riadok[20]</td>
        <td align=\"center\">$riadok[21]</td>
        <td align=\"center\">$riadok[22]</td>
        <td align=\"center\">$riadok[23]</td>
        <td align=\"center\">$riadok[24]</td>
        <td align=\"center\">$riadok[25] °C</td></tr>
        <td align=\"center\" style=\"font-weight:bold;\">$riadok[26]</td>
        <td align=\"left\">$riadok[27]</td>
        <td align=\"center\">$riadok[28]</td>
        <td align=\"center\">$riadok[29]</td>
        <td align=\"center\">$riadok[30]</td>
        <td align=\"center\">$riadok[31]</td>
        <td align=\"center\">$riadok[32] °C</td></tr>
        <tr style=\"background-color:#f6debc\"><td align=\"center\" style=\"font-weight:bold;\">$riadok[33]</td>
        <td align=\"left\">$riadok[34]</td>
        <td align=\"center\">$riadok[35]</td>
        <td align=\"center\">$riadok[36]</td>
        <td align=\"center\">$riadok[37]</td>
        <td align=\"center\">$riadok[38]</td>
        <td align=\"center\">$riadok[39] °C</td></tr>
        <td align=\"center\" style=\"font-weight:bold;\">$riadok[40]</td>
        <td align=\"left\">$riadok[41]</td>
        <td align=\"center\">$riadok[42]</td>
        <td align=\"center\">$riadok[43]</td>
        <td align=\"center\">$riadok[44]</td>
        <td align=\"center\">$riadok[45]</td>
        <td align=\"center\">$riadok[46] °C</td></tr></table>
        <table style=\"font-size:14pt;width:1230px;border:thin solid forestgreen;\" cellspacing=\"0\" cellpadding=\"2\">
        <tr><td align=\"center\" style=\"color:white;background-color:forestgreen\"><b>Rušivé vplyvy</b></td>
        <td align=\"center\" style=\"color:white;background-color:forestgreen\"><b>Trieda</b></td>
        <tr align=\"center\" ><td align=\"center\">$riadok[47]</td>
        <td align=\"center\">$riadok[48]</td></tr></table>
        <table style=\"font-size:14pt;width:1230px;border:thin solid forestgreen;\" cellspacing=\"0\" cellpadding=\"2\">
        <tr><td align=\"center\" style=\"color:white;background-color:forestgreen\"><b>POPIS SKUTKU</b></td>
        <th align=\"left\" style=\"font-size:14pt;\">$riadok[49]</td></th></tr></table><br>
        <table style=\"font-size:14pt;width:1230px;border:thin solid forestgreen;\" cellspacing=\"0\" cellpadding=\"2\">
        <tr><td align=\"left\" style=\"color:white;background-color:forestgreen;width:200px\"><b>Dátum vyradenia</b></td>
        <td align=\"center\" style=\"color:white;background-color:forestgreen;width:200px\"><b>PS zaistil</b></td></tr>
        <tr align=\"center\" ><td align=\"center\">$riadok[53]</td>
        <th align=\"center\" style=\";\">$riadok[51]</td></th></tr></table>\n";
      }


    echo '</table>';
    mysql_free_result ($výsledok);


  } else {
    $sprava .= '<p align=center>Vyhľadávanie prerušené kvôli systémovej chybe. Ospravedlňujeme sa!</p>
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

<br><br>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset style="height:100px;width:400px;border-radius:5px;border:thin solid forestgreen;" class="fieldset" align="center">
  <legend><h3 style="color:forestgreen;text-transform:uppercase">Zadajte ČVS pre vyhľadávanie:</h3></legend>
  <p><b>ČVS:&nbsp</b><input type="text" class="frame" name="cvs" size="20" maxlength="40" style="height:30px;font-size:14pt;"
    value="<?php if (isset($_POST['cvs'])) echo $_POST['cvs']; ?>"/></p>

</fieldset>
<div align="center"><input style="height:45px;cursor:pointer;" class="btn2" type="submit" name="odoslat"
  value="Hľadať" /></div>
</form>
<?php

?>
