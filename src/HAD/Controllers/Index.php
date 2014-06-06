<?php

namespace HAD\Controllers;

use SON\Controller\Action;
use SON\Controller\Crud;
use SON\Di\Container;

class Index extends Action{
	use Crud;	
	protected $model = "article";
}

