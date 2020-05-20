<?php
namespace controllers;

use Core\View;
use Models\Db;

class IndexPage
{
    public function index($pr = '')
    {	$title    = "Главная";
    	$userId   = $_SESSION['id'];
		$posts    = new Db ("post");
		$dataPost = $posts->select("post.*, users.first_name f, users.last_name name")->join('users','post.user_id=users.id')->get_all();
   		View::render('index/index.php',compact('title','userId','dataPost'));		
    }
}
