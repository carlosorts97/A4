<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of DB
 *
 * @author linux
 */
namespace App\Sys;

require 'Helper.php';
use App\Sys\Helper;

class DB extends \PDO{
    private $stmt;
    static private $_instance=null;
    
    static function getInstance(){
        if(!(self::$_instance instanceof self)){
            self::$_instance=new self();
        }
        return self::$_instance;
    }
    function __construct(){
       
        $dbconf=Helper::getConfig();
        
        $dsn=$dbconf['driver'].':host='.$dbconf['dbhost'].';dbname='.$dbconf['dbname'];
        $usr=$dbconf['dbuser'];
        $pwd=$dbconf['dbpass'];
        
        parent::__construct($dsn,$usr,$pwd);
    }
  
    public function query($query){
       $this->stmt= $this->prepare($query);
       var_dump($query);
    }
   
    public function bind($parametro, $var) {
        switch (true){
            case is_int($var): $type = self::PARAM_INT;
                break;
            case is_bool($var): $type = self::PARAM_BOOL;
                break;
            case is_null($var): $type = self::PARAM_NULL;
                break;
            default: $type = self::PARAM_STR;
        }
        $this->stmt->bindValue($parametro, $var, $type);
    }
    
    public function execute() {
        $result = $this->stmt->execute();
       
        var_dump($result);
        if($result==true)
        {
            echo'Ejecutado correctamente ';
        }
        else{
            echo'Error al ejecutar consulta ';
        }
    }
    
    public function resultSet(){
        $result = $this->stmt->fetchAll(self::FETCH_ASSOC);
        return $result;
    }
    
    public function single(){
        $result = $this->stmt->fetch(self::FETCH_ASSOC);
        return $result;
        
    }
    
    public function rowCount(){
        $result = $this->stmt->rowCount();
        print_r($result);
    }
    
    public function beginTransaction() {
        parent::beginTransaction();
    }
    
    public function endTransaction() {
        self::commit();
    }
    
    public function reverTransaction() {
        self::rollback();
    }
}
