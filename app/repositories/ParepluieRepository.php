<?php

namespace App\Repositories;

use App\Parepluie;

class ParepluieRepository extends ResourceRepository
{
    public function __construct(Parepluie $parepluie)
	{
		$this->model = $parepluie;
	}
}