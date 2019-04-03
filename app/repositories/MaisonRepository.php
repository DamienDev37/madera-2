<?php

namespace App\Repositories;

use App\Maison;

class MaisonRepository extends ResourceRepository
{
    public function __construct(Maison $maison)
	{
		$this->model = $maison;
	}
}