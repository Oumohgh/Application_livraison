<?php 

abstract class Utilisateur {
  protected $name;
  protected $id;
  protected $email;
  protected $password;
  
  public function __construct($name ,$email,$password) {
    $this->name = $name;
    $this ->email=$email;
    $this ->password=$password;
  }
   abstract protected function connexion();
   abstract protected function deconnexion();
  
}