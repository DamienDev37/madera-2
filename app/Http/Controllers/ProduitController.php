<?php

namespace App\Http\Controllers;

use DB;
use App\Repositories\ProduitRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use app\Produit;

class ProduitController extends Controller
{
    protected $produitRepository;

    protected $nbrPerPage = 32;

    public function __construct(ProduitRepository $produitRepository)
    {
    	$this->middleware('auth');
        $this->produitRepository = $produitRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = $this->produitRepository->getPaginate($this->nbrPerPage);
        return view('produit.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $familles = DB::table('familles')->get();
        return view('produit.create',compact('familles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Produit();
        $produitImg='';
        $produitCctp='';
        if($request->request->get('id')!==null){
            $data->id = $request->request->get('id');
            $produit = DB::table('produits')->where('id', '=', $request->request->get('id'))->first();
            $produitImg=$produit->img;
            $produitCctp=$produit->cctp;
        }
        if(!empty($request->files->get('img'))){
            $img=$request->files->get('img');
            $imgName = $img->getClientOriginalName();
            $imgPath = $img->getPathName();
            Storage::disk('public')->putFileAs('produit', new File($imgPath),$imgName);
            $produitImg = $imgName;
        }
        if(!empty($request->files->get('cctp'))){
            $cctp=$request->files->get('cctp');
            $cctpName = $cctp->getClientOriginalName();
            $cctpPath = $cctp->getPathName();
            Storage::disk('public')->putFileAs('produit', new File($cctpPath),$cctpName);
            $produitCctp= $cctpName;
        }
        $data->img = $produitImg;
        $data->cctp = $produitCctp;
        $data->idFamille=$request->request->get('idFamille');
        $data->typeproduit = $request->request->get('typeproduit');
        $data->prix = $request->request->get('prix');
        $data->timestamp = time();
        $data->update();
        
        //return redirect('/produit')->withOk("Le produit a bien été créer.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produit = $this->produitRepository->getById($id);
        return view('produit.show',  compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $familles = DB::table('familles')->get();
        $produit = $this->produitRepository->getById($id);
        return view('produit.edit',  compact('produit','familles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = new Produit();
        $data->id=$id;
        $produitImg='';
        $produitCctp='';
        $data->idFamille=$request->request->get('idFamille');
        if($request->request->get('id')!==null){
            $data->id = $request->request->get('id');
            $produit = DB::table('produits')->where('id', '=', $request->request->get('id'))->first();
            $produitImg=$produit->img;
            $produitCctp=$produit->cctp;
        }
        if(!empty($request->files->get('img'))){
            $img=$request->files->get('img');
            $imgName = $img->getClientOriginalName();
            $imgPath = $img->getPathName();
            Storage::disk('public')->putFileAs('produit', new File($imgPath),$imgName);
            $produitImg = $imgName;
        }
        if(!empty($request->files->get('cctp'))){
            $cctp=$request->files->get('cctp');
            $cctpName = $cctp->getClientOriginalName();
            $cctpPath = $cctp->getPathName();
            Storage::disk('public')->putFileAs('produit', new File($cctpPath),$cctpName);
            $produitCctp= $cctpName;
        }
        $data->img = $produitImg;
        $data->cctp = $produitCctp;
        $data->typeproduit = $request->request->get('typeproduit');
        $data->prix = $request->request->get('prix');
        $data->timestamp = time();
        
        //$data->update();
        //return redirect('/produit')->withOk("Le produit a bien été mis à jour.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->produitRepository->destroy($id);

        return redirect()->back();
    }
}
