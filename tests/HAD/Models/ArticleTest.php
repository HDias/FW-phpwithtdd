<?php

use SON\Di\Container;
class ArticleTest extends PHPUnit_Framework_TestCase{
	
	private $model;
	
	public function setUp(){
		$this->model = Container::getClass("Article");
		
		$db = new \PDO("mysql:host=localhost;dbname=phptdd", "root", "");
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		//Limpa a tabela junto com a contagem dos IDs
		$db->exec("truncate table article");
	}
	
	public function testverificaTipoDoObjeto(){
		$this->assertInstanceOf("HAD\Models\Article", $this->model);
	}
	
	/*
	 * Toda Vez que inserir um registro ele retorna o ID do registro Inserido
	 */
	public function testVerificaSeConsegueInserirUmRegistro(){
		$data['nome'] = "Artigo Teste";
		$data['descricao'] = "Artigo Teste descri��o";
		
		$this->assertEquals(1, $this->model->save($data));
		$this->assertEquals(2, $this->model->save($data));
	}
	
	public function testVerificaSeInsereRegistroSemDados(){
		$data = array();
		try {
			$this->model->save($data);
			//Se cair no bloco do fail � pra acusar ERRO
			$this->fail("Não pode inserir com dados em branco");
		}catch (\Exception $e){
			}
	}
	
	/**
	 * @depends testVerificaSeInsereRegistroSemDados
	 */
	//Se o test citado acima n�o passar ele n�o roda o test abaixo
	public function testVerificaSeConsegueAlterarRegistro(){
		$data['nome'] = "Artigo Teste";
		$data['descricao'] = "Artigo Teste descri��o";		
		$this->model->save($data);
		
		$data['id'] = 1;
		$data['nome'] = "Artigo Alterado Teste";
		$data['descricao'] = "Artigo Alterado descrição";
		
		$this->assertEquals('1', $this->model->save($data));
	}
	
	public function testverificaSeconsegueSelecionarAlgumregistro(){
		$data['nome'] = "Artigo Teste";
		$data['descricao'] = "Artigo Teste descrição";
		$this->model->save($data);
		
		$data['nome'] = "Artigo Teste 2";
		$data['descricao'] = "Artigo Teste descrição 2";
		$this->model->save($data);
		
		$this->assertEquals("Artigo Teste", $this->model->find(1)['nome']);
		$this->assertEquals("Artigo Teste 2", $this->model->find(2)['nome']);
	}
	
	public function testVerificaSeConsegueRemoverRegistro(){
		$data['nome'] = "Artigo Nome VaiSerRemovido";
		$data['descricao'] = "Artigo descrição VaiSerRemoviso";
		$this->model->save($data);
		
		$this->assertTrue($this->model->delete(1));
	}
	
	public function testVerificaSeConsegueListarRegistro(){
		$data['nome'] = "Artigo Teste";
		$data['descricao'] = "Artigo Teste descri��o";
		$this->model->save($data);
		
		$data['nome'] = "Artigo Teste 2";
		$data['descricao'] = "Artigo Teste descri��o 2";
		$this->model->save($data);
		
		$this->assertEquals("Artigo Teste", $this->model->fetchAll()[0]['nome']);
		$this->assertEquals("Artigo Teste 2", $this->model->fetchAll()[1]['nome']);
	}
}
