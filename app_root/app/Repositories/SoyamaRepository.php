<?php

namespace App\Repositories;

use App\Repositories\SoyamaRepositoryInterface;
use App\Models\Soyama;

class SoyamaRepository implements SoyamaRepositoryInterface
{
	private $model;
	
	public function __construct(Soyama $model) {
		$this->model = $model;
	}
	
	public function getData($id) {
		return $this->model->find($id);
	}
	
	public function getFilter() {
		return $this->model->filter();
	}
}