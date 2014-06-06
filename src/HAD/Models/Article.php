<?php

namespace HAD\Models;

use SON\Db\Table;

class Article extends Table{
	
	protected function insert(array $data){
		$stmt = $this->db->prepare("insert into {$this->table} (nome, descricao) values(:nome, :descricao)");
		$stmt->bindParam(':nome', $data['nome']);
		$stmt->bindParam(':descricao', $data['descricao']);
		$stmt->execute();
		return $this->db->lastInsertId();
	}
	protected function update(array $data){
		$stmt = $this->db->prepare("update {$this->table} set nome=:nome, descricao=:descricao where id=:id");
		$stmt->bindParam(':id', $data['id']);
		$stmt->bindParam(':nome', $data['nome']);
		$stmt->bindParam(':descricao', $data['descricao']);
		$stmt->execute();
		return $data['id'];
	}
}
