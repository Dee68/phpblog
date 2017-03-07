<?php
require_once("config.php");
require_once("Database.php");
/*
*
*
*/
class User extends Database
{
	private $db;
	//public $token;

	public function __construct()
	{
		$this->db = Database::getInstance();
	}
	
	 // registers user
    public function register($uname,$uemail,$upass)
    {
      
      $sql = "INSERT INTO user(username, email, password) VALUES(?,?,?)";
       $params=[$uname,$uemail,$upass]; 
       return $this->db->create($sql,$params);                               
       
    }
  //get users credentials fron database
  public function getUser($uemail,$upass)
  {
  	$sql = "SELECT * FROM user WHERE  email=? ";
	$params = [$uemail];
	$user = $this->db->getOne($sql,$params);
	return $user;
  }
  //
  public function dologin($uemail,$upass)
	{
		
			$sql = "SELECT * FROM user WHERE  email=? ";
			$params = [$uemail];
			$userRow = $this->getUser($uemail,$upass);
			
				if(password_verify($upass, $userRow['password']))
				{
					$_SESSION['user_session'] = $userRow['id'];
					return true;
				}
				else
				{
					return false;
				}
				
	}
	//checking if user is registered
	public function getuserName($name)
	{
		$sql = "SELECT * FROM user WHERE username=?";
		$params = [$name];
		$user = $this->db->getOne($sql,$params);
		if (!empty($user)) {
			return true;
		}else{
			return false;
		}

	}
	
	//
	public function getuserId($name)
	{
		$sql = "SELECT * FROM user WHERE username=?";
		$params = [$name];
		return $this->db->getOne($sql,$params);
	}
	//
	public function userUpdate($fn,$ln,$addr,$uimg,$name)
	{
      $sql = "UPDATE user SET firstname=?,lastname=?,address=?,
              userimage=? WHERE username=?";
        $params = [$fn,$ln,$addr,$uimg,$name];
        return $this->db->updateData($sql,$params);
	}
	//redirects
	public function redirect($url)
	{
		header("Location: $url");
	}
	//
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}

	}
}