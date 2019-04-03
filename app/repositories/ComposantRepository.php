<?php

namespace App\Repositories;

use App\Composant;

class ComposantRepository extends ResourceRepository
{
    public function __construct(Composant $composant)
	{
		$this->model = $composant;
	}

}