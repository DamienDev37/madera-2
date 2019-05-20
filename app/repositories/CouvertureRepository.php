<?php

namespace App\Repositories;

use App\Couverture;

class CouvertureRepository extends ResourceRepository
{
    public function __construct(Couverture $couverture)
	{
		$this->model = $couverture;
	}
}