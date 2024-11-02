<?php
   class Message{
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

      public function recordMsg($vd, $msg){
        try {
            //code...
        } catch (PDOException $e) {
            echo"Erro com o banco de dados: ".$e->getMessage();
        } catch (Exception $e) {
            echo"Erro genérico: ".$e->getMessage();
        }
      }
   }
?>