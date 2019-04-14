<?php 

namespace App\Http\Controllers;

use App\Repositories\MaisonRepository;
use App\Repositories\ComposantRepository;
use DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class ComposantController extends Controller
{

    protected $composantRepository;

    public function __construct(ComposantRepository $composantRepository)
    {
        $this->composantRepository = $composantRepository;
        $this->middleware('auth');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->composantRepository->destroy($id);
        return false;
    }
}
