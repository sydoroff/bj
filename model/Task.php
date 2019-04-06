<?php

require_once ('Model.php');

class Task extends Model{

    function create(array $arr){
              $q = $this->db()->prepare('INSERT INTO '.$this->getName().' (name, email, text, hash) VALUES (?, ?, ?, ?)');
              $q->bindValue(1, $arr['name']);
              $q->bindValue(2, $arr['email']);
              $q->bindValue(3,$arr['text']);
              $q->bindValue(4,password_hash($_SERVER["REMOTE_ADDR"].$arr['email'].pow(rand(1,10000),
                                      rand(1,10000)).$arr['name'].time()/rand(1,10),
                                 PASSWORD_DEFAULT));
              $q->execute();
              return $this->db()->lastInsertId();
    }

    function update($id,$text,$status){
               $q = $this->db()->prepare('UPDATE  '.$this->getName().' SET text = ?, status = ? where id = ?');
               $q->bindValue(1, $text);
               $q->bindValue(2, $status);
               $q->bindValue(3, $id);
        return $q->execute();
    }

    /**
     * This function is disabled, at your request
     * @param $id
     * @return bool
     */
    function verify($id){
               $q = $this->db()->prepare('UPDATE  '.$this->getName().' SET verified = \'1\' where id = ?');
               $q->bindValue(1, $id);
        return $q->execute();
    }
}
