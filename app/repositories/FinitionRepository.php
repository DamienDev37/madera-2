<?php

namespace App\Repositories;

use App\Finition;

class FinitionRepository extends ResourceRepository
{
    public function __construct(Finition $finition)
	{
		$this->model = $finition;
	}
}