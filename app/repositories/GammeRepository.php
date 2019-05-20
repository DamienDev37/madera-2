<?php

namespace App\Repositories;

use App\Gamme;

class GammeRepository extends ResourceRepository
{
    public function __construct(Gamme $gamme)
	{
		$this->model = $gamme;
	}
}