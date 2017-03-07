<?php
/*******************************************
** validates users input fields ************
*******************************************/
include_once("config.php");

class Validation
{
  private $token;

  function __construct()
  {
    //$this->token = $_POST['token'];
  }
  //checks if field is empty
  function validEmpty($input){
    if (empty($input)) {
      return true;
    }else {
      return false;
    }
  }
  //checks for fullname field, allows only alpha and spaces
  function validCorrect($input){
    if (!preg_match("/^[a-zA-Z ]+$/",$input)) {
      return true;
    }else{
      return false;
    }
  }
  //checks email field
  function validEmail($input){
    if (!filter_var($input,FILTER_VALIDATE_EMAIL)) {
      return true;
    }else {
      return false;
    }
  }
  //checks the select field
  function validSelect($input){
    if ($input == "-- SELECT --") {
      return true;
    }else {
      return false;
    }
  }
  //checks upload field for file selection.
  function validateUploadE($input){
    $input = $_FILES['file']['name'];
    if ($input == "") {
      return true;
    }else {
      return false;
    }
  }
  //checks for file extensions
  function validateUploadEx($input){
    $allowedExts = array("jpg","jpeg","png");
    $input = $_FILES['file']['name'];
    $temp = explode(".",$input);
    $extensions = strtolower(end($temp));
    if (!in_array($extensions,$allowedExts)) {
      return true;
    }else {
      return false;
    }
  }
//checks for file size
function validateUploadS($input){
  //$allowedExts = array("jpg","jpeg","png");
  $input = $_FILES['file']['name'];
  $size = $_FILES['file']['size'];
  //100kb = 102400b
  if ($size > 409600) {
    return true;
  }else {
    return false;
  }
}
//validate token from hidden field
function validate_token()
{
    return ($this->token = $_SESSION['token'])? 1 : 0;
}

}

