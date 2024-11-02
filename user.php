<?php

  class User{

    private $pdo;
    private $dbname;
    private $host;
    private $user;
    private $pass;

    public function __construct($dbname, $host, $user, $pass){
        try {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $pass);
        } catch (PDOException $e) {
            echo"Erro com o banco de dados: ".$e->getMessage();
        } catch (Exception $e) {
            echo"Erro genérico: ".$e->getMessage();
        }
    }

    public function createAccount($user, $pass){
        try {
            
            //Cadastrando um novo usuário
            $cmd = $this->pdo->prepare("insert into tbuser(username, pass) values(:u, :p)");
            $cmd->bindValue(":u", $user);
            $cmd->bindValue(":p", $pass);
            $cmd->execute();
        
        } catch (PDOException $e) {
            echo"Erro com o banco de dados: ".$e->getMessage();
        } catch (Exception $e) {
            echo"Erro genérico: ".$e->getMessage();
        }
    }

    public function login($user, $pass){
        try {
            $res = array();
            $cmd = $this->pdo->prepare("select *from tbuser where username = :u and pass = :p");
            $cmd->bindValue(":u", $user);
            $cmd->bindValue(":p", $pass);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            echo"Erro com o banco de dados: ".$e->getMessage();
        } catch (Exception $e) {
            echo"Erro genérico: ".$e->getMessage();
        }
    }
  }

?>