<?php

// crud
// create - insert
// read - select
// update - update
// delete - delete

class user
{
    public function User($login, $password, $email, $admin = null)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        if (isset($admin)) {
            $this->admin = $admin;
        }
    }

    public function db_insert()
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO users (login, password, email) VALUES (:login, :password, :email)');
        $stmt->bindParam(':login', $this->login);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':password', $this->email);
        $stmt->execute();
    }


    public function db_select()
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM users WHERE login = ?');
        $stmt->execute(array($this->login));
        $result = $stmt->fetch();

        return $result;
    }
}