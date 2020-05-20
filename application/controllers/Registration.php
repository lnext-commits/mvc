<?php
namespace controllers;

use Core\View;
use Models\Db;

class Registration
{
	private $uTab;
	
    public function index($pr = '')
    {
		if ($_POST['reg'] ){
			$this->uTab = new  Db ("users");
			$title      = "REGISTER";
			$email      = $_POST['email'];
			$pass       = $_POST['pass'];
			$first_name = $_POST['first_name'];
			$last_name  = $_POST['last_name'];
			$birthday   = $_POST['birthday'];
			$errorEmail = "не верный email";
			$errorPass  = "слишком простой пароль";
			$errorFirst = "должно больше 2 символов";
			$errorLast  = "должно больше 2 символов";
			$nameForm   = array('title','email','pass','first_name','last_name','birthday');
			if (!$this->verify($_POST['email'])){
				//проверка
				if (!preg_match('/[0-9a-z]+@[a-z]/', $email)) $this->verifyForm(compact('errorEmail',$nameForm));
				if (!preg_match('/[-_a-zA-Z0-9]{6,}/', $pass)) $this->verifyForm(compact('errorPass',$nameForm));
				if (!preg_match('/[A-Za-zА-Яа-я]{2,}/', $first_name))$this->verifyForm(compact('errorFirst',$nameForm));
				if (!preg_match('/[A-Za-zА-Яа-я]{2,}/', $last_name)) $this->verifyForm(compact('errorLast',$nameForm));
				$pass=password_hash($pass,PASSWORD_DEFAULT);
				//Запись в базу данных
				$data = array (
					'email' => $email,
					'pass' => $pass,
					'first_name' => $first_name,
					'last_name' => $last_name,
					'birthday' => $birthday
				);
				$idUser=$this->uTab->insert($data);
				$_SESSION['id']=$idUser;
				header("location: /");
			}else 
				$errorEmail = 'такой email зарегистрирован';
				$this->verifyForm(compact('errorEmail',$nameForm));
		}
       
    }
    private function verify ($email)
    {
		return $this->uTab->where("email",$email,"LIKE")->existence();
	}
	private function verifyForm ($arg) 
	{
		View::render('login/reg.php',$arg);
		exit;
	}
	
}
