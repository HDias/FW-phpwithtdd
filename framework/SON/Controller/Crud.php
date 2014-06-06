<?php

namespace SON\Controller;

use SON\Di\Container;

trait Crud {
	public function index() {
		$model = Container::getClass ( $this->model );
		$this->view->objetos = $model->fetchAll ();
		
		$this->render ( "index" );
	}
	public function add() {
		if (count ( $_POST )) {
			$model = Container::getClass ( $this->model );
			$model->save ( $_POST );
			$this->view->success = true;
		}
		$this->render ( "add" );
	}
	public function edit() {
		$model = Container::getClass ( $this->model );
		
		if (count ( $_POST )) {
			$model->save ( $_POST );
			$this->view->success = true;
		}
		if (isset ( $_GET ['id'] )) {
			$this->view->artigo = $model->find ( $_GET ['id'] );
		}
		$this->render ( "edit" );
	}
	public function delete() {
		if (isset ( $_GET ['id'] )) {
			$model = Container::getClass ( $this->model );
			$id = $_GET ['id'];
			if ($model->find ( $id )) {
				$model->delete ( $id );
				$this->view->success = true;
			}
			$this->render ( "delete" );
		}
	}
}
