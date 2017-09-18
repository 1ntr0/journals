                                   <?php
class journal
{
    public function Journal($_name, $_year, $_number, $_kolvo = null, $_category = null, $_id = null)
    {
        $this->name = $_name;
        $this->year = $_year;
        $this->number = $_number;
        $this->kolvo = $_kolvo;
        $this->category = $_category;
        $this->id = $_id;
    }

    public function db_Insert()
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO journals (name, year, number, kolvo, category) VALUES (:name, :year, :number, :kolvo, :category)');
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':number', $this->number);
        $stmt->bindParam(':kolvo', $this->kolvo);
        $stmt->bindParam(':category', $this->category);
        $stmt->execute();
    }
    
    public function MakeDir()
    {
        $path = $_SERVER['DOCUMENT_ROOT'].'/journals/'.$this->name.'/'.$this->year.'/'.$this->number.'/';
        $uold = umask(0);
        mkdir($path, 0777, true);
        umask($uold);
    }
    
    public function Info_Add()
    {
        echo 'Журнал успешно добавлен в бд<br>Папка для него создана на сервере<br>
	Проверьте введеные данные журнала:
	<br>Категория - '.$this->category.'
	<br>Название - '.$this->name.'
	<br>Год - '.$this->year.'
	<br>Номер -  '.$this->number.'
	<br>Количество страниц - '.$this->kolvo.'
	<br><a href="admin.php">Обновите страницу чтобы увидеть изменения</a>';
    }
}
