<?php
namespace controllers;

use Core\View;
use Models\Db;

class Login
{
    public function index($pr = '')
    {
    	$title        = "LOGIN";
    	$errorPass    = "не верный логин или пароль";
    	$activeLogint = "active";
    	$f=FALSE;
    	if ($_POST['log'] ){
    		$u = new Db ("users");
			if ($u->where("email",$_POST['email'],"LIKE")->existence()){
				$data=$u->where("email",$_POST['email'],"LIKE")->get_one();
				if (password_verify ($_POST['pass'],$data['pass'])) {
					$_SESSION['id']=$data['id'];
					header("location: /");
				}else {
					$f=TRUE;
				}
			}else {
				$f=TRUE;
			}
			if ($f) View::render('login/index.php',compact('title','errorPass','activeLogint'));
		}
		else View::render('login/index.php',compact('title','activeLogint'));
       
    }
    public function register ($pr='')
    {
    	$title      = "REGISTER";
    	$activeRegi = "active";
		View::render('login/reg.php',compact('title','activeRegi'));
	}
}
