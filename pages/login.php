        <?php
require_once 'includes/db.php';
require_once 'includes/user.php';
require_once 'includes/functions.php';

// выход
if (isset($_POST['quit'])) {
    unset($_SESSION['login']);
    unset($_SESSION['user_id']);
    unset($_SESSION['admin']);
    unset($user);
    unset($current_user);
}
// авторизация
if (isset($_POST['enter'])) {
    $user = new User(clean($_POST['e_login']), md5(clean($_POST['e_password'])));
    $current_user = $user->IsUserInBD();
    if ($current_user['password'] === ($user->password)) {
        $_SESSION['login'] = $user->login;
        $_SESSION['user_id'] = $current_user['id'];
        $_SESSION['admin'] = $current_user['admin'];
    } else {
        echo 'Введен неправильный логин или пароль';
    }
}


if (isset($_SESSION['login'])) {
    echo '<form id="form_quit" action="" method="post">';
    echo 'Вы вошли как: '.$_SESSION['login'].' ';
    echo '<br><input style="cursor:pointer" type="submit" name="quit" value="Выход" />
	</form>';
    if ($_SESSION['admin']==1) {
        echo '<br><a href="admin/admin.php">Админ-панель</a>';
    }
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
