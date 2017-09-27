                            <?php
$host = 'localhost';
$db = 'ntr';
$charset = 'utf8';
$user = 'root';
$pass = 'zrhen';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
);
$pdo = new PDO($dsn, $user, $pass, $opt);
