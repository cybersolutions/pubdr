<?php
namespace Test\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Debug\Debug;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Db\Sql\Select;

class GlobalAccess
{
    protected $adapter;
    protected $db;

    
    public function __construct()
    {
      
        $this->db = new Db();
        $this->adapter = new Adapter($this->db->configArray);
        //$this->initialize();
    }

    /**
    * Fetch multi rows object (GLOBAL)
    * @param String $qry SQL Query
    * @return ResultInterface
    */
    public function fetchAllRow($qry='')
    {
        /*$resultSet = $this->tableGateway->select();
        return $resultSet;*/
        $statement = $this->adapter->query($qry);
        //$results = $statement->execute(array('id' => 1));
        $results = $statement->execute();

        return $results;
    }
    
    
    /**
    * Fetch single row (GLOBAL)
    * @param String $qry SQL Query
    * @return Object
    */
    public function fetchSingleRow($qry='')
    {
        $row = '';
        $statement = $this->adapter->query($qry);
        //$results = $statement->execute(array('id' => 1));
        $results = $statement->execute();
        // get info into array
        if($results->count()>0){
          foreach($results as $rows){
            $row = (object)$rows;
          }
        }
        return $row;
    }
    
    /**
    * Insert records into table (GLOBAL)
    * @param String $table Table name
    * @param Array $data Inserted values
    * @return Boolean Whether inserted or not(true/false)
    */
   public function insertMyTable($table='',$data=array())
   {
     //$this->adapter = new Adapter($this->configArray);
     // INSERT INTO $table() VALUES('','')
     if ((!empty($table)) && (!empty($data)) && (count($data) > 0)) {
       // prepare Insert statements
       $cnt = 1;
       $col = '';
       $colV = '';
       foreach($data as $key => $val) {
         if($cnt == count($data)){
           $col .= "$key";
           $colV .= "'$val'";
         }else{
           $col .= "$key" . ",";
           $colV .= "'$val'" . ",";
         }

         $cnt++;
       }
       // prepare Query
       $sql = "INSERT INTO $table($col) VALUES($colV)";
       $results = $this->adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);
       
       //get last inserted id instantly
       $lastId = $this->myLastInsertId();
       
       if($results->count() > 0) {
         return $lastId;
       } else {
         return false;
       }
       

     } else {
       return false;
     }

   }
   
   
   /**
    * Insert records into table by SQL QUERY (GLOBAL)
    * @param String $qry full query
    * @return Boolean Whether inserted or not(true/false)
    */
   public function insertMyTableByQuery($qry='')
   {
     //$this->adapter = new Adapter($this->configArray);
     // INSERT INTO $table() VALUES('','')
     if (!empty($qry)) {
       
       $results = $this->adapter->query($qry,Adapter::QUERY_MODE_EXECUTE);
       
       //get last inserted id instantly
       $lastId = $this->myLastInsertId();
       
       if($results->count() > 0) {
         return $lastId;
       } else {
         return false;
       }
       

     } else {
       return false;
     }

   }
   
   
   /**
    * Execute query by SQL QUERY (GLOBAL)
    * @param String $qry full query
    * @return Boolean Whether inserted/deleted/updated or not(true/false)
    */
   public function execMyTableByQuery($qry='')
   {
     //$this->adapter = new Adapter($this->configArray);
     // INSERT INTO $table() VALUES('','')
     if (!empty($qry)) {
       
       $results = $this->adapter->query($qry,Adapter::QUERY_MODE_EXECUTE);
       
       if($results->count() > 0) {
         return true;
       } else {
         return false;
       }
       

     } else {
       return false;
     }

   }
   
   
   /**
    * Update records (GLOBAL)
    * @param String $table Table name
    * @param Array $Data Array of data
    * @param String $pCol Column name used in WHERE clause
    * @param String $pColVal Column value used in WHERE clause
    * @return Boolean Whether inserted or not(true/false)
    */
   public function updateMyTable($table='', $data=array(), $pCol = '', $pColVal='')
   {
     // UPDATE table SET col1 = '', col2 = '' WHERE id = ''
     if ((!empty($table)) && (!empty($data)) && (count($data) > 0)) {
       // prepare Insert statements
       $cnt = 1;
       $st = '';
       foreach($data as $key => $val) {
         if($cnt == count($data)){
           $st .= $key . " = '$val'";
         }else{
           $st .= $key . " = '$val'" . ",";
         }

         $cnt++;
       }
       // prepare Query
       $sql = "UPDATE $table SET $st WHERE $pCol = '$pColVal'";
       $results = $this->adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);
       
       if($results->count() > 0) {
         return true;
       } else {
         return false;
       }
       

     } else {
       return false;
     }

   }
   
   
   /**
    * Get Last Insert ID (GLOBAL)
    * @return Int get last id
    */
   public function myLastInsertId()
   {
      $myId = 0;
      $sql = "SELECT @@IDENTITY AS mixLastId;";
      $statement = $this->adapter->query($sql);
      //$results = $statement->execute(array('id' => 1));
      $results = $statement->execute();
      foreach($results as $row){
        $myId = $row['mixLastId'];
      }
      return $myId;
   }


}