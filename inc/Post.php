<?php
require_once("config.php");
require_once("Database.php");

/**
* 
*/
class Post extends Database
{
	private $db;

	function __construct()
	{
		$this->db = Database::getInstance();
	}

	//return all posts in order of descendence
	public function getPosts()
	{
		$sql = "SELECT posttitle,postcontent,postdate,postid,postimage,catname,username FROM posts p 
       JOIN category c, user u WHERE p.category = c.catid AND p.author = u.id Order by postdate desc";
		$params=[];
		return $this->db->getAll($sql,$params);
	}
	
	//get a single post from a given postid
	public function getpost($postid)
	{
	 $sql = "SELECT postid,posttitle,postcontent,category,posttag,postimage,catid,
	         catname,id,username FROM posts p 
             JOIN category c, user u WHERE 
             p.category = c.catid AND p.author = u.id 
             AND postid=?";
     $params = [$postid];
     return $this->db->getOne($sql,$params);
  
	}
	//return number of posts in posts table
	public function postCount()
	{
		$sql = "SELECT posttitle,postcontent,postdate,postid,postimage,catname,username FROM posts p 
       JOIN category c, user u WHERE p.category = c.catid AND p.author = u.id Order by postdate desc";
		$params=[];
		return $this->db->countRows($sql,$params);
	}
	//return number of comments in comments table
	public function comCount()
	{
		$sql = "SELECT * FROM comments";
		$params = [];
		return $this->db->countRows($sql,$params);
	}
	//return number of categories in category table
	public function catCount()
	{
		$sql = "SELECT * FROM category";
		$params = [];
		return $this->db->countRows($sql,$params);
	}
	//update post
	public function postupdate($title,$content,$category,$author,$tag,$pimage,$id)
	{
	 $sql = "UPDATE posts SET posttitle=?,postcontent=?,category=?,author=?,posttag=?,postimage=? WHERE postid = ?";
	 $params =[$title,$content,$category,$author,$tag,$pimage,$id];
	 return $this->db->updateData($sql,$params);
	}
	//delete post
	public function delPost($id)
	{
       $sql = "DELETE FROM posts WHERE postid=?";
       $params = [$id];
       return $this->db->deleteData($sql,$params);
	}
	//
	public function getpostauthor($id)
	{
		$sql = "SELECT postdate,posttitle,username FROM posts p JOIN user u WHERE p.author=u.id AND p.author=?";
		$params = [$id];
		return $this->db->getOne($sql,$params);
	}
	//get posts of same category
	public function getpostCat($cat)
	{
		$sql = "SELECT posttitle,postcontent,postdate,postid,postimage,catname,author FROM posts p 
       JOIN category c WHERE p.category = c.catid AND  c.catid=?";
       $params = [$cat];
       return $this->db->getAll($sql,$params);
	}
	//get all categories
	public function getCat()
	{
		$sql = "SELECT * FROM category";
        $params = [];
        return $this->db->getAll($sql,$params);
	}
	//
	public function getComments()
	{
		$sql = "SELECT * FROM comments";
		$params = [];
		return $this->db->getAll($sql,$params);
	}
	//delete comment
	public function delcomment($id)
	{
       $sql = "DELETE FROM comments WHERE id=?";
       $params = [$id];
       return $this->db->deleteData($sql,$params);
	}
	//get user name from comments table
	public function getauthor($id)
	{
		$sql = "SELECT comment,username FROM comments c JOIN user u WHERE c.commentator=u.id AND c.post =?";
		$params = [$id];
		return $this->db->getOne($sql,$params);
	}
	//
	public function createComments($comm,$post,$author)
	{
		$sql = "INSERT INTO comments(comment,post,commentator) VALUES(?,?,?)";
		$params = [$comm,$post,$author];
		return $this->db->create($sql,$params);
	}
	//create a post
	public function createPost($title,$content,$category,$author,$tag,$image)
	{
     $sql = "INSERT INTO posts(posttitle,postcontent,category,posttag,postimage,author) VALUES(?,?,?,?,?,?)";
      $params = [$title,$content,$category,$tag,$image,$author];
      return $this->db->create($sql,$params);
	}
	//get post by postid
	public function getPostId($id)
	{
		$sql = "SELECT posttitle,postcontent,postdate,postid,postimage,username FROM posts p JOIN user u WHERE p.author = u.id AND p.postid = ?";
		$params = [$id];
		return $this->db->getOne($sql,$params);

	}
	//get post by post tag:search by post tag
	public function getPostTag($param)
	{
		$terms = explode(" ", $param);
		$sql = "SELECT * FROM posts WHERE ";
		$i=0;
		foreach ($terms as $each) {
			$i++;
			if ($i==1) {//one occurence
				$sql .= "posttag LIKE '%$each%' ";
			}else{//multiple occurence
               $sql .= "OR LIKE '%$each%' ";
			}
		}
		$params = [$each];
		return $this->db->getAll($sql,$params);
	}
	//get pages
	public function getPages()
	{
		$sql = "SELECT * FROM pages";
		$params = [];
		return $this->db->getAll($sql,$params);
	}
	//create pages
	public function creatPage($title,$published,$content,$slug)
	{
		$sql = "INSERT INTO pages(title,is_published,body,slug) VALUES(?,?,?,?)";
		$params=[$title,$published,$content,$slug];
		return $this->db->create($sql,$params);
	}
	//delete page
	public function delPage($id)
	{
       $sql = "DELETE FROM pages WHERE pageid=?";
       $params = [$id];
       return $this->db->deleteData($sql,$params);
	}
	//get page by id
	public function getPage($id)
	{
		$sql = "SELECT * FROM pages WHERE pageid=?";
		$params = [$id];
		return $this->db->getOne($sql,$params);
	}
	//get page by title
	public function getPageT($title)
	{
		$sql = "SELECT * FROM pages WHERE title=?";
		$params = [$title];
		return $this->db->getOne($sql,$params);
	}
	//update page
	public function updatePage($pagetitle,$radio,$pagebody,$pageslug,$id)
	{
		$sql = "UPDATE pages SET title=?,is_published=?,body=?,slug=? WHERE pageid=?";
		$params = [$pagetitle,$radio,$pagebody,$pageslug,$id];
		return $this->db->updateData($sql,$params);
	}
}