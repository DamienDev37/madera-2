<?php

namespace App\Repositories;

use App\Devis;

class DevisRepository extends ResourceRepository
{
    public function __construct(Devis $devis)
	{
		$this->model = $devis;
	}

}