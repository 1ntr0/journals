<?php

class journals
{
    public function getJournals_Category($category, $page)
    {
        $p = $page * 6;
        global $pdo;
        $stmt = $pdo->prepare('SELECT id,name,year,number,kolvo FROM journals WHERE category=? ORDER BY id DESC limit ?,6');
        $stmt->bindValue(1, $category, PDO::PARAM_STR);
        $stmt->bindValue(2, $p, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    public function getJournals_Name($name, $page)
    {
        $p = $page * 6;
        global $pdo;
        $stmt = $pdo->prepare('SELECT id,name,year,number,kolvo FROM journals WHERE name=? ORDER BY id DESC limit ?,6');
        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->bindValue(2, $p, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }
    public function getJournals_NameYear($name, $year, $page)
    {
        $p = $page * 6;
        global $pdo;
        $stmt = $pdo->prepare('SELECT id,name,year,number,kolvo FROM journals WHERE name=? and year=? ORDER BY id DESC limit ?,6');
        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->bindValue(2, $year, PDO::PARAM_INT);
        $stmt->bindValue(3, $p, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }
    public function status($_category = null, $_name = null, $_year = null)
    {
        if (!(isset($_category))) {
            $x = 0;
        }
        if (isset($_category)) {
            $x = 1;
        }
        if ((isset($_name)) and !(isset($_year))) {
            $x = 2;
        }
        if (isset($_name) and isset($_year)) {
            $x = 3;
        }

        return $x;
    }

    public function showLastEntities($_massiv, $_parameter1, $_parameter2)
    {
        $massiv_new = array_slice($_massiv, $_parameter1, $_parameter2);
        echo '<tr valign="top" align="center">';
        foreach ($massiv_new as $result) {
            echo $this->showFirstPage($result);
        }
        echo '</tr>';
    }
    public function showFirstPage($_massiv)
    {
        echo '<td>';
        echo '<a href="view.php?id=';
        echo $_massiv['id'];
        echo '"><img width="290" src="journals/';
        echo $_massiv['name'];
        echo '/';
        echo $_massiv['year'];
        echo '/';
        echo $_massiv['number'];
        echo '/-';
        if ($_massiv['kolvo']<100) {
            echo '0';
        } else {
            echo '00';
        }
        echo '1.jpg"><br>';
        echo $_massiv['name'];
        echo ' №';
        echo $_massiv['number'];
        echo '/';
        echo $_massiv['year'];
        echo '</a>&nbsp;&nbsp;';
                
        $from_read=0;
        $from_read = $this->getReadID($_SESSION['user_id'], $_massiv['id']);
        if ($from_read<>0) {
            echo '<span class="read">&nbsp;Прочитан&nbsp;</span>';
        }
        echo '</td>';
    }
    
    public function getReadID($user_id, $journal_id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT id FROM read_table WHERE user_id = ? and journal_id = ?');
        $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $journal_id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchColumn();
        return $rows;
    }
    
    
    
    public function showJournals($_massiv)
    {
        switch (count($_massiv)) {
            case 1:
                $this->showLastEntities($_massiv, -1, 1);
                echo '<tr height="440"><td></td></tr>';
                break;
            case 2:
                $this->showLastEntities($_massiv, -2, 2);
                echo '<tr height="440"><td></td></tr>';
                break;
            case 3:
                $this->showLastEntities($_massiv, -3, 3);
                echo '<tr height="440"><td></td></tr>';
                break;
            case 4:
                $this->showLastEntities($_massiv, -4, 3);
                $this->showLastEntities($_massiv, -1, 1);
                break;
            case 5:
                $this->showLastEntities($_massiv, -5, 3);
                $this->showLastEntities($_massiv, -2, 2);

                break;
            case 6:
                $this->showLastEntities($_massiv, -6, 3);
                $this->showLastEntities($_massiv, -3, 3);
                break;
        }
    }

    public function showCategories($massiv, $category = null)
    {
        foreach ($massiv as $result) {
            echo '<a href="index.php?category=';
            echo $result;
            echo '">';
            if (isset($category) and ($category == $result)) {
                echo '<span class="current">►';
            }
            echo $result;
            //echo ' ('.$this->getCountCategory($result).')';
            if (isset($category) and ($category == $result)) {
                echo '◄</span>';
            }
            echo '</a><br>';
        }
    }

    public function showNamesCategory($massiv, $_category, $_name = null)
    {
        foreach ($massiv as $result) {
            echo '<a href="index.php?category=';
            echo $_category;
            echo '&name=';
            echo $result;
            echo '">';
            if (isset($_name) and ($_name == $result)) {
                echo '<span class="current">►';
            }
            echo $result;
            //echo ' ('.$this->getCountName($result).')';
            if (isset($_name) and ($_name == $result)) {
                echo '◄</span>';
            }
            echo '</a><br>';
        }
    }
    public function showYearsName($massiv, $_category, $_name, $_year = null)
    {
        foreach ($massiv as $result) {
            echo '<a href="index.php?category=';
            echo $_category;
            echo '&name=';
            echo $_name;
            echo '&year=';
            echo $result;
            echo '">';
            if (isset($_year) and ($_year == $result)) {
                echo '<span class="current">►';
            }
            echo $result;
            if (isset($_year) and ($_year == $result)) {
                echo '◄</span>';
            }
            echo '</a><br>';
        }
    }
    public function showNumbersNameYear($massiv, $_number = null)
    {
        foreach ($massiv as $result) {
            echo '<a href="view.php?id=';
            echo $result['id'];
            echo '">';
            if (isset($_number) and ($_number == $result['number'])) {
                echo '<span class="current">►';
            }
            echo $result['number'];
            if (isset($_number) and ($_number == $result['number'])) {
                echo '◄</span>';
            }
            echo '</a><br>';
        }
    }

    public function getCategories()
    {
        global $pdo;
        $stmt = $pdo->query('SELECT DISTINCT category FROM journals')->fetchAll(PDO::FETCH_COLUMN);

        return $stmt;
    }

    public function getNames_Category($category)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT DISTINCT name FROM journals WHERE category = ?');
        $stmt->bindValue(1, $category, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);

        return $rows;
    }

    public function getYears_Name($name)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT DISTINCT year FROM journals WHERE name = ?');
        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);

        return $rows;
    }

    public function getNumbers_NameYear($name, $year)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT id,number FROM journals WHERE name = ? and year = ?');
        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->bindValue(2, $year, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }

    public function pageLeft($_count, $_page, $_category = null, $_name = null, $_year = null)
    {
        $x = $this->status($_category, $_name, $_year);
        $PageFirst = $_count - $_page * 6;
        if ($PageFirst > 0) {
            $page = $_page - 1;
            switch ($x) {
                    case 0:
                        $str = '<a href="index.php?page='.$page.'">Налево</a>';
                        break;
                    case 1:
                        $str = '<a href="index.php?category='.$_category.'&page='.$page.'">Налево</a>';
                        break;
                    case 2:
                        $str = '<a href="index.php?category='.$_category.'&name='.$_name.'&page='.$page.'">Налево</a>';
                        break;
                    case 3:
                        $str = '<a href="index.php?category='.$_category.'&name='.$_name.'&year='.$_year.'&page='.$page.'">Налево</a>';
                        break;
                    }

            return $str;
        }
    }
    public function pageRight($_count, $_page, $_category = null, $_name = null, $_year = null)
    {
        $x = $this->status($_category, $_name, $_year);
        $PageFirst = ($_count - 1) - $_page * 6;
        if ($PageFirst > 5) {
            $page = $_page + 1;
            switch ($x) {
                    case 0:
                        $str = '<a href="index.php?page='.$page.'">Направо</a>';
                        break;
                    case 1:
                        $str = '<a href="index.php?category='.$_category.'&page='.$page.'">Направо</a>';
                        break;
                    case 2:
                        $str = '<a href="index.php?category='.$_category.'&name='.$_name.'&page='.$page.'">Направо</a>';
                        break;
                    case 3:
                        $str = '<a href="index.php?category='.$_category.'&name='.$_name.'&year='.$_year.'&page='.$page.'">Направо</a>';
                        break;
                    }

            return $str;
        }
    }
    public function script($_count, $_page, $_category = null, $_name = null, $_year = null)
    {
        $nalevo = $_page - 1;
        if ($nalevo < 0) {
            $nalevo = 0;
        }
        $napravo = $_page + 1;
        $MaxCountPages = floor(($_count - 1) / 6);
        if ($napravo > $MaxCountPages) {
            $napravo = $MaxCountPages;
        }
        $x = $this->status($_category, $_name, $_year);

        echo '<script type="text/javascript" language="javascript">
		var nalevo = "'.$nalevo.'";
		var napravo = "'.$napravo.'";
		var count = "'.$MaxCountPages.'";';
        switch ($x) {
                        case 1:
                            echo 'var category = "'.$_category.'";';
                            break;
                        case 2:
                            echo 'var category = "'.$_category.'";';
                            echo 'var name = "'.$_name.'";';
                            break;
                        case 3:
                            echo 'var category = "'.$_category.'";';
                            echo 'var name = "'.$_name.'";';
                            echo 'var year = "'.$_year.'";';
                            break;
                    }
        echo 'var x = "'.$x.'";
		</script>';
        echo '<script src="includes/script_index.js"></script>';
    }
    public function adm_getSortMassivJournals()
    {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM journals ORDER BY category ASC, name ASC, year ASC, number ASC')->fetchAll();

        return $stmt;
    }
    public function adm_showMassivJournals($massiv)
    {
        foreach ($massiv as $result) {
            echo '<tr align="center"><td>';
            echo $result['category'];
            echo '</td><td>';
            echo $result['name'];
            echo '</td><td>';
            echo $result['year'];
            echo '</td><td>';
            echo $result['number'];
            echo '</td><td>';
            echo $result['kolvo'];
            echo '</td>';
            echo '
				<form id="form_edit_del" action="" method="post">
				<input type="hidden" name="name" value="'.$result['name'].'">
				<input type="hidden" name="year" value="'.$result['year'].'">
				<input type="hidden" name="number" value="'.$result['number'].'">
				<input type="hidden" name="category" value="'.$result['category'].'">
				<input type="hidden" name="kolvo" value="'.$result['kolvo'].'">
				<input type="hidden" name="id" value="'.$result['id'].'">
				<!--<td><input style="cursor:pointer" type="submit" name="redact" value="Редактировать" /></td>-->
				<!--<td><input style="cursor:pointer" type="submit" name="del" value="Удалить" /></td>-->
				</form>
				';
            echo '</tr>';
        }
    }
    public function showLastSixJournals($category, $name, $year, $page)
    {
        $x = $this->status($category, $name, $year);
        switch ($x) {
        case 0:
            $massiv_new = $this->getSixJournals($page);
            echo $this->showJournals($massiv_new);
            break;
        case 1:
            $case1 = $this->getJournals_Category($category, $page);
            echo $this->showJournals($case1);
            break;
        case 2:
            $case2 = $this->getJournals_Name($name, $page);
            echo $this->showJournals($case2);
            break;
        case 3:
            $case3 = $this->getJournals_NameYear($name, $year, $page);
            echo $this->showJournals($case3);
            break;
                }
    }
    public function statusPageLeft($category, $name, $year, $page)
    {
        $x = $this->status($category, $name, $year);
        if ($page > 0) {
            switch ($x) {
                        case 0:
                            $count = $this->getCountJournals();
                            echo $this->pageLeft($count, $page);
                            break;
                        case 1:
                            $count = $this->getCountCategory($category);
                            echo $this->pageLeft($count, $page, $category);
                            break;
                        case 2:
                            $count = $this->getCountName($name);
                            echo  $this->pageLeft($count, $page, $category, $name);
                            break;
                        case 3:
                            $count = $this->getCountNameYear($name, $year);
                            echo $this->pageLeft($count, $page, $category, $name, $year);
                            break;
                                }
        }
    }
    public function statusPageRight($category, $name, $year, $page)
    {
        $x = $this->status($category, $name, $year);
        switch ($x) {
        case 0:
            $count = $this->getCountJournals();
            echo $this->script($count, $page);
            echo $this->pageRight($count, $page);
            break;
        case 1:
            $count = $this->getCountCategory($category);
            echo $this->script($count, $page, $category);
            echo $this->pageRight($count, $page, $category);
            break;
        case 2:
            $count = $this->getCountName($name);
            echo $this->script($count, $page, $category, $name);
            echo  $this->pageRight($count, $page, $category, $name);
            break;
        case 3:
            $count = $this->getCountNameYear($name, $year);
            echo $this->script($count, $page, $category, $name, $year);
            echo $this->pageRight($count, $page, $category, $name, $year);
            break;
                }
    }
    public function getCountJournals()
    {
        global $pdo;
        $stmt = $pdo->query('SELECT COUNT(*) from journals');
        $result = $stmt->fetchColumn();

        return $result;
    }

    
    public function getCountCategory($category)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT count(*) FROM journals WHERE category=?');
        $stmt->execute(array($category));
        $result = $stmt->fetchColumn();

        return $result;
    }
    
    public function getCountName($name)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT count(*) FROM journals WHERE name=?');
        $stmt->execute(array($name));
        $result = $stmt->fetchColumn();

        return $result;
    }
    

    public function getCountNameYear($name, $year)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT count(*) FROM journals WHERE name=? and year=?');
        $stmt->execute(array($name, $year));
        $result = $stmt->fetchColumn();

        return $result;
    }

    public function getSixJournals($page)
    {
        global $pdo;
        $p = $page * 6;
        $stmt = $pdo->prepare('SELECT id,name,year,number,kolvo FROM journals ORDER BY id DESC limit ?,6');
        $stmt->bindValue(1, $p, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }
    
    public function getRating()
    {
        global $pdo;
        $stmt = $pdo->query('Select journal_id, count(*) from read_table group by journal_id ORDER BY count(*) DESC LIMIT 5');
        $result = $stmt->fetchAll();

        return $result;
    }
    
    public function getJournalsById($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT name,number,year FROM journals WHERE id = ?');
        $stmt->execute(array($id));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    
    public function select_Bookmark($user_id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT journal_id,page FROM bookmarks WHERE user_id = ?');
        $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetch();
        return $rows;
    }
    
    public function showRating()
    {
        $rating = $this->getRating();
        echo '<br><br><table>Топ 5 прочитанных';
        foreach ($rating as $value) {
            $J_id = $value['journal_id'];
            echo '<tr>
			<td>
			<a href="view.php?id=';
            echo $J_id;
            echo '">';
            $massiv = $this->getJournalsById($J_id);
            echo $massiv['name'];
            echo ' №';
            echo $massiv['number'];
            echo '/';
            echo $massiv['year'];
            echo '</a></td>
			<td>';
            echo $value['count(*)'];
            echo '</td>
			</tr>';
        }
        echo '</table>';
    }
}
