<?php
class DB extends Connection {

    function __construct() { 
		parent::__construct();
    }

    public function put(){
        // print_r(json_encode( json_decode( utf8_decode(base64_decode($_POST['db'])))));die;
      
      $this->pdo = $this->db->prepare("
          UPDATE finsystem.dataset SET db = ? WHERE UPPER(uid) = UPPER(?) ;
      ");
      $this->pdo->bindValue(1, json_encode( json_decode( utf8_encode(base64_decode($_POST['db'])))));
      $this->pdo->bindValue(2, $_POST['uid']);
      $this->pdo->execute();

      callback::Set('message', 'Atualizado');
      callback::Set('error', false);
        return callback::GetCallBack();
    }

    public function get(){
      $this->pdo = $this->db->prepare("
          SELECT db FROM finsystem.dataset
            WHERE UPPER(uid) = UPPER(?)
      ");
      $this->pdo->bindValue(1,$_POST['uid']);
      $this->pdo->execute();
      $stmt = $this->pdo->fetchAll(PDO::FETCH_OBJ);

      if(count($stmt) > 0){
          callback::Set('value', $stmt[0]->db);
          callback::Set('error', false);
      }else{
          callback::Set('message', 'Erro ao carregar o banco de dados.');
      }

      return callback::GetCallBack();
    }

}
