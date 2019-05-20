<?php

namespace App\Repositories;

use App\Isolant;

class IsolantRepository extends ResourceRepository
{
    public function __construct(Isolant $isolant)
	{
		$this->model = $isolant;
	}
}