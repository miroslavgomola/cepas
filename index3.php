<!DOCTYPE html>
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


<h2>Pridanie nového používateľa</h2>

<?php
//PRIPOJENIE DO DB
$server_name = "localhost";
$db_user_name = "root";
$password = "root";
$dbname = "cepasdata";

$connection = mysqli_connect($server_name, $db_user_name, $password, $dbname);

if (!$connection) {
echo 'Spojenie s databázou sa nepodarilo nadviazať.';
// echo 'Spojenie s databázou sa podarilo úspešne nadviazať.';
}
?>

<?php

//SPRACOVANIE FILTROVANIA
$search_keyword = "";
if($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['search_form']){
$search_keyword = $_GET['search_keyword'];
}

$sql_query = "SELECT * FROM users";

if($search_keyword){
$sql_query .= " WHERE user_name LIKE '%".$search_keyword."%' OR user_surname LIKE '%".$search_keyword."%'";
}

//ZACHYTENIE PARAMETRA PRE TRIEDENIE DAT V TABULKE
$sort_by = $_GET['sort_by'];
$sort_type = $_GET['sort_type'];

if($sort_by){
$sql_query .= " ORDER BY ".$sort_by;

if($sort_type){
$sql_query .= " ".$sort_type;
}else{
$sql_query .= " ASC";
}
}

$result = mysqli_query($connection, $sql_query);

echo '<h2>Zoznam používateľov</h2>';

?>

<!-- Formular na filtrovanie usera -->
<form class="contact_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
<label for="search_keyword">Meno</label>
<input type="text" name="search_keyword" id="search_keyword" value="<?php echo $search_keyword;?>">

<input type="hidden" name="sort_by" value="<?php echo $sort_by;?>">
<input type="hidden" name="sort_type" value="<?php echo $sort_type;?>">

<input type="submit" name="search_form" value="Filtruj">
</form>

<br>


<?php

if (mysqli_num_rows($result) > 0) {
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

// echo '<br><br><pre>';
// print_r($data);
// echo '</pre>';
echo '<h2>Zoznam používateľov</h2>';

echo '<table class="persons">';
echo '<tr>';
echo '<th>ID</th>';

echo '<th><a class="sortable';

if($sort_by == 'user_name'){
if($sort_type == 'ASC'){
echo ' asc';
}else{
echo ' desc';
}
}

echo '" href="index.php?sort_by=user_name';

if($sort_by == 'user_name'){
if($sort_type == 'ASC'){
echo '&sort_type=DESC';
}else{
echo '&sort_type=ASC';
}
}else{
echo '&sort_type=ASC';
}
if($search_keyword){
echo '&search_keyword='.$search_keyword.'&search_form=Filtruj';
}
echo '">Meno</a></th>';

echo '<th><a class="sortable';

if($sort_by == 'user_surname'){
if($sort_type == 'ASC'){
echo ' asc';
}else{
echo ' desc';
}
}

echo '" href="index.php?sort_by=user_surname';

if($sort_by == 'user_surname'){
if($sort_type == 'ASC'){
echo '&sort_type=DESC';
}else{
echo '&sort_type=ASC';
}
}else{
echo '&sort_type=ASC';
}
if($search_keyword){
echo '&search_keyword='.$search_keyword.'&search_form=Filtruj';
}
echo '">Priezvisko</a></th>';

echo '<th>Vek</th>';
echo '<th>Rola</th>';
echo '<th>Akcie</th>';
echo '</tr>';

for($i=0; $i<count($data); $i++){
echo '<tr>';
foreach($data[$i] as $index => $value){
echo '<td>'.$value.'</td>';
}

echo '<td>';
echo '<a href="uprava-zaznamu.php?id_user='.$data[$i]['id'].'">Upraviť záznam</a><br><br>';
echo '<a href="index.php?id_user='.$data[$i]['id'].'">Vymazať záznam</a>';
echo '</td>';

echo '</tr>';
}

echo '</table>';

} else {
echo "0 results were selected.";
}

echo '<br><br>';

mysqli_close($connection);
?>


<div class="clear"></div>


<?php include "footer.php";?>
</div>
</body>
</html>
