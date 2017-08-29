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
</style><p>
  <h1>DATABÁZA EVIDOVANÝCH POROVNÁVACÍCH PACHOVÝCH STÔP</h1>
<?php

require_once('./mysql_pps.php');

$dotaz = "SELECT CONCAT (cislo, '/', rok) AS cislo,
 meno AS meno, priezvisko AS pr,
 rod_priezvisko AS rod_priezvisko,
 DATE_FORMAT(dat_narodenia, '%d. %m. %Y') AS dat_narodenia,
 rod_cislo AS rod_cislo,
 bydlisko AS bydlisko,
 DATE_FORMAT(dat_odberu, '%d. %m. %Y') AS dat_odberu,
 DATE_FORMAT(dat_prebratia, '%d. %m. %Y') AS dat_prebratia,
 utvar_dopyt AS utvar_dopyt,
 utvar AS utvar,
 miesto AS miesto,
 pps_odobral AS pps_odobral,
 osoby_pri AS osoby_pri,
 odber AS odber FROM pps";
$výsledok = mysql_query ($dotaz);
if ($výsledok) {

  echo '<table align="center" class="frame" style="font-size:12pt"; cellspacing="10" cellpadding="2">
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
  <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Odber z</b></td></tr>';


  while ($riadok = mysql_fetch_array($výsledok, MYSQL_NUM)) {
    echo "<tr><td style=\"font-weight:bold\" align=\"left\">$riadok[0]</td>
    <td align=\"left\">$riadok[1]</td>
    <td style=\"text-transform:uppercase\" align=\"left\">$riadok[2]</td>
    <td align=\"left\">$riadok[3]</td>
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
    <td align=\"left\">$riadok[14]</td></tr>\n";
  }

  echo '</table>';
  mysql_free_result ($výsledok);
} else {
  echo '<p>Zoznam pachových stôp nie je možné zobraziť kvôli systémovej chybe. Ospravedlňujeme sa..</p><p>'. mysql_error(). '</p>';
}


?>
