<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\SoyamaRepositoryInterface;

class SoyamaService
{
	private $sr;
	
	public function __construct(SoyamaRepositoryInterface $sr) {
		$this->sr = $sr;
	}
	
	public function getData(int $id)
	{
		return $this->sr->getData($id);
	}
	
	public function getFilter() {
		return $this->sr->getFilter();
	}
}