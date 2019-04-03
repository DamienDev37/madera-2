<?php

namespace App\Repositories;

use App\Projet;

class ProjetRepository extends ResourceRepository
{
    public function __construct(Projet $projet)
	{
		$this->model = $projet;
	}

}