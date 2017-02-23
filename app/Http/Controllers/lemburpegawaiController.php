<?php

namespace App\Http\Controllers;

use Request;
use App\Pegawai;
use App\LemburPegawai;
use App\KategoryLembur;
use Validator;
use Input;

class lemburpegawaiController extends Controller
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
         $lempegawai = LemburPegawai::all();
        return view('lemburpegawai.index', compact('lempegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pegawai=Pegawai::all();
        $lembur=KategoryLembur::all();
        return view('lemburpegawai.create',compact('pegawai','lembur'));
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
                'kode_lembur_id'=>'required|unique:lembur_pegawais,kode_lembur_id',
                'pegawai_id'=>'required',
                'jumlah_jam'=>'required',
                ];
        $juda=[
                'kode_lembur_id.required'=>'Wajib Diisi',
                'kode_lembur_id.unique'=>'Data Sudah Ada',
                'pegawai_id.required'=>'Wajib Diisi',
                'jumlah_jam.required'=>'Wajib Diisi',
                ];
        $validasi=Validator::make(Input::all(),$ju,$juda);
        if($validasi->fails()){
            return redirect()->back()
            ->WithErrors($validasi)
            ->WithInput();
        }
        
        $lempegawai=Request::all();
        LemburPegawai::create($lempegawai);
        return redirect('lemburp');
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
        $pegawai=Pegawai::all();
        $lembur=KategoryLembur::all();
        $lempegawai=LemburPegawai::find($id);
        return view('lemburpegawai.edit',compact('lembur','pegawai','lempegawai'));
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
         $lempegawai=LemburPegawai::where('id',$id)->first();
        if($lempegawai['kode_lembur_id']!= Request('kode_lembur_id')){

             $jud=[
            'kode_lembur_id'=>'required|unique:lembur_pegawais,kode_lembur_id',
            'pegawai_id'=>'required',
            'jumlah_jam'=>'required',
        ];
        }
        else{
            $jud=[
           'kode_lembur_id'=>'required',
            'pegawai_id'=>'required',
            'jumlah_jam'=>'required',];
        }
         $juda=[
            'kode_lembur_id.required'=>'Wajib Diisi',
            'kode_lembur_id.unique'=>'Data sudah ada',
            'pegawai_id.required'=>'Wajib Diisi',
            'jumlah_jam.required'=>'Wajib Diisi',
        ];
        $validasi=Validator::make(Input::all(),$jud,$juda);
        if($validasi->fails()){
            return redirect()->back()  
                             ->WithErrors($validasi)
                    ->WithInput();
        }
        $update=Request::all();
        $lempegawai=LemburPegawai::find($id);
        $lempegawai->update($update);
        return redirect('lemburp');
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
         $lempegawai=LemburPegawai::find($id)->delete();
        return redirect('lemburp');
       
    }
}
