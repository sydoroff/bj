<?php

require_once ($_SERVER['DOCUMENT_ROOT'].'/db/DB.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/lib/pagination.php');

/**
 * Class Model - main Query Processing
 * Name of DB table this is Class Name
 */
abstract class Model
{

    private $name;
    private $db;
    private $scope = null;
    private $order = ['query' => null, 'field' => null, 'dir' => null];
    private $paginate = ['query' => null, 'param' => null,'pages' => null];
    private $columns = null;

    function  __construct(){
            $this->db = DB::connect_db();
            $this->name=strtolower(get_class($this));
            $col=$this->db->query('SHOW COLUMNS FROM '.$this->name);
             while($row = $col->fetch()){
                 $this->columns[] = $row['Field'];
             }
    }

    /**
     * @return array like ['row' => array() of model rows, 'pagination' => array() of pagination parameters,
     *                     'order' =>  array() of order parameters]
     */

    function all(){
           $q = $this->db->query('select * from '.
                $this->name.' '.
                $this->scope.
                $this->order['query'].
                $this->paginate['query']);

           $q=$q->fetchAll();

           $qr['row'] = $q;

           if(!empty($this->paginate['param'])){
            $qr['pagination'] = $this->paginate['param'];
            $qr['pagination']['pages'] = $this->paginate['pages'];
           }

           if(!empty($this->order['query'])){
               $qr['order']['field'] = $this->order['field'];
               $qr['order']['dir'] = $this->order['dir'];
           }

           return $qr;
    }

    /**
     * @param $id - number id in table
     * @return array - model fields
     */
    function find($id){
        $q = $this->db->prepare('select * from '.$this->name.' where id = ?');
        $q->bindValue(1, $id, PDO::PARAM_INT);
        $q->execute();
        $q = $q->fetchAll();
        return $q[0];
    }

    /**
     * set paginate parameters
     * @param int $page
     * @param int $count
     * @return $this
     */
    function paginate($page = 1,$count = 3){
        if ($count<3) $count=3;
        if ($page<1) $page=1;
        $all = $this->db->query('select count('.$this->columns[0].') from '.$this->name.$this->scope)->fetchAll();
        if ($all[0]['count(id)']>$count)
            $last = ceil($all[0]['count(id)']/$count);
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

        $this->paginate['pages'] = pagination_render($q,['sort' => $this->order['field'], 'dir' => $this->order['dir']],$count);

        return $this;
    }

    /**
     * set order parameters
     * @param $field
     * @param $dir
     * @return $this
     */
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

    /**
     * set where parameter in query - not safe
     * should be called at first part
     * @param $scope
     * @return $this
     */
    function scope ($scope){
        if (!empty($this->scope))
            $this->scope.= ' and ';
        else
            $this->scope.= ' where ';
        $this->scope.=' '.$scope.' ';
        return $this;
    }

    /**
     * @return PDO - connection
     */
    function db(){
        return $this->db;
    }

    /**
     * @return string - Class Name
     */
    function getName()
    {
        return $this->name;
    }

    /**
     * @return null - Fields of Table
     */
    function getFields(){
        return $this->columns;
    }

}