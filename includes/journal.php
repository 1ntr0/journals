                                   <?php
class journal
{
    public function Journal($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT name,year,number,kolvo,category FROM journals WHERE id=?');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $id;
        $this->name = $rows[name];
        $this->year = $rows[year];
        $this->number = $rows[number];
        $this->kolvo = $rows[kolvo];
        $this->category = $rows[category];
    }
    
    public function AHrefFirstPage($page)
    {
        if ($page > 1) {
            echo '<a href="view.php?category=';
            echo $this->category;
            echo '&name=';
            echo $this->name;
            echo '&year=';
            echo $this->year;
            echo '&number=';
            echo $this->number;
            echo '&kolvo=';
            echo $this->kolvo;
            echo '&page=1">1</a>';
        }
    }
    
    public function AHrefLastPage($page1, $page2)
    {
        if (!(($page1 == $this->kolvo) or ($page2 == $this->kolvo))) {
            echo '<a href="view.php?category=';
            echo $this->category;
            echo '&name=';
            echo $this->name;
            echo '&year=';
            echo $this->year;
            echo '&number=';
            echo $this->number;
            echo '&kolvo=';
            echo $this->kolvo;
            echo '&page=';
            echo $this->kolvo;
            echo '">';
            echo $this->kolvo;
            echo '</a>';
        }
    }
    
    public function Script($nalevo, $napravo)
    {
        echo '<script type="text/javascript" language="javascript">
		var id = "'.$this->id.'";
		var kolvo = "'.$this->kolvo.'";
		var nalevo = "'.$nalevo.'";
		var napravo = "'.$napravo.'";
		</script>';
        echo '<script src="../includes/script_view.js"></script>';
    }
              
    public function insert_readID($user_id)
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO read_table (user_id, journal_id) VALUES (:user_id, :journal_id)');
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':journal_id', $this->id);
        $stmt->execute();
    }
    
    public function insert_Bookmark($user_id, $page)
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO bookmarks (user_id, journal_id, page) VALUES (:user_id, :journal_id, :page)');
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':journal_id', $this->id);
        $stmt->bindParam(':page', $page);
        $stmt->execute();
    }
    
    public function update_Bookmark($user_id, $page)
    {
        global $pdo;
        $sql = 'UPDATE bookmarks SET journal_id = :journal_id, page = :page WHERE user_id = :user_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':journal_id', $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':page', $page, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
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
    
    public function select_ReadID($user_id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT read_id FROM read_table WHERE user_id = ? and journal_id = ?');
        $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetch();
        return $rows;
    }
        
    public function BackToMain()
    {
        $str = '<a href="../index.php?category='.$this->category.'&name='.$this->name.'&year='.$this->year.'&number='.$this->number.'">Вернуться к списку журналов</a>';
        return $str;
    }
        
    public function IMG($page)
    {
        if ($this->kolvo<100) {
            if ($page<10) {
                $page='0'.$page;
            }
        } else {
            if ($page<100) {
                $page='0'.$page;
            }
            if ($page<10) {
                $page='0'.$page;
            }
        }
        $str = '<img src="../journals/'.$this->name.'/'.$this->year.'/'.$this->number.'/-'.$page.'.jpg" height="950" />';
        return $str;
    }
}
