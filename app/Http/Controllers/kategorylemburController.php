<?php

namespace App\Http\Controllers;

use Request;
use App\KategoryLembur;
use App\Jabatan;
use App\Golongan;
use App\LemburPegawai;
use Validator;
use Input;

class kategorylemburController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lembur = KategoryLembur::all();
        return view('kategori_lembur.index', compact('lembur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
        $jabatan=Jabatan::all();
        $golongan=Golongan::all();
        return view('kategori_lembur.create',compact('jabatan','golongan'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
          $ju=[
                'kode_lembur'=>'required|unique:kategory_lemburs,kode_lembur',
                'golongan_id'=>'required',
                'jabatan_id'=>'required',
                'besaran_uang'=>'required',
                ];
        $juda=[
                'kode_lembur.required'=>'Wajib Diisi',
                'besaran_uang.required'=>'Wajib Diisi',
                'kode_lembur.unique'=>'Data Sudah Ada',
                'golongan_id.required'=>'Wajib Diisi',
                'jabatan_id.required'=>'Wajib Diisi',
                ];
        $validasi=Validator::make(Input::all(),$ju,$juda);
        if($validasi->fails()){
            return redirect()->back()
            ->WithErrors($validasi)
            ->WithInput();
        }
        
        $lembur=Request::all();
        KategoryLembur::create($lembur);
        return redirect('lemburkate');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $golongan=Golongan::all();
        $jabatan=Jabatan::all();
        $lembur=Kategorylembur::find($id);
        return view('kategori_lembur.edit',compact('lembur','golongan','jabatan'));
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
        //
        $lembur=Kategorylembur::where('id',$id)->first();
        if($lembur['kode_lembur'] != Request('kode_lembur')){

        $ju=[
                'kode_lembur'=>'required|unique:kategory_lemburs,kode_lembur',
                'golongan_id'=>'required',
                'besaran_uang'=>'required',
                'jabatan_id'=>'required',
                ];
        }
        else{

        $ju=[
                'kode_lembur'=>'required',
                'golongan_id'=>'required',
                'jabatan_id'=>'required',
                ];
        }
        $juda=[
                
                'kode_lembur.required'=>'Wajib Diisi',
                'besaran_uang.required'=>'Wajib Diisi',
                'kode_lembur.unique'=>'Data Sudah Ada',
                'golongan_id.required'=>'Wajib Diisi',
                'jabatan_id.required'=>'Wajib Diisi',
                ];
        $validasi=Validator::make(Input::all(),$ju,$juda);
        if($validasi->fails()){
            return redirect()->back()
            ->WithErrors($validasi)
            ->WithInput();
        }

        $lemburupdate=Request::all();
        $lembur=Kategorylembur::find($id);
        $lembur->update($lemburupdate);
        return redirect('lemburkate');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $lembur=KategoryLembur::find($id)->delete();
        return redirect('lemburkate');
    }
}
