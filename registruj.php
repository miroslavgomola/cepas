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

  if (empty($_POST['meno'])) {
    $me = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať meno!</p></td>';
  } else {
    $me = $_POST['meno'];
  }

  if (empty($_POST['priezvisko'])) {
    $pr = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať priezvisko!</p>';
  } else {
    $pr = $_POST['priezvisko'];
  }

  if (empty($_POST['email'])) {
    $e = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať email!</p>';
  } else {
    $e = $_POST['email'];
  }

  if (empty($_POST['uziv_meno'])) {
    $u = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať uzivatelske meno!</p>';
  } else {
    $u = $_POST['uziv_meno'];
  }

  if (empty($_POST['heslo1'])) {
    $h = FALSE;
    $sprava .= '<p align=center>Zabudli ste zadať heslo!</p>';
  } else {
    if ($_POST['heslo1'] == $_POST['heslo2']) {
      $h = $_POST['heslo1'];
  } else {
    $h = FALSE;
    $sprava .= '<p align=center>Vaše heslo nesúhlasí zadajte ho znova!</p>';
  }
}

  if ($me && $pr && $e && $u && $h) {
    require_once('./mysql_spojit.php');

    $dotaz = "INSERT INTO uzivatelia (uziv_meno, meno, priezvisko, email, heslo, datum_registracie)
    VALUES ('$u', '$me', '$pr', '$e', '$h', NOW())";
    $výsledok = @mysql_query ($dotaz);
    if ($výsledok) {

    echo '<p align=center><b>Registrácia prebehla úspešne!</b></p>';
    include ('views/pages/pata.inc');
    exit();

  } else {
    $sprava .= '<p align=center>Registrácia bola prerušená kvôli systémovej chybe. Ospravedlňujeme sa!</p>
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


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Zadajte príslušné údaje do nasledujúceho formulára:</legend>
  <p><b>Meno:</b><input type="text" name="meno" size="20" maxlength="40" value="
    <?php if (isset($_POST['meno'])) echo $_POST['meno']; ?>"/></p>
  <p><b>Priezvisko:</b><input type="text" name="priezvisko" size="30" maxlength="40" value="
    <?php if (isset($_POST['priezvisko'])) echo $_POST['priezvisko']; ?>"/></p>
  <p><b>Adresa el. pošty:</b><input type="text" name="email" size="40" maxlength="60" value="
    <?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/></p>
  <p><b>Užívateľské meno:</b><input type="text" name="uziv_meno" size="20" maxlength="40" value="
    <?php if (isset($_POST['uziv_meno'])) echo $_POST['uziv_meno']; ?>"/></p>
  <p><b>Heslo:</b> <input type="password" name="heslo1" size="20" maxlength="20" /></p>
  <p><b>Potvrďte heslo:</b> <input type="password" name="heslo2" size="20" maxlength="20" /></p>
</fieldset>
<div align="center"><input style="width:65px" class="btn2" type="submit" name="odoslat"
  value="Odoslať" /></div>
</form>
<?php
?>
