<?php

namespace HAD\Controllers;

class IndexTest extends \PHPUnit_Extensions_SeleniumTestCase{
		
	public static $browsers = array(
		array(
			'name' => 'Firefox', 
			'browser' => '*firefox',
			'timeout' => 10000,
			'host' => 'localhost'
		),
		/* Teste Remoto
		 * Aqui é um exemplo do teste sendo feito em um servidor 
		 * onde os testes serão executados e retorna pro phpunit
		 */
		/*array(
			'name' => 'Internet Explorer',
			'browser' => '*ie6',
			'timeout' => 100000,
			'host' => '192.168.0.10'
			)	*/
	);
	protected function setUp()
	{
		$this->setBrowserUrl('http://127.0.0.1:8090');
	}
	
	public function testTitle()
	{
		$this->open('/artigos');
		$this->assertTitle('Framework php');
	}
	
	public function testVerificaSeConsegueInserirUnRegistro(){
		$this->open("/artigos");
		$this->click("adicionar");
		$this->type("nome", "Nome Seleniun");
		$this->type("descricao", "Descrição Seleniun");
		$this->click("submit");
		$this->waitForPageToLoad(10000);//Faz o browser esperar um segundo
		$locator = "//div[@class='notification']/p";
		$this->assertEquals(
				"Dados Inseridos com Sucesso", 
				//Duas barras pra pegar o elemento div com o nome da class e dentro de um <p>
				$this->getText("//div[@class='notification']")
		);
	}
	
}
