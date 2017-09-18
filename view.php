<?php
session_start();
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../includes/style.css">
<meta http-equiv="content-type" content="text/html" charset="utf-8">
<title>Журналы</title>
</head>
<body>
	
<table>
<tr>
<!-- 1 столбец -->	
<td width="10%" valign=top>
	
<table>
<tr><td align=center> <!-- 1 строка -->	
<a href="../index.php">Журналы</a>
</td></tr>

<tr><td align=center><!-- 2 строка -->	

<?php
session_start();
require_once 'includes/functions.php';
require_once 'includes/db.php';
require_once 'includes/journal.php';

echo '<br><br>';

$id = clean($_GET['id']);
$Journal = new Journal($id);


//сделать обработку для page

if (isset($_GET['page'])) {
    $page = clean($_GET['page']);
} else {
    $page = 0;
}

/* проверка $page на положительность, и вычисление page1 page2 nalevo napravo */
if ($page < 0) {
    $page = 0;
}

if ($page > $Journal->kolvo) {
    $page = $Journal->kolvo;
}

if ($page % 2 == 0) {
    $page1 = $page;
    $page2 = $page1 + 1;
    $nalevo = $page - 2;
    $napravo = $page + 2;
} else {
    $page1 = $page - 1;
    $page2 = $page;
    $nalevo = $page - 2;
    $napravo = $page + 2;
}
if ($page < 2) {
    $nalevo = 0;
}
if ($page == $Journal->kolvo) {
    $napravo = $Journal->kolvo;
}

/* Вывод названия журнала */
echo $Journal->name.' №'.$Journal->number.'/'.$Journal->year;

echo '<br>'.round($page / $Journal->kolvo * 100).'%<br>
<br>'.$Journal->BackToMain().'
</td></tr>

</table>
';

/* 2 столбец - левая страница */
echo '<td align="right" width=40%>';
/* вывод левой страницы */
if ($page1 != '0') {
    echo '<a href="view.php?id=';
    echo $Journal->id;
    echo '&page=';
    echo $nalevo;
    echo '">';
    echo $Journal->IMG($page1);
    echo '</a>';
}
echo '</td>';
/* 3 столбец - правая страница */
echo '<td align="left" width=40%>';
/* вывод правой страницы */
if (($page != $Journal->kolvo) or ($Journal->kolvo % 2 != 0)) {
    echo '<a href="view.php?id=';
    echo $Journal->id;
    echo '&page=';
    echo $napravo;
    echo '">';
    echo $Journal->IMG($page2);
    echo '</a>';
}


echo '</td>';
/* 4 столбец средней строки */

echo '<td valign="top" align="center" width=10%>';
include 'pages/login.php';
echo '<br><br>';


// Прочитан и кнопка 		Отметить журнал как прочитанный?
// после нажатия на кнопку - сделать журнал прочитанным на посл странице, вставляет в бд ид юзера и ид журнала
if (isset($_POST['read_journal'])) {
    echo $Journal->insert_readID($_SESSION['user_id']);
}
if (isset($_SESSION['login'])) {
    $from_read = $Journal->select_ReadID($_SESSION['user_id']);
    if ($from_read<>false) {
        echo 'Этот журнал прочитан!';
    } else {
        if ($page == $Journal->kolvo) {
            echo '
				<form id="form_read" action="" method="post">
				Отметить журнал как прочитанный?
				<br>
				<input style="cursor:pointer" type="submit" name="read_journal" value="Да" />
				</form>				
				';
        }
    }
}




echo '<br><br>';

// ЗАКЛАДКА
if (isset($_SESSION['login'])) {
    // если юзер залогинен , смотрим закладку
    $bookmark = $Journal->select_Bookmark($_SESSION['user_id']);
        
    if ($bookmark==false) {
        // если закладки у юзера нет , то выводим кнопку Установить закладку
        if (isset($_POST['bookmark_set'])) {
            // если юзер нажал Установить закладку , то устанавливаем закладку
            echo $Journal->insert_Bookmark($_SESSION['user_id'], $page);
            echo 'Закладка установлена';
            unset($_POST['bookmark_set']);
        } else {
            echo '
		<form id="form_bookmark" action="" method="post">
		<input style="cursor:pointer" type="submit" name="bookmark_set" value="Установить закладку" />
		</form>				
		';
        }
    } else {
        // если закладка есть

        if (isset($_POST['bookmark_set'])) {
            // если юзер нажал Установить закладку , то устанавливаем закладку
            echo $Journal->update_Bookmark($_SESSION['user_id'], $page);
            echo 'Закладка установлена<br>';
            unset($_POST['bookmark_set']);
        } else {
            if (($bookmark['journal_id'] <> $id) or ($bookmark['page'] <> $page)) {
                echo '
				<form id="form_bookmark" action="" method="post">
				<input style="cursor:pointer" type="submit" name="bookmark_set" value="Установить закладку" />
				</form>				
				';
                echo '<br><a href="view.php?id='.$bookmark['journal_id'].'&page='.$bookmark['page'].'">Перейти к закладке</a>';
            } else {
                echo 'Закладка';
            }
        }
    }
}
// КОНЕЦ ЗАКЛАДКА


echo $Journal->Script($nalevo, $napravo);
?>

</table></body></html>
