<?php

namespace SON\Di;

class Container {
	
	private static function getDb(){
		try {
			$db = new \PDO("mysql:host=localhost;dbname=phptdd", "root", "");
			$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			return $db;
		}catch (\Exception $e){
			echo "Erro ao Conectar com o BD: " . $e->getMessage();
			die();
		}
	}
	
	public static function getClass($nomeClass, $data = ""){
		$str_class = "\\HAD\\Models\\" . ucfirst($nomeClass);
		if($data)
			$class = new $str_class(self::getDb(), $data);
		else 
			$class = new $str_class(self::getDb());
		
		return $class;
	}
}
