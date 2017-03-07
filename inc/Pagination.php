<?php
/*
*
*/

class Pagination
{
	/*
  *@folder paremeter path to model folder
  * @total parameter count of total items in model
  *@page-count number of items per page
  * @all assoc array of all items in model
  */
	
	public static function do_pagination($folder,$total, $page_count, $all=array())
	{
		 if (empty($_GET["pg"])) {
               $current_page = 1;
             } else {
               $current_page = $_GET["pg"];
             }
             // set strings like "drop" to 0; remove decimals
             $current_page = intval($current_page);
             
             $total_pages = ceil($total / $page_count);

             // redirect too-large page numbers to the last page
             if ($current_page > $total_pages) {
               header("Location: ./?pg=" . $total_pages);
             }elseif ($current_page < 1) {
               header("Location: ./");
             }
             $start = (($current_page - 1) * $page_count) + 1;
             $end = $current_page * $page_count;
             if ($end > $total) {
               $end = $total;
             }
               $i = 0; 
  while ($i < $total_pages){
     $i += 1; 
    if ($i == $current_page){
      echo "<span>". $i ."</span>";
    } else {
      echo '<a href="'.$folder.'/?pg='.$i.'">'. $i.'</a>';
    }
    
  }
           
          return self::get_user_subset($start,$end,$all);
}
/*
*@ returns an assoc array of items in model i.e a subset of all
*/
public  static function get_user_subset($positionStart, $positionEnd,$all)
{
   $subset = array();
   $position = 0;
   foreach ($all as $user) {
     $position +=1;
     if ($position >= $positionStart && $position <= $positionEnd) {
       $subset[] = $user;
     }
   }

   return $subset;
}
}