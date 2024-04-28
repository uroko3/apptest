<?php

namespace App\Repositories;

interface SoyamaRepositoryInterface
{
	public function getData(int $id);
	
	public function getFilter();
}