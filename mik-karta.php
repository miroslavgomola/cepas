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
  <body>
    <main>
    <h3>
      MENNÁ IDENTIFIKAČNÁ KARTA<br>
      MPI
    </h3>
    </main>
    <main>
      <b>&nbsp&nbspOdber porovnávacej pachovej stopy v zmysle § 155 Trestného poriadku<br>
      Odber porovnávacej pachovej stopy v zmysle § 20 zák. 171/1993 Z. z. o PZ</b>
    </main><br>

    <form>
      <main>
        <table>
          <tr>
            <td>
                Dátum odberu PPS: <input class="datetime" type="datetime-local" name="Dátum odberu PPS">
            </td>
            <td>
              Dátum prebratia PPS: <input class="datetime" type="datetime-local" name="Dátum prebratia PPS">
            </td>
          </tr>
        </table>
      </main>
      Dátum odberu PPS:&nbsp
      <input class="datetime" type="datetime-local" name="Dátum odberu PPS">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspDátum prebratia PPS:&nbsp
      <input class="datetime" type="datetime-local" name="Dátum prebratia PPS"><p>
      </p><br>
      Priezvisko:&nbsp<input type="text">&nbsprod.:&nbsp<input type="text"><br><p></p>
      Meno:&nbsp<input type="text">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<br><p></p>
      nar.:&nbsp<input type="text">&nbspRodné číslo:&nbsp<input type="text"><br><p></p>
      bydlisko:&nbsp<input type="text" class="bydlisko"><br><p></p>
      Útvar, ktorý žiada o odber porovnávacej pachovej stopy:&nbsp<select class="" name="utvary">
        <option value=""></option>
        <option value="KR PZ BB">Krajské riaditeľstvo PZ Banská Bystrica</option>
        <option value="OR PZ VK">Okresné riaditeľstvo PZ Veľký Krtíš</option>
      </select><br><p></p>
      Útvar, de sa odber PPS vykonal:&nbsp<select class="" name="utvary">
        <option value=""></option>
        <option value="KR PZ BB">Krajské riaditeľstvo PZ Banská Bystrica</option>
        <option value="OR PZ VK">Okresné riaditeľstvo PZ Veľký Krtíš</option>
      </select><br><p></p>
      Miestnosť, kde sa odber PPS vykonal:&nbsp<select class="" name="utvary">
        <option value=""></option>
        <option value="kancelária">Kancelária</option>
        <option value="stála služba">Stála služba</option>
      </select>
      PPS odobral:&nbsp<select class="" name="technici">
        <option value=""></option>
        <option value="Fajčík">Fajčík</option>
        <option value="Molnár">Molnár</option>
      </select><br><p></p>
      Všetky prítomné osoby pri odbere PPS:&nbsp<input type="text" class="bydlisko"><br><p></p>
      Odber vykonaný z:&nbsp<select class="" name="miesto">
        <option value=""></option>
        <option value="a">a) bokov nad bedrovou časťou tela na dva snímače pachu</option>
        <option value="b">b) boku nad bedrovou časťou tela na jeden snímač</option>
        <option value="c">c) z iného miesta</option>
      </select>&nbsp&nbsp&nbsp&nbsp<input type="text"><br><p></p>
      <input type="text" class="frame" value="">&nbsp<button>Priradenie kódu</button><br><p></p><br><p></p>

    </form>
  </body>
</html>
