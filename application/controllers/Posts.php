<?php
namespace controllers;

use Core\View;
use Core\Controller;
use Models\Db;

class Posts extends Controller
{
	private $postDb;

	public function __construct()
	{
		$this->postDb = new Db('post');
	}

	public function index($id)
	{
		if(!$id > 0){
			header("location: /");
			exit;
		}
		$title = "Просмотр Поста";
		$userId= $_SESSION['id'];
		$data  = $this->postDb->select("post.*, users.first_name f, users.last_name name")->join('users','post.user_id=users.id')->where('post.id',$id)->get_one();
		if($userId == $data['user_id']) $editMenu = 1;
		View::render('post/viewPost.php',compact('title','userId','editMenu','data'));

	}

	public function mypost($id = '')
	{
		$title        = "Мои посты";
		$userId       = $this->before ();
		$activeMyPost = "active";
		$data         = $this->postDb->where('user_id',$userId)->get_all();
		View::render('post/viewMyPost.php',compact('title','userId','activeMyPost','data'));
	}
	public function create ($pr = '')
	{
		$title     = "Создания поста";
		$userId    = $this->before ();
		$activeAdd = "active";
		if($_POST['addpost']){
			$titlePost    = $_POST['titlePost'];
			$content      = $_POST['textPost'];
			$nameImg      = $this->uploadImg($userId);
			$errorTitle   = "Заглавие должно быть больше 5 символов";
			$errorContent = "Посто должно быть больше 10 символов";
			if($nameImg == "er1") $errorFile = "картинка не является изображением";
			if($nameImg == "er2") $errorFile = "картинка не загрузилась";
			if($nameImg == "er3") $errorFile = "нужно выбрать картинку";
			$nameForm  = array('title','userId','activeAdd','titlePost','content');
			//проверка
			if(!preg_match('/[\wА-Яа-я ]{5,}/', $titlePost))$this->verifyForm(compact('errorTitle',$nameForm),'Create');
			if(!preg_match('/[\wА-Яа-я ]{10,}/', $content))$this->verifyForm(compact('errorContent',$nameForm),'Create');
			if($nameImg == "er1" || $nameImg == "er2" || $nameImg == "er3") $this->verifyForm(compact('errorFile',$nameForm),'Create');


			$data = array (
				'user_id'=> $userId,
				'title'  => $titlePost,
				'content'=> $content,
				'image'  => $nameImg
			);
			$postTab = new Db ('post');
			$idPost  = $postTab->insert($data);
			header("location: /posts/$idPost");
		}
		else
		{
			View::render('post/viewCreatePost.php',compact('title','userId','activeAdd'));
		}
	}
	public function edit ($id)
	{

		$title      = "Мои посты";
		$postTab    = new Db ('post');
		$dataPost   = $postTab->where('id',$id)->get_one();
		$userId     = $this->before ($dataPost['user_id']);
		$nameImgWay = $dataPost['image'];
		$activeEdit = "active";
		$editMenu   = 1;
		if($_POST['editpost']){
			$titlePost    = $_POST['titlePost'];
			$content      = $_POST['textPost'];
			$nameImg      = $this->uploadImg($userId);
			$errorTitle   = "Заглавие должно быть больше 5 символов";
			$errorContent = "Посто должно быть больше 10 символов";
			if($nameImg == "er1") $errorFile = "картинка не является изображением";
			if($nameImg == "er2") $errorFile = "картинка не загрузилась";
			if($nameImg == "er3")$nameImg = $nameImgWay ;
			$nameForm= array('title','userId','activeEdit','editMenu','titlePost','content','nameImgWay');
			//проверка
			if(!preg_match('/[\wА-Яа-я ]{5,}/', $titlePost))$this->verifyForm(compact('errorTitle',$nameForm),'Edit');
			if(!preg_match('/[\wА-Яа-я ]{10,}/', $content))$this->verifyForm(compact('errorContent',$nameForm),'Edit');
			if($nameImg == "er1" || $nameImg == "er2" || $nameImg == "er3") $this->verifyForm(compact('errorFile',$nameForm),'Edit');


			$data = array (
				'title'  => $titlePost,
				'content'=> $content,
				'image'  => $nameImg
			);
			//удаление старрой картинки
			if ($nameImgWay!=$nameImg) 	unlink( ROOT_FOLDER ."public/user_img/$nameImgWay");
			$postTab = new Db ('post');
			$idPost  = $postTab->update($data,$id);
			header("location: /posts/$idPost");

		}
		else
		{
			$titlePost = $dataPost['title'];
			$content   = $dataPost['content'];
			$arg       = array('title','userId','titlePost','activeEdit','editMenu','content','nameImgWay');
			$this->verifyForm(compact($arg),'Edit');
		}

	}
	public function delete ($id)
	{
		$post   = new Db('post');
		$userId = $_SESSION['id'];
		$data   = $post->where('id',$id)->get_one();
		$wayImg = ROOT_FOLDER ."public/user_img/".$data['image'];
		if($userId == $data['user_id'])
		{
			if ($post->delId($id))
				unlink($wayImg);
		}
		$this->mypost();
	}
	private function uploadImg ($userId)
	{
		//проверка на выбран файл или нет
		if( $_FILES['imgPost']['name'] == '') return "er3";
		//проверка на тип файла
		$types = array('image/gif','image/png','image/jpeg');
		if(!in_array($_FILES['imgPost']['type'], $types)) return "er1";
		// создания пути
		$way       = ROOT_FOLDER ."/public/user_img/$userId/";
		//создания имя файла
		$nameNew   = time()."_". $_FILES['imgPost']['name'];
		//пусть и файлем
		$full_path = $way . $nameNew;
		// создания каталогов
		if(!file_exists($way))	mkdir($way,0777,TRUE);
		//загрузка файла на сервер
		if($_FILES['imgPost']['error'] == 0)
		{
			if(move_uploaded_file($_FILES['imgPost']['tmp_name'], $full_path))
			{
				return $userId . "/" . $nameNew;
			}
			else return "er2";
		}
		else return "er2";
	}
	private function verifyForm ($arg,$name)
	{
		View::render("post/view".$name."Post.php",$arg);
		exit;
	}
}
