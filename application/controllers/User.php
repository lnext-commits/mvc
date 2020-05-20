<?php
namespace controllers;

use Models\Db;
use Core\Controller;
use Core\View;

class User extends Controller
{
	private $usTab;
	
	public function __construct()
	{
		$this->usTab = new Db('users');
	}
    public function index($pr = '')
    {
    	$userId    = $this->before ();
    	if ($_POST['saveProf']) $this->saveProf($userId);
    	$editActive= ($_POST['editProf'])?TRUE:FALSE;
        $title     = "Профиль пользователя";
        $activeProf= "active";
        $data      = $this->usTab->where('id',$userId)->get_one();
        View::render('user/viewUser.php',compact('title','userId','activeProf','editActive','data'));
    }

    public function pass($id)
    {
    	$userId    = $this->before ();
    	if ($_POST['savePass']) $this->editPass($userId);
    	$title     = "Профиль изменения пароля";
    	$activeProf= "active";
    	View::render('user/viewPass.php',compact('title','userId','activeProf'));
       
    }
    private function saveProf ($id)
    {
		$dataU = array (
			'email'  => $_POST['email'],
			'first_name'=> $_POST['first_name'],
			'last_name'=> $_POST['last_name'],
			'birthday'  => $_POST['birthday']
		);
		$this->usTab->update($dataU,$id);
	}
	private function editPass ($id)
	{
		$data      = $this->usTab->where('id',$id)->get_one();
		if (password_verify ($_POST['oldPass'],$data['pass'])) 
		{
			$pass = $_POST['newPass'];
			if (preg_match('/[-_a-zA-Z0-9]{6,}/', $pass))
			{
				$pass=password_hash($pass,PASSWORD_DEFAULT);
				$dataP =array ('pass' => $pass);
				$this->usTab->update($dataP,$id);
				$_SESSION ['alertPass']['eror'] = 1;
				$_SESSION ['alertPass']['message'] = "пароль успешно изменен";
				
			} 
			else
			{
				$_SESSION ['alertPass']['eror'] = 2;
				$_SESSION ['alertPass']['message'] = "слишком простой пароль";
			}
		}
		else
		{
			$_SESSION ['alertPass']['eror'] = 3;
			$_SESSION ['alertPass']['message'] = "пароль не верный";
		}
		header("location: /user");	
	}
}
