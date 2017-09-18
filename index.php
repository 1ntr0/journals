<?php
session_start();
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="includes/style.css">
<meta http-equiv="content-type" content="text/html" charset="utf-8">
<meta name="keywords" content="журнал pdf">
<meta name="description" content="Сайт для просмотра журналов">
<title>Журналы</title>
</head>
<body>
<table>
<!-- верхняя строка -->
<tr align="center">
<td width="390" height="80">
<a href="index.php"><h1>Журналы</h1></a></td>
<td rowspan="2" >
<table>

<?php
require_once 'includes/db.php';
require_once 'includes/journals.php';

/* проверка входящих параметров на существование */
if (isset($_GET['category'])) {
    $category = $_GET['category'];
}
if (isset($_GET['name'])) {
    $name = $_GET['name'];
}
if (isset($_GET['year'])) {
    $year = $_GET['year'];
}
if (isset($_GET['number'])) {
    $number = $_GET['number'];
}
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 0;
}
/* вывод 6 последних журналов */

$Journals = new Journals();
echo $Journals->showLastSixJournals($category, $name, $year, $page);

?>

</table>
</td>
<td width="390">
</td>
</tr>
<!-- ----------------------------------------------------------------------------------------------------- -->
<!-- вторая строка -->
<tr align="center">
<td valign=top>
<table>
<tr align="center">
<td width="50%">

<?php
/* 1 ячейка КАТЕГОРИИ */

$mas = $Journals->getCategories();
if (isset($category)) {
    echo $Journals->showCategories($mas, $category);
} else {
    echo $Journals->showCategories($mas);
}
?>

</td>
<td width="50%">

<?php
/* 2 ячейка ЖУРНАЛЫ ДАННОЙ КАТЕГОРИИ */

$mas = $Journals->getNames_Category($category);
if (isset($category)) {
    if (isset($name)) {
        echo $Journals->showNamesCategory($mas, $category, $name);
    } else {
        echo $Journals->showNamesCategory($mas, $category);
    }
}
?>

</td>
</tr>
<tr align="center" valign="top">
<td><br>

<?php
/* 3 ячейка ГОДА ДАННОГО ЖУРНАЛА */

$mas = $Journals->getYears_Name($name);

if (isset($name)) {
    if (isset($year)) {
        echo $Journals->showYearsName($mas, $category, $name, $year);
    } else {
        echo $Journals->showYearsName($mas, $category, $name);
    }
}
?>

</td>
<td><br>

<?php
/* 4 ячейка НОМЕРА ДАННОГО ГОДА И НОМЕРА */
$mas = $Journals->getNumbers_NameYear($name, $year);
if (isset($year)) {
    if (isset($number)) {
        echo $Journals->showNumbersNameYear($mas, $number);
    } else {
        echo $Journals->showNumbersNameYear($mas);
    }
}
?>

</td></tr>
<tr height="100%"><td></td><td></td></tr>
</table></td>
<td valign=top>
<?php

include 'pages/login.php';

if (isset($_SESSION['login'])) {
    // если юзер залогинен , смотрим закладку
    $bookmark = $Journals->select_Bookmark($_SESSION['user_id']);
    if ($bookmark<>false) {
        echo '<br><br><a href="view.php?id='.$bookmark['journal_id'].'&page='.$bookmark['page'].'">Перейти к закладке</a>';
    }
}

echo $Journals->showRating();

?>

</td></tr>
<!-- ----------------------------------------------------------------------------------------------------- -->
<!-- нижняя строка -->
<tr valign=top><td></td><td>
<table>
<tr valign=top><td width=33% align=left>

<?php
/* Налево */
echo $Journals->statusPageLeft($category, $name, $year, $page);
?>

</td><td width=33% align=center>

<?php
if ($page > 0) {
    echo $page;
}
?>

</td><td width=33% align=right>

<?php
/* Направо */
echo $Journals->statusPageRight($category, $name, $year, $page);
?>

</td></tr></table>
</td><td></td>
</tr>
</table></body></html>