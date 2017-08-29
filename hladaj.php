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
require_once("./mysql_spojit.php");
?>
<html>
<body>
<h1>Vyhľadávanie v databáze článkov</h1>
<form  method="post">
Hľadaný reťazec: <input type="text" name="searchtext"><br><br>
Slova spájať ako:<br>
<input type="radio" name="operators" value="and"> AND<br>
<input type="radio" name="operators" value="or" checked> OR<br>
<input type="radio" name="operators" value="quotes"> H+adať presne taký istý reťazec<br><br>
Hľadat:<br>
<input type="checkbox" name="options[1]" value="yes" checked> v mene autora<br>
<input type="checkbox" name="options[2]" value="yes" checked> v titulku článku<br>
<input type="checkbox" name="options[3]" value="yes" checked> v celom článku<br>
v kategórií: <select name="category"><option value="0">Všetky
<?php
$result=mysql_query("SELECT * FROM category");
while($pole=mysql_fetch_array($result))
    echo "<option value=\"".$pole["id"]."\"> ".$pole["name"];
?>
</select><br><br>
<input type="submit">
</form>
<?php

if(isset($_POST["searchtext"]))
{

    if($_POST["options"][1])
        $indexes="author";
    if($_POST["options"][2])
        $indexes.=($indexes!="" ? ", title" : "title");
    if($_POST["options"][3])
        $indexes.=($indexes!="" ? ", body" : "body");

    if($indexes=="")
        die("<b>Chyba pri vyh+adávaní:<br>Nebola zvolená ani jedna voľba, v ktorej hľadaš!</b>");


    if($_POST["searchtext"]=="")
        die("<b>Chyba pri vyhľadávaní:<br>Nebol zadaný žiaden reťazec, ktorý treba hľadať!</b>");
    else
    {

        $searchtext=explode(" ",$_POST["searchtext"]);

        $maximum=0;
        for($i=0;$i<count($searchtext);$i++)
        {
            $pocet=strlen($searchtext[$i]);
            $maximum=($maximum < $pocet ? $pocet : $maximum);
        }

        if($maximum<3)
            die("<b>Chyba pri vyhľadávaní:<br>Aspoň jedno slovo v reťazci musí byť dlhšie ako 3 znaky</b>");
    }

    switch($_POST["operators"])
    {

        case "quotes":
            $_POST["searchtext"]="\"".$_POST["searchtext"]."\"";
            break;

        case "and":

            $words=explode(" ",$_POST["searchtext"]);

            for($i=0;$i<count($words);$i++)
                $words[$i]="+".$words[$i];

            $_POST["searchtext"]=implode(" ",$words);
            break;

    }

    if(mysql_query("ALTER TABLE clanky ADD FULLTEXT search (".$indexes.")"))
        echo "Index search bol uspešne vytvorený nad stĺpcami :<b>".$indexes."</b><br>";

    $query="SELECT *,MATCH(".$indexes.") AGAINST('".$_POST["searchtext"]."' IN BOOLEAN MODE) as score FROM clanky
            WHERE MATCH(".$indexes.") AGAINST('".$_POST["searchtext"]."' IN BOOLEAN MODE)";

    if($_POST["category"]!=0)
    {
        $query.=" AND id_category=".$_POST["category"];

        $pole=mysql_fetch_array(mysql_query("SELECT * FROM category where id=".$_POST["category"]));
        echo "Vyhladavame v kategorii: <b>".$pole["name"]."</b><br>";
    }

    $query.=" ORDER BY score DESC";

    $result=mysql_query($query);
    echo "Počet nájdených vyhovujúcich výsledkov: <b>".mysql_num_rows($result)."</b><br>";

    echo "<table width=\"100%\" border=\"1\">
          <caption>Výsledky vyhľadávania</caption>
          <thead>
            <tr>
                <th>SCORE</th>
                <th>AUTOR</th>
                <th>TITULOK</th>
                <th>TEXT</th>
                <th>KATEGÓRIA</th>
            </tr>
          </thead>
          <tbody>";
    while($pole=mysql_fetch_array($result))
    {
        echo "<tr>
                  <td>".$pole["score"]."</td>
                  <td>".$pole["author"]."</td>
                  <td>".$pole["title"]."</td>
                  <td>".$pole["body"]."</td>";

       $pole_category=mysql_fetch_array(mysql_query("SELECT * FROM category WHERE id=".$pole["id_category"]));
       echo "     <td>".$pole_category["name"]."</td>
              </tr>";
    }
    echo "</tbody>
          </table>";

    if(mysql_query("ALTER TABLE clanky DROP INDEX search"))
        echo "Index bol úspešne zmazaný!";
}
?>
</body>
</html>
