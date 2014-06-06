<?php
namespace HAD;

use SON\Init\Bootstrap;

class Init extends Bootstrap {
	protected function initRoutes() {
		$ar['artigo-home'] = [ 
				'route' => '/artigos',
				'controller' => 'index',
				'action' => 'index' 
		];
		$ar['artigo-add'] = [
				'route' => '/artigo/add',
				'controller' => 'index',
				'action' => 'add'
				];
		$ar['artigo-edit'] = [
				'route' => '/artigo/edit/',
				'controller' => 'index',
				'action' => 'edit'
				];
		$ar['artigo-delete'] = [
				'route' => '/artigo/delete/',
				'controller' => 'index',
				'action' => 'delete'
				];
		$this->setRoutes ($ar);
	}
}