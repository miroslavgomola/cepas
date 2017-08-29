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
  $rok = $_POST['rok'];
  $dat_prijatia = $_POST['dat_prijatia'];
  $cislo = $_POST['cislo'];
  $barcode = $_POST['barcode'];
  $dat_vyradenia = $_POST['dat_vyradenia'];

  if ($rok && $dat_prijatia && $cislo && $dat_vyradenia) {

    require_once('./mysql_pps.php');

    $dotaz = "UPDATE ps SET cislo='$cislo', rok='$rok', dat_prijatia='$dat_prijatia', dat_vyradenia='$dat_vyradenia' WHERE barcode LIKE '$barcode'";
    $výsledok = @mysql_query ($dotaz);
    if ($výsledok) {

    echo '<p align=center><b>ÚSPEŠNE STE NAHRALI DÁTA!</b></p>';
    include ('views/pages/pata.inc');
    exit();


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
<fieldset style="height:350px;width:600px;border-radius:5px;border:thin solid forestgreen;" class="fieldset"><legend>Zadajte požadované údaje:</legend>
  <table align="center"><br>
    <tr><td align="left">Zadajte znovu číslo čiarového kódu:&nbsp</td>
      <td align="left"><input type="text" class="frame" name="barcode" size="20" maxlength="40" style="height:30px;font-size:14pt;"
        value="<?php if (isset($_POST['barcode'])) echo $_POST['barcode']; ?>"/></p></td></tr>
    <tr><td></td><td align="left">
      <?php

          require_once('./mysql_pps.php');

          $dotaz = "SELECT cislo, rok FROM ps ORDER BY cislo DESC LIMIT 1";
          $výsledok = mysql_query ($dotaz);

          while ($riadok = mysql_fetch_array($výsledok, MYSQL_NUM)) {

            echo "<table style=\"font-size:12pt;\" cellspacing=\"0\" cellpadding=\"2\">
            <tr><td align=\"center\" style=\"font-size:12pt;border-radius:10px;color:white;background-color:red;width:150px\"><b>Posledné použité číslo pre záznam bolo</b></td>
            <th align=\"left\" style=\"font-size:14pt;color:red;;\">$riadok[0]/$riadok[1]</td></th></tr></table>\n";
          }
          ?></td></tr>
  <tr>
    <td align="left">Pridať evidenčné číslo PS:</td><td align="left"><input type="text" name="cislo" size="20" maxlenght="40" class="frame" style="height:30px;font-size:14pt;"
    value="<?php if (isset($_POST['cislo'])) echo $_POST['cislo']; ?>"></td>
  </tr>
  <tr><td align="left">Pridať rok:</td><td align="left"><input type="text" name="rok" size="20" maxlenght="4" class="frame" style="height:30px;font-size:14pt;"
  value="<?php if (isset($_POST['rok'])) echo $_POST['rok']; ?>"></td>
  </tr>
  <tr><td align="left">Pridať dátum prijatia:</td><td align="left"><input type="datetime-local" name="dat_prijatia" size="30" maxlength="40" class="frame"
    style="height:30px;font-size:14pt;width:220px;" value="<?php if (isset($_POST['dat_prijatia'])) echo $_POST['dat_prijatia']; ?>"></td>
  </tr>
  <tr><td align="left">Pridať dátum vyradenia:</td><td align="left"><input type="datetime-local" name="dat_vyradenia" size="30" maxlength="40" class="frame"
    style="height:30px;font-size:14pt;width:220px;" value="<?php if (isset($_POST['dat_vyradenia'])) echo $_POST['dat_vyradenia']; ?>"></td>
</tr></table>
</fieldset>
<div align="center"><input style="height:45px;cursor:pointer;" class="btn2" type="submit" name="odoslat"
  value="Nahrať údaje" /></div>
</form>
<?php

?>
