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
echo '<div align="center"><a href="./hladaj_pps.php?zapis&'. $_SERVER['QUERY_STRING'] .'" /><button style="height:45px;cursor:pointer;" class="btn2" type="button" name="odoslat"
  >Hľadať PPS</button><a/></div><br>';

  if (isset($_GET['osoba'])) {
    require_once('./mysql_pps.php');

    $dotaz = "SELECT meno, priezvisko from pps";
    $výsledok = mysql_query ($dotaz);

    if ($výsledok) {
      $riadok = mysql_fetch_row($výsledok);

      echo $riadok[0] . " " . $riadok[1];
    }
  }
echo '<div align="center"><a href="./hladaj_ps.php?zapis&'. $_SERVER['QUERY_STRING'] .'" /><button style="height:45px;cursor:pointer;" class="btn2" type="button" name="odoslat"
    >Hľadať PS</button><a/></div>';
?>
