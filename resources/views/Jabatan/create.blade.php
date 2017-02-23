@extends('layouts.app')
@section('content')
    {!! Form::open(['url' => 'jabatan']) !!}

  <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Tambah Golongan</div>
                <div class="panel-body">
                    
    <div class="form-group">
     <div class="form-group {{$errors->has('kode_jabatan') ? 'has-errors':'message'}}" >
        {!! Form::label('Kode Jabatan', 'Kode Jabatan:') !!}
        {!! Form::text('kode_jabatan',null,['class'=>'form-control']) !!}
         @if($errors->has('kode_jabatan'))
        <span class="help-block">
            <strong>{{$errors->first('kode_jabatan')}}</strong>
        </span>
        @endif
    </div>
    </div>
    <div class="form-group">
         <div class="form-group {{$errors->has('nama_jabatan') ? 'has-errors':'message'}}" >

        {!! Form::label('Nama Jabatan', 'Nama Jabatan:') !!}
        {!! Form::text('nama_jabatan',null,['class'=>'form-control']) !!}
         @if($errors->has('nama_jabatan'))
        <span class="help-block">
            <strong>{{$errors->first('nama_jabatan')}}</strong>
        </span>
        @endif
    </div>
    </div>

     <div class="form-group">
     <div class="form-group {{$errors->has('besaran_uang') ? 'has-errors':'message'}}" >
        {!! Form::label('Besaran Uang', 'Besaran Uang:') !!}
        {!! Form::text('besaran_uang',null,['class'=>'form-control']) !!}
         @if($errors->has('besaran_uang'))
        <span class="help-block">
            <strong>{{$errors->first('besaran_uang')}}</strong>
        </span>
        @endif
    </div>
    </div>
<div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary form-control">
                        Simpan
                        </button>
                     </div>
                </div>

@stop