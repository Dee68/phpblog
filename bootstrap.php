<?php
/************************************
*** auto loads the required classes**
*************************************
*/
spl_autoload_register(function ($class){
  $classPath = str_replace('\\','/',$class);
  include __DIR__ ."/inc/". $classPath .".php";
});

//formats date
function formatDate($date)
{
  return date('F j, Y , g : i a',strtotime($date));
}
//shortens text
function shortenText($text,$limit=330)
{
  $text = substr($text,0, $limit);
  $text = substr($text,0,strrpos($text, ' '));
  return $text."  ...";
}
/*******************************************
** helper functions to set & display messages*
********************************************
*/
function set_message($msg){
  if (!empty($msg)) {
    $_SESSION['message'] = $msg;
  }else {
    $msg = "";
  }
}
/*******************************************/
function display_message(){
  if(isset($_SESSION['message'])){
    echo "<div class='alert alert-success text-center'>"
    .$_SESSION['message'].
    "</div>";
    unset($_SESSION['message']);
  }
}