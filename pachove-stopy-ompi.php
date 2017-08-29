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
      $cvs = $_POST['cvs'];

      if ($barcode OR $cvs) {
        require_once('./mysql_pps.php');

        $dotaz = "SELECT * FROM ps WHERE barcode LIKE '$barcode' OR cvs LIKE '$cvs'";
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
          <td align="center" style="border-radius:5px;color:white;background-color:forestgreen;"><b>Odber z</b></td></tr>';


          while ($riadok = mysql_fetch_array($výsledok, MYSQL_NUM)) {

            echo "<tr><td style=\"font-weight:bold\" align=\"left\">$riadok[0]/$riadok[1]</td>
            <td align=\"left\">$riadok[6]</td>
            <td style=\"text-transform:uppercase\" align=\"left\">$riadok[4]</td>
            <td align=\"left\">$riadok[5]</td>
            <td align=\"left\">$riadok[7]</td>
            <td align=\"left\">$riadok[8]</td>
            <td align=\"left\">$riadok[9]</td>
            <td align=\"left\">$riadok[2]</td>
            <td align=\"left\">$riadok[3]</td>
            <td align=\"left\">$riadok[10]</td>
            <td align=\"left\">$riadok[11]</td>
            <td align=\"left\">$riadok[12]</td>
            <td align=\"left\">$riadok[13]</td>
            <td align=\"left\">$riadok[14]</td>
            <td align=\"left\">$riadok[15]</td></tr>\n";
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
    <fieldset style="height:400px;width:600px;border-radius:5px;border:thin solid forestgreen;" class="fieldset">
      <h3>Vyhľadávanie stôp</h3>
    <div align="center">
      Podľa čiarového kódu:&nbsp<input type="text" class="frame" name="barcode" size="20" maxlength="40" style="height:30px;font-size:14pt;"
        value="<?php if (isset($_POST['barcode'])) echo $_POST['barcode']; ?>"/>
    <input style="height:37px;cursor:pointer;" class="btn2" type="submit" name="odoslat" value="Hľadať" /></div></form><br><br>
      Podľa čísla reg. záznamu:&nbsp<input type="text" class="frame" name="cvs" size="20" maxlength="40" style="height:30px;font-size:14pt;"
      value="<?php if (isset($_POST['cvs'])) echo $_POST['cvs']; ?>"/>
  <input style="height:37px;cursor:pointer;" class="btn2" type="submit" name="odoslat" value="Hľadať" /></div></form><br><br></fieldset>

  </div>
  </body>
</html>
