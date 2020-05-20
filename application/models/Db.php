<?php
namespace Models;

use Core\Modeldb;
use PDO;

class Db extends Modeldb
{
	private $table;
	private $select = '*';
	private $whereName;
	private $whereData;
	private $whereOp;
	private $joinData;

	public function __construct(string $table)
	{
		$this->start();
		$this->createPDO();
		$stmt = $this->pdo->query("SHOW TABLES LIKE '$table'");
		if($stmt->rowCount()) $this->table = $table;
	}
	public function getTable()
	{
		return $this->table;
	}
	public function select(string $sel)
	{
		$this->select = $sel;
		return $this;
	}
	public function join ($nameTab,$proviso,$course = "LEFT")
	{
		$this->joinData = " $course JOIN $nameTab ON $proviso ";
		return $this;
	}
	public function where(string $whereName,string $whereData,string $whereOp = "=")
	{
		$this->whereData = $whereData;
		$this->whereName = $whereName;
		$this->whereOp = $whereOp;
		return $this;
	}
	public function get_all()
	{
		$sql = "SELECT $this->select FROM $this->table ". ($this->joinData?$this->joinData:"") ." ". ($this->whereData?"WHERE $this->whereName $this->whereOp ?":"");
		if(isset($this->whereData)){
			$stm = $this->pdo->prepare($sql);
			$stm->bindValue(1, $this->whereData);
			$stm->execute();
		}
		else
		{
			$stm = $this->pdo->query($sql);
		}
		return  $stm->fetchAll(PDO::FETCH_UNIQUE);
	}
	public function get_one()
	{
		if(isset($this->whereData)){
			$sql = "SELECT $this->select FROM $this->table ". ($this->joinData?$this->joinData:"") ." ". ($this->whereData?"WHERE $this->whereName $this->whereOp ?":"");
			$stm = $this->pdo->prepare($sql);
			$stm->bindValue(1, $this->whereData);
			$stm->execute();
			return  $stm->fetch(PDO::FETCH_ASSOC);
		}
	}

	public function existence()
	{
		if(isset($this->whereData)){
			$sql = "SELECT $this->select FROM $this->table ". ($this->joinData?$this->joinData:"") ." ". ($this->whereData?"WHERE $this->whereName $this->whereOp ?":"");
			$stm = $this->pdo->prepare($sql);
			$stm->bindValue(1, $this->whereData);
			$stm->execute();
			return  $stm->rowCount();
		}
		else
		{
			echo "нет данных в existence";
		}

	}
	public function insert (array $d)
	{
		$set = "";
		$f   = 0;
		foreach($d as $k=>$v)
		{
			if($f) $set .= ", `$k` = :$k";
			else $set .= "`$k` = :$k";
			$f++;
		}
		$sql = "INSERT INTO $this->table SET $set";
		$stm = $this->pdo->prepare($sql);
		$stm->execute($d);
		return $this->pdo->lastInsertId();
	}
	public function update (array $d, int $id)
	{
		$set = "";
		$f   = 0;
		foreach($d as $k=>$v)
		{
			if($f) $set .= ", `$k` = :$k";
			else $set .= "`$k` = :$k";
			$f++;
		}
		$d += ['id'=>$id];

		$sql = "UPDATE $this->table SET $set WHERE id = :id";
		$stm = $this->pdo->prepare($sql);
		$stm->execute($d);
		return $id;
	}

	public function delId ($id)
	{
		$sql = "DELETE FROM $this->table WHERE id = ?";
		$stm = $this->pdo->prepare($sql);
		$stm->bindValue(1, $id);
		return  $stm->execute();
	}
}
