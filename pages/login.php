        <?php
require_once 'includes/db.php';
require_once 'includes/user.php';
require_once 'includes/functions.php';

// выход
if (isset($_POST['quit'])) {
    unset($_SESSION['login']);
    unset($user);
}
// авторизация
if (isset($_POST['enter'])) {
    $user = new User(clean($_POST['e_login']), clean($_POST['e_password']));
    
    //хеш пароля из базы
    $password_hash = $user->db_select_password();

    if (password_verify($user->password, $password_hash)) {
        $_SESSION['login'] = $user->login;
    } else {
        echo 'Введен неправильный логин или пароль';
    }
}


if (isset($_SESSION['login'])) {
    echo '<form id="form_quit" action="" method="post">';
    echo 'Вы вошли как: '.$_SESSION['login'].' ';
    echo '<br><input style="cursor:pointer" type="submit" name="quit" value="Выход" />
	</form>';
} else {
    echo '
		<form id="form_enter" action="" method="post">
		Авторизация / <a href="reg.php">Регистрация</a>
		<br>
		<input size="19" required placeholder="Имя" type="text" name="e_login" />
		<br>
		<input size="19" required placeholder="Пароль" type="password" name="e_password" />
		<br>
		<input style="cursor:pointer" type="submit" name="enter" value="Вход" />
		</form>';
}
?>
