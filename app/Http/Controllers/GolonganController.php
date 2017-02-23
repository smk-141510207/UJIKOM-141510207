<?php

namespace App\Http\Controllers;

use Request;
use App\Golongan;
use App\KategoryLembur;
use Validator;
use Input;
class GolonganController extends Controller
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
        $golongan = Golongan::all();
        return view('Golongan.index', compact('golongan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Golongan.create');
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
         $ju=['kode_golongan'=>'required|unique:golongans','nama_golongan'
         =>'required','besaran_uang'=>'required'];
         $juda=['kode_golongan.required'=>'Wajib Diisi',
                'kode_golongan.unique'=>'Kode Sudah Ada',
                'nama_golongan.required'=>'Wajib Diisi',
                'besaran_uang.required'=>'Wajib Diisi'];
      $validator=Validator::make(Input::all(),$ju,$juda);

        if ($validator->fails())
         {
            # code...
            return redirect('/golongan/create')
            ->withErrors($validator)
            ->withInput();
        }
        else
        {
                $golongan=Request::all();
                Golongan::create($golongan);
                return redirect('golongan');
        }
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
         $golongan = Golongan::findOrFail($id);
        return view('Golongan.edit', compact('golongan'));
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
         $golongan=Golongan::where('id' , $id)->first();
          if($golongan['kode_golongan'] != Request('kode_golongan')){

           $ju=[
                    'kode_golongan' => 'required|unique:golongans',
                    'nama_golongan' => 'required','besaran_uang' =>'required'
                    ];
          }
          else{
           $ju=[
                    'kode_golongan' => 'required',
                    'nama_golongan' => 'required','besaran_uang' =>'required'
                    ];

          }
        $juda=[
            'kode_golongan.required' => 'Wajib Diisi',
            'kode_golongan.unique' => 'Data Tidak Boleh Sama',
            'nama_golongan.required' => 'Wajib Diisi',
            'besar_uang.required' => 'Wajib Diisi',
            ];
        $validasi = Validator::make(Input::all(),$ju,$juda);
        if($validasi->fails()){
            return redirect()->back()
            ->withErrors($validasi)
            ->withInput();
        }

        $golonganUpdate=Request::all();
        $golongan=Golongan::find($id);
        $golongan->update($golonganUpdate);
        return redirect('golongan');
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
        $golongan = Golongan::findOrFail($id);
        $golongan->delete();
        return redirect()->route('golongan.index')->with('alert-success', 'Data Berhasil Dihapus.');
    }
}
