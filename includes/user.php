<?php

// crud
// create - insert
// read - select
// update - update
// delete - delete

class user
{
    public function User($login, $password, $email = null, $admin = null)
    {
        $this->login = $login;
        $this->password = $password;       
        if (isset($email)) {
            $this->email = $email;
        }
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
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
    }


    public function db_select_id()
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT id FROM users WHERE login = ?');
        $stmt->execute(array($this->login));
        $result = $stmt->fetch();

        return $result;
    }

    public function db_select_password()
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT password FROM users WHERE login = ?');
        $stmt->execute(array($this->login));
        $result = $stmt->fetch();

        return $result;
    }
}