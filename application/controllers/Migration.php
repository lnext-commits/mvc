<?php
namespace controllers;
use Models\Db;
class Migration
{
	public function index($p = '')
	{
		$flag    = 0;
		$message = "";
		$m    = new Db('users');
		if(!$m->getTable())
		{
			$pdo     = $m->getPDO();
			// если таблицы не существует
			$sql     = "CREATE TABLE users (
			id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			email VARCHAR(160),
			first_name VARCHAR(160) NOT NULL,
			last_name VARCHAR(160) NOT NULL,
			pass TEXT NOT NULL,
			birthday DATE NOT NULL
			)";
			$pdo->exec($sql);
			$message .= "таблица `users` создана! <br>";
		} else $flag++;
		$p  = new Db ('post');
		if(!$p->getTable()){
			$pdo     = $p->getPDO();
			// если таблицы не существует
			$sql2     = "CREATE TABLE post (
			id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			user_id INT NOT NULL ,
			title VARCHAR(255) NOT NULL ,
			content TEXT NOT NULL ,
			image TEXT NOT NULL ,
			created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
			)";
			$pdo->exec($sql2);
			$message .= "таблица `post` создана! <br>";
		} else $flag++;
		if($flag > 0) $message .= "Таблицы уже созданы.<br>";
		$message .= "  <a href='/'>на главную</a>";
		echo  $message;
	}
}