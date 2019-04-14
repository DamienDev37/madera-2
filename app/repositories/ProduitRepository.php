<?php

namespace App\Repositories;

use App\Produit;

class ProduitRepository extends ResourceRepository
{
    public function __construct(Produit $produit)
	{
		$this->model = $produit;
	}
}