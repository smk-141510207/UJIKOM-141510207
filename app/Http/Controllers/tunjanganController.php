<?php

namespace App\Http\Controllers;

use Request;
use Validator;
use Input;
use App\Tunjangan;
use App\Golongan;
use App\Jabatan;

class tunjanganController extends Controller
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
        $tunjangan=Tunjangan::all();
        return view('tunjangan.index',compact('tunjangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $golongan=Golongan::all();
        $jabatan=Jabatan::all();
        return view('tunjangan.create',compact('golongan','jabatan'));
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
          $jud=[
                'kode_tunjangan'=>'required|unique:tunjangans',
                'jabatan_id'=>'required',
                'golongan_id'=>'required',
                'besaran_uang'=>'required',
            ];
            $juda=[
                'kode_tunjangan.required'=>'Wajib Diisi',
                'kode_tunjangan.unique'=>'Data sudah Ada',
                'jabatan_id.required'=>'Wajib Diisi',
                'golongan_id.required'=>'Wajib Diisi',
                'besaran_uang.required'=>'Wajib Diisi',
            ];
            $validasi= Validator::make(Input::all(),$jud,$juda);
            if($validasi->fails()){
                return redirect()->back()
                        ->WithErrors($validasi)
                        ->WithInput();
            }

            $tunjangan=Request::all();
            Tunjangan::create($tunjangan);
            return redirect('tunjangan');
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
        $tunjangan=Tunjangan::find($id);
        return view('tunjangan.edit',compact('jabatan','golongan','tunjangan'));
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
        $tunjangan=Tunjangan::where('id',$id)->first();
        if($tunjangan['kode_tunjangan'] != Request('kode_tunjangan')){
            $jud=[
                'kode_tunjangan'=>'required|unique:tunjangans',
                'jabatan_id'=>'required',
                'golongan_id'=>'required',
                'besaran_uang'=>'required',
                'jumlah_anak'=>'required',
                'status'=>'required',
            ];
        }
        else{
            $jud=[
                'kode_tunjangan'=>'required',
                'jabatan_id'=>'required',
                'golongan_id'=>'required',
                'besaran_uang'=>'required',
                'jumlah_anak'=>'required',
                'status'=>'required',
            ];
        }
        $juda=[
                'kode_tunjangan.required'=>'Wajib Diisi',
                'kode_tunjangan.unique'=>'Data Sudah Ada',
                'jabatan_id.required'=>'Wajib Diisi',
                'golongan_id.required'=>'Wajib Diisi',
                'besaran_uang.required'=>'Wajib Diisi',
                'status.required'=>'Wajib Diisi',
                'jumlah_anak.required'=>'Wajib Diisi',
            ];
            $validasi= Validator::make(Input::all(),$jud,$juda);
            if($validasi->fails()){
                return redirect()->back()
                        ->WithErrors($validasi)
                        ->WithInput();
            }

            $update=Request::all();
            $tunjangan=Tunjangan::find($id);
            $tunjangan->update($update);
            return redirect('tunjangan');
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
        $tunjangan=Tunjangan::find($id)->delete();
        return redirect('tunjangan');
    }
}
