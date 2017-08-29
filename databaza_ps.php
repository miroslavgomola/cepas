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
  <h1>DATABÁZA EVIDOVANÝCH PACHOVÝCH STÔP</h1>
<?php

require_once('./mysql_pps.php');

$dotaz = "SELECT cislo AS cislo, rok AS rok,
 DATE_FORMAT(dat_zaistenia, '%d. %m. %Y') AS dat_zaistenia,
 DATE_FORMAT(dat_prijatia, '%d. %m. %Y') AS dat_prijatia,
 DATE_FORMAT(dat_vyradenia, '%d. %m. %Y') AS dat_vyradenia,
 cislo_ps1 AS cislo_ps1,
 ps1 AS ps1,
 cislo_ps2 AS cislo_ps2,
 ps2 AS ps2,
 cislo_ps3 AS cislo_ps3,
 ps3 AS ps3,
 cislo_ps4 AS cislo_ps4,
 ps4 AS ps4,
 cislo_ps5 AS cislo_ps5,
 ps5 AS ps5,
 popis AS popis,
 zaistil_ps AS zaistil_ps,
 barcode AS barcode FROM ps ORDER BY cislo ASC";
$výsledok = mysql_query ($dotaz);
if ($výsledok) {


  while ($riadok = mysql_fetch_array($výsledok, MYSQL_NUM)) {
    echo "<table style=\"font-size:12pt;width:1300px;border:thin solid forestgreen;\" cellspacing=\"0\" cellpadding=\"2\">
    <tr><td align=\"center\" style=\"color:white;background-color:forestgreen;width:120px;\"><b>Číslo PS</b></td>
    <td align=\"center\" style=\"color:white;background-color:forestgreen;\"><b>Dátum zaistenia</b></td>
    <td align=\"center\" style=\"color:white;background-color:forestgreen;\"><b>Dátum prijatia</b></td>
    <td align=\"center\" style=\"color:white;background-color:forestgreen;\"><b>Dátum vyradenia</b></td>
    <td align=\"center\" style=\"color:white;background-color:forestgreen;\"><b>Číslo stopy</b></td>
    <td align=\"center\" style=\"color:white;background-color:forestgreen;\"><b>Zaistená z</b></td>
    <td align=\"center\" style=\"color:white;background-color:forestgreen;\"><b>Popis</b></td>
    <td align=\"center\" style=\"color:white;background-color:forestgreen;\"><b>PS zaistil</b></td>
    <td align=\"center\" style=\"color:white;background-color:forestgreen;\"><b>Číslo čiarového kódu</b></td></tr>
    <tr><td align=\"center\" style=\"width:120px;font-weight:bold;\">$riadok[0]/$riadok[1]</td>
    <td align=\"left\" style=\"width:100px\">$riadok[2]</td>
    <td align=\"left\"style=\"width:120px\">$riadok[3]</td>
    <td align=\"center\" style=\"width:100px\">$riadok[4]</td>
    <td align=\"center\" style=\"width:200px\">$riadok[5]</td>
    <td align=\"center\" style=\"width:200px\">$riadok[6]</td>
    <td align=\"left\" style=\"width:400px\">$riadok[15]</td>
    <td align=\"center\" style=\"width:400px\">$riadok[16]</td>
    <td align=\"center\" style=\"width:120px\">$riadok[17]</td></tr>
    <tr style=\"background-color:#f6debc\"><th></th><th></th><th></th><th><td align=\"center\">$riadok[7]</td></th><td align=\"center\">$riadok[8]</td><td></td><td></td><td></td></tr>
    <tr><th></th><th></th><th></th><th><td align=\"center\">$riadok[9]</td><td align=\"center\">$riadok[10]</td><td></td><td></td><td></td></tr>
    <tr style=\"background-color:#f6debc\"><th></th><th></th><th></th><th><td align=\"center\">$riadok[11]</td><td align=\"center\">$riadok[12]</td><td></td><td></td><td></td></tr>
    <tr><th></th><th></th><th></th><th><td align=\"center\">$riadok[13]</td><td align=\"center\">$riadok[14]</td><td></td><td></td><td></td></tr></table><p>\n";
  }

  echo '</table>';
  mysql_free_result ($výsledok);

} else {
  echo '<p>Zoznam pachových stôp nie je možné zobraziť kvôli systémovej chybe. Ospravedlňujeme sa..</p><p>'. mysql_error(). '</p>';
}


?>
