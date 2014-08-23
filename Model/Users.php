<?php
include 'User.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users
 * @author Alexis
 */
class Users {

    protected $db;
    protected $userList;

    public function __construct() {
        $this->db = connectToDB();
        $this->userList = array();
        $reponse = $this->db->query("SELECT * FROM Users");
        $i = 0; 
        while ($donnees = $reponse->fetch()) {            
            $this->userList[$i](new User($donnees['id'], $donnees['firstname'], $donnees['lastname'], $donnees['password'], $donnees['email'], $donnees['createDate']));
            $i++;
            echo 'ok';
        }
    }

    public function addUser($firstname, $lastname, $password, $email) {
        //date à finir
        $date;
        $req = $this->db->prepare('INSERT INTO Users(firstname, lastname, password, email, createDate) VALUES(:firstname, :lastname, :password, :email, :createDate)');

        try {
            $success = $req->execute(array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'password' => $password,
                'email' => $email,
                'createDate' => $date
            ));

            if ($success) {
                $id = mysql_insert_id();
                $this->userList->push(new User($id, $firstname, $lastname, $password, $email, $date));
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }

    public function deleteUser(User $user) {
        $this->userList->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);
        while ($this->userList->valid() === true || $this->userList->current() !== $user) {
            $this->userList->next();
        }

        if ($this->userList->valid() === true && $this->userList->current() === $user) {
            $id = $this->userList->key();
            $deleteUser = $this->userList->current();
            $this->userList->offsetUnset($id);
            try {
                $this->db->exec('DELETE FROM users WHERE ID_No = ' . $deleteUser->getId());
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function modifyUsername(User $user, $name) {
        
    }

    public function modifyPassword(User $user, $name) {
        
    }

    public function modifyEmail(User $user, $name) {
        
    }

    //put your code here
}

function connectToDB() {

    $host = 'localhost';

    try {
        $user = 'root';
        $pass = 'root';
        $bdd = 'FitIzzyTest';
        $dns = 'mysql:host=' . $host . ';dbname=' . $bdd . '';
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        return $connexion = new PDO($dns, $user, $pass, $options);
    } catch (Exception $e) {
        echo "Fail to connect: ", $e->getMessage();
        die();
    }
}
