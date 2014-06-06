<?php

namespace SON\Controller;

use HAD\Controllers\Index;

abstract class Action{
	protected $action;
	protected $view;
	
	public function __construct(){
		$this->view = new \stdClass();
	}
	
	protected function render($view, $layout = true){
		$this->action = $view;
		if($layout == true && file_exists('../src/HAD/views/layout.phtml'))
			include_once '../src/HAD/views/layout.phtml';
		else
			$this->content($view);
	}
	/*
	 * Faz com que sejam acessíveis as variáveis contidas em $view no .phtml
	 */
	protected function content(){
		$atualClass = get_class($this);
		$singleClassName = strtolower(str_replace("HAD\\Controllers\\", "", $atualClass));
		$path = '../src/HAD/views/' . $singleClassName . '/' . $this->action . '.phtml';
	
		include_once $path;
		}
}
