<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php
    $titul_stranky ='CEPAS';
    include ('views/pages/zahlavie.inc');
    ?>
    <head>
    <?php
    include ('views/pages/zahlavie2.inc')
    ?>
    </head>
        <link rel="stylesheet" type="text/css" href="css/style.css">

    <?php
    if (isset($_POST['odoslat'])) {

      $sprava = NULL;
      $barcode = $_POST['barcode'];

      if ($barcode) {
        require_once('./mysql_pps.php');

        $dotaz = "SELECT cislo, rok, meno, priezvisko, rod_priezvisko, DATE_FORMAT(dat_narodenia, '%d. %m. %Y') AS dat_narodenia, rod_cislo, bydlisko,
        DATE_FORMAT(dat_odberu, '%d. %m. %Y %H:%i') AS dat_odberu, DATE_FORMAT(dat_prebratia, '%d. %m. %Y %H:%i') AS dat_prebratia, utvar, utvar_dopyt, miesto, pps_odobral,
        osoby_pri, odber FROM pps WHERE barcode LIKE '$barcode'";
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
    }
    if (isset($sprava)) {
      echo '<font color="red">', $sprava, '</font>';
    }
    ?>
  <body><br><br>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset style="height:300px;width:600px;border-radius:5px;border:thin solid forestgreen;" class="fieldset">
      <h3 style="color:forestgreen;text-transform:uppercase">Vyhľadávanie stôp</h3>
      <div align="center" style="height:100px;width:600px;border-radius:5px;border:thin solid forestgreen;" class="fieldset"><div style="align:center;color:black;font-weight:bold;">
  Vyhľadávanie podľa viacerých kritérií</div><br>
  <div>
  <button style="height:45px;width:160px;" class="btn2"><a href="hladaj_ps.php" style="text-decoration:none;">Vyhľadávanie PS</button>&nbsp&nbsp
  <button style="height:45px;width:160px;" class="btn2"><a href="hladaj_pps.php" style="text-decoration:none;">Vyhľadávanie PPS</button></div><br>
  <div align="center" style="height:100px;width:600px;border-radius:5px;border:thin solid forestgreen;" class="fieldset"><div style="align:center;color:black;font-weight:bold;">
  Zobrazenie celej databázy pachových stôp</div><br>
  <button style="height:45px;" class="btn2"><a href="databaza_ps.php" style="text-decoration:none;">Databáza PS</button>&nbsp&nbsp
  <button style="height:45px;" class="btn2"><a href="databaza_pps.php" style="text-decoration:none;">Databáza PPS</button><br><p></p></fieldset>

  </div>
  </body>
</html>
