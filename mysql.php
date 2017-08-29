<?php #mysql.php

$dbc = mysql_connect("localhost","root","root") OR die("Chyba spojenia!<br />n");

       mysql_select_db("cepasdata") OR die("Systém nenašiel tabuľky!<br />n");

?>
