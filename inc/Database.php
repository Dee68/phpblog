<?php
/************************************** 
***** include defined constants *******
**                           **********
***************************************/
include_once("config.php");

/****************************************
*** implementing the singleton pattern **
**                                     **
*****************************************/
define("DSN","mysql:host=".DB_HOST.";dbname=".DB_NAME);
class Database
{
	private static $instance;
	private $dbh;

	

  private function __construct() {
    try {
        $this->dbh = new PDO(DSN,DB_USER,DB_PASS);
        // set error level to warnings
        $this->dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->dbh->exec("SET NAMES 'utf8'");
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    
    }
 
  public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
/*****************************************
** creates a new row in  database table *
******************************************/
  
  public function create($sql, $params=[]){
    try 
    {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($params);
        return TRUE;
 
    } catch (PDOException $e) 
    {
       throw new Exception($e->getMessage());
       
    }

    }
 /**************************************
 ** gets all  rows from database table *
 ***************************************/
  
  public function getAll($sql, $params=[]){
    try 
    {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
 
    } catch (PDOException $e) 
    {
        throw new Exception($e->getMessage());
    }

    }
/*************************************
**  count numbers of row *************
*************************************/
public function countRows($sql,$params)
{
  $stmt = $this->dbh->prepare($sql);
        $stmt->execute($params);
  return $stmt->rowCount();
}

/****************************************
** gets single row from database table **
*****************************************/
  
  public function getOne($sql, $params=[]){
    try 
    {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
 
    } catch (PDOException $e) 
    {
        throw new Exception($e->getMessage());
    }

    }
/****************************************
** updates a row from database table **
*****************************************/
  
  public function updateData($sql, $params=[]){
   $this->create($sql,$params);

    }
    
 /****************************************
** deletes a row from database table **
*****************************************/
  
  public function deleteData($sql, $params=[]){
   $this->create($sql,$params);

    }

   //redirects
  public function redirect($url)
  {
    header("Location: $url");
  }
  
 
  public function disconnect() {
        $this->dbh = null;
    }

  private function __clone() {
      return false;
       
   }

  private function __wakeup() {
       return false;
   }
  
}
