<?php
DEFINE ('DB_UZIVATEL', 'root');
DEFINE ('DB_HESLO', 'root');
DEFINE ('DB_HOSTITEL', 'localhost');
DEFINE ('DB_NAZOVDATABAZI', 'mojedata');

$dbc = @mysql_connect(DB_HOSTITEL, DB_UZIVATEL, DB_HESLO)
    OR die ('Nemôžem sa pripojiť k databáze MySQL: '. mysql_error());
mysql_select_db (DB_NAZOVDATABAZI)
    OR die ('Nie je možné vybrať databázu: '. mysql_error());
?>
