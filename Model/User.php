<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User{
    protected $id;
    public $firstname;
    public $lastname;
    public $password;
    public $email;
    public $createDate; 
    
    public function __construct($id, $firstname, $lastname, $password, $email, $createDate) {
        $this->firstname = $firstname;
        $this->password = $password;
        $this->email = $email;
        $this->createDate = $createDate;
        $this->id = $id;
        $this->lastname = $lastname;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getFirstname() {
        return $this->firstname;
    }
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    } 
    
     public function getLastname() {
        return $this->firstname;
    }
    public function setLastname($Lastname) {
        $this->lastname = $Lastname;
    } 
    
    
    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    } 
    
    
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    } 
    
    
    public function getCreateDate() {
        return $this->createDate;
    }
}