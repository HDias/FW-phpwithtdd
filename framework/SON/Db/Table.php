<?php
namespace SON\Db;

abstract class Table {
	protected $table;
	protected $db;
	
	public function __construct(\PDO $db){
		$this->db = $db;
		$this->table = "article";
	}
	
	abstract protected function insert(array $data);
	
	abstract protected function update(array $data);
	
	public function save(array $data){
		if(!isset($data['id']))
			return $this->insert($data);
		else
			return $this->update($data);
	}
	
	public function find($id){
		$stmt = $this->db->prepare("select * from {$this->table} where id=:id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		return $stmt->fetch();
	}
	
	public function delete($id){
		$stmt = $this->db->prepare("delete from {$this->table} where id=:id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		return true;
	}
	
	public function fetchAll(){
		$stmt = $this->db->prepare("select * from {$this->table}");
		$stmt->execute();
		return $stmt->fetchAll();
	
	}
}
