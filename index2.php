<?php #vyhladavanie.php
require_once("mysql_spojit.php");
if(isset($_GET['retazec'])){
    if(empty($_GET['retazec'])){
        $retazec = FALSE;
        $error = "Nezadali ste reťazec pre vyhľadávanie!<br />n";
    } else {
        $retazec = $_GET['retazec'];
    }
    if($_GET['podla'] == "meno"){
        $podla = "meno";
    } elseif($_GET['podla'] == "priezvisko"){
        $podla = "priezvisko";
    }
        if($retazec){
            echo "Výsledky vyhľadávania <strong>$retazec</strong>!<br />n";
            $retazec = explode(" ",$retazec);
            $sql = "SELECT * FROM uzivatelia WHERE $podla LIKE '%".$retazec[0]."%'";
            for ($num=1;$num<count($retazec);$num++) {
              $sql .= " AND $podla LIKE '%".$retazec[$num]."%'";
            }
            $sql = "$sql ORDER DESC";
            $vysledok = mysql_query($sql);
            $pocet = mysql_num_rows($vysledok);
            if($pocet == NULL){
                die("Zadaný reťazec sa v databáze nenachádza!<br />n");
            }
            while($zaznam = mysql_fetch_object($vysledok)){
                $meno = $zaznam->meno;
                echo "$meno<br />n";
            }
            unset($meno);
            echo "<hr />Výsledkov: <strong>$pocet</strong> | <a href='javascript:history.back()' title='Späť'>Späť</a><br />n";
        } else {
            echo $error;
        }
} else {
    echo "<form action='{$_SERVER['PHP_SELF']}' method='get'>n";
    echo "      <fieldset><legend>Zadajte reťazec</legend>n";
    echo "            Text:<br /><input name='retazec' type='text' /><br />n";
    echo "            Hľadaj...<br /><select name='podla'>n";
    echo "                <option value='meno'>meno</option>n";
    echo "                <option value='priezvisko'>priezvisko</option>n";
    echo "            </select><br /><br />n";
    echo "            <input type='submit' value='Vyhľadaj' />n";
    echo "      </fieldset>n";
    echo "</form>n";
}
?>
