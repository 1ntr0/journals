<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
//защита от бота
if ($_POST['email'] != '') {
    exit;
}
session_start();
require_once 'includes/db.php';
require_once 'includes/user.php';
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="includes/style.css">
<meta http-equiv="content-type" content="text/html" charset="utf-8">
<meta name="keywords" content="журнал pdf">
<meta name="description" content="Сайт для просмотра журналов">
<title>Журналы Регистрация</title>
</head>
<body>
<table>
<tr align="center">
<td width="390" height="80">
<a href="index.php"><h1>Журналы</h1></a>
</td>
<td>
</td>
<td width="390">
</tr>
<tr height=100%><td></td>
<td valign=top>
	<div align=center>
	
	<form id="form_reg" action="" method="post" >
	<h1>Регистрация</h1><br>
	<input class="reg" required placeholder="Имя" type="text" name="login" /><br>
	<input class="reg" name="email" type="hidden"  />
	<input class="reg" required placeholder="Почта" type="text" name="pochta" /><br>
	<input class="reg" required placeholder="Пароль" type="password" name="password" /><br>
	<input class="reg" required placeholder="Повтор пароля" type="password" name="r_password" /><br><br>
	<input class="reg" style="cursor:pointer" type="submit" name="reg" value="Вход" />
	
	
	
	</form>


<?php
if (isset($_POST['reg'])) {
    $login = $_POST['login'];
    $pochta = $_POST['pochta'];
    $password = $_POST['password'];
    $r_password = $_POST['r_password'];
    $err = array();
    // проверяем равны ли пароли
    if (!($password === $r_password)) {
        $err[] = 'Пароль и повтор не совпадают';
    }
    // проверям логин
    if (!preg_match('/^[a-zA-Z0-9]+$/', $login)) {
        $err[] = 'Логин может состоять только из букв английского алфавита и цифр';
    }
    if (strlen($login) < 3 or strlen($login) > 20) {
        $err[] = 'Логин должен быть не меньше 3 символов и не больше 20';
    }
    
    // проверям почту
    if (!filter_var($pochta, FILTER_VALIDATE_EMAIL)) {
        $err[] = 'Почта указана не верно';
    }
    
    if (strlen($pochta) < 8 or strlen($pochta) > 30) {
        $err[] = 'Почта должна быть не меньше 8 символов и не больше 30';
    }
    
    
    // проверям пароль
    if (strlen($password) < 3 or strlen($password) > 20) {
        $err[] = 'Пароль должен быть не меньше 3 символов и не больше 20';
    }
    // проверяем, не сущестует ли пользователя с таким именем
    $password = md5($password);
    $user = new User($login, $password, $email);
    $isUser = $user->IsUserInBD();
    if ($isUser) {
        $err[] = 'Пользователь с таким логином уже существует';
    }
    // если нет ошибок, то добавляем в бд
    if (count($err) == 0) {
        echo $user->DB_Insert();
            
        //echo 'Регистрация успешна';
            
            

    
        $c_user = $user->IsUserInBD();
    
        $_SESSION['login'] = $user->login;
        $_SESSION['user_id'] = $c_user[0]['id'];
        $_SESSION['admin'] = $c_user[0]['admin'];
            
            
            

        echo '<script>history.go(-2)</script>';
        exit();
    } else {
        echo '<b>При регистрации произошли следующие ошибки:</b><br>';
        foreach ($err as $error) {
            echo $error.'<br>';
        }
    }
}
?>

</td></tr>
</div>
</body>
</html>
