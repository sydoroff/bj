<?php

require_once ($_SERVER['DOCUMENT_ROOT'].'/db/DB.php');

class Model
{

    private $name;
    private $db;
    private $scope = null;
    private $order = ['query' => null, 'field' => null, 'dir' => null];
    private $paginate = ['query' => null, 'param' => null];
    private $columns = null;

    function  __construct(){
            $this->db = DB::connect_db();
            $this->name=strtolower(get_class($this));
            $col=$this->db->query('SHOW COLUMNS FROM '.$this->name);
             while($row = $col->fetch()){
                 $this->columns[] = $row['Field'];
             }
    }

    function all(){
           $q = $this->db->query('select * from '.
                $this->name.' '.
                $this->order['query'].
                $this->paginate['query']);

           $q=$q->fetchAll();

           $q['row'] = $q;

           if(!empty($this->paginate['param']))
            $q['pagination'] = $this->paginate['param'];

           if(!empty($this->order)){
               $q['order']['field'] = $this->order['field'];
               $q['order']['dir'] = $this->order['dir'];
           }

           return $q;
    }

    function find($id){
        $q = $this->db->prepare('select * from '.$this->name.' where id = ?');
        $q->bindValue(1, $id, PDO::PARAM_INT);
        $q->execute();
        $q = $q->fetchAll();
        return $q[0];
    }

    function paginate($page = 1,$count = 3){
        if ($count<3) $count=3;
        if ($page<1) $page=1;
        $all = $this->db->query('select count('.$this->columns[0].') from '.$this->name)->fetchAll();
        if ($all[0]['count(id)']>$count)
            $last = intval($all[0]['count(id)']/$count)+1;
        else
            $last = 1;

        $count = intval($count);
        $start = intval($count*$page-$count);
        $this->paginate['query'] = " limit $start, $count";

        $q['first_page']   = 1;
        $q['current_page'] = $page;
        $q['last_page']    = $last;
        $q['count']        = $all[0]['count(id)'];
        $this->paginate['param'] = $q;

        return $this;
    }

    function order($field,$dir){

        if (in_array($field,$this->columns)){
            $this->order['query'] = ' order by '.$field;
            $this->order['field'] = $field;
            if ($dir=='desc') {
                $this->order['query'].=' desc';
                $this->order['dir'] = 'desc';
            }else{
                $this->order['dir'] = 'asc';
            }
        }


        return $this;
    }

    function scope ($scope){
        $this->scope=' '.$scope.' ';
        return $this;
    }

    function db(){
        return $this->db;
    }

    function getNmae()
    {
        return $this->name;
    }

    function getFields(){
        return $this->columns;
    }

}