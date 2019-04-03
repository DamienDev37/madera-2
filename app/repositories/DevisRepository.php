<?php

namespace App\Repositories;

use App\Devis;

class DevisRepository
{

    protected $devis;

    public function __construct(Devis $devis)
	{
		$this->devis = $devis;
	}

	private function save(Devis $devis, Array $inputs)
	{
        $devis->idClient = 1;
        $devis->idProjet = 1;
        $devis->products = "1,2,3,4,5,6";
        $devis->total = 1;
        $devis->save();
	}

	public function getPaginate($n)
	{
		return $this->devis->paginate($n);
	}

	public function store(Array $inputs)
	{
		$devis = new $this->devis;		

		$this->save($devis, $inputs);

		return $devis;
	}

	public function getById($id)
	{
		return $this->devis->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$this->save($this->getById($id), $inputs);
	}

	public function destroy($id)
	{
		$this->getById($id)->delete();
	}

}