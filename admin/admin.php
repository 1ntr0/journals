<?php

session_start();

if ($_SESSION['admin']<>1) {
    header("HTTP/1.0 404 Not Found");
    exit;
}


?>

<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../includes/style.css">
<meta http-equiv="content-type" content="text/html" charset="utf-8">
<title>Панель администратора</title>
</head>
<body>
<table>
<tr align="center">
<td width="390" height="80">
<a href="../index.php"><h1>Журналы</h1></a></td>
<td><h1><a href="admin.php">Панель администратора</a><h1></td>
<td width="390" align="left"><a href="http://localhost/phpmyadmin/">phpmyadmin</a></td>
</tr>
<tr align="center">
<td valign="top"><br>
<?php
require_once '../includes/db.php';
require_once '../includes/journals.php';
require_once '../includes/admin_journal.php';


$Journals = new Journals();
if (isset($_POST['category'])) {
    $category = $_POST['category'];
}
if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
if (isset($_POST['year'])) {
    $year = $_POST['year'];
}
if (isset($_POST['number'])) {
    $number = $_POST['number'];
}
if (isset($_POST['kolvo'])) {
    $kolvo = $_POST['kolvo'];
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}
/*if (isset($_POST['edit'])) {
    $edit = $_POST['edit'];
}*/
echo 'Общее количество журналов: '.$Journals->getCountJournals();
?>
</td><td>
<table border="1">
<tr>
<td colspan="5" align="center"><h2>Добавить журнал</h2></td>
</tr>
<tr align="center">
<td width="15%">Категория</td>
<td width="15%">Название</td>
<td width="15%">Год</td>
<td width="15%">Номер</td>
<td width="15%">Количество страниц</td>
</tr>
<tr align="center">

<?php
echo '<form id="form_edit_add" action="" method="post">
<td><input required placeholder="Категория" type="text" name="category" value="';
if (isset($category) and isset($edit)) {
    echo $category;
} else {
    echo '';
}
echo '"/></td>
<td><input required placeholder="Название" type="text" name="name" value="';
if (isset($name) and isset($edit)) {
    echo $name;
} else {
    echo '';
}
echo '"/></td>
<td><input required placeholder="Год" type="text" name="year" value="';
if (isset($year) and isset($edit)) {
    echo $year;
} else {
    echo '';
}
echo '"/></td>
<td><input required placeholder="Номер" type="text" name="number" value="';
if (isset($number) and isset($edit)) {
    echo $number;
} else {
    echo '';
}
echo '"/></td>
<td><input required placeholder="Количество страниц" type="text" name="kolvo" value="';
if (isset($kolvo) and isset($edit)) {
    echo $kolvo;
} else {
    echo '';
}
echo '"/></td>';
if (isset($edit)) {
    echo '<input type="hidden" name="id" value='.$id.'">';
    echo '<td><input style="cursor:pointer" type="submit" name="edit" value="Изменить" /></td>';
} else {
    '<td></td>';
}
echo '<td><input style="cursor:pointer" type="submit" name="add" value="Добавить" /></td>
</form>';
?>

</tr>
<tr>
<td  colspan="5" align="center"><h2>Список журналов</h2></td>
</tr>

<?php
$SortJournals = $Journals->adm_getSortMassivJournals();
echo  $Journals->adm_showMassivJournals($SortJournals);
?>

</table>
</td><td valign=top>

<?php
// Отображение результата добавления или удаления
if (isset($_POST['add'])) {
    $Journal = new Journal($name, $year, $number, $kolvo, $category);
    
    echo $Journal->db_Insert();
    echo $Journal->MakeDir();
    echo $Journal->Info_Add();
    unset($Journal);
}


?>

</td>
</tr>
</table></body></html>
