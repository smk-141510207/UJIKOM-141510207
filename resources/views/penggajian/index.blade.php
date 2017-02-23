@extends('layouts.app')
@section('content')
<center><h1>Penggajian<h1></center>
    <table border="1" class="table table-striped table-border table-hover">
        <thead><center><a class="btn btn-primary" href="{{url('penggajian/create')}}">Tambah Data</a></center><br><br>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                        <thead>
                            <tr class="bg-primary">
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Nip Pegawai</th> 
                            <th>Status Pengambilan</th>
                            <th colspan="3"> <center>Opsi</center></th>
                            </tr>
                        </thead>

                        @php
                            $no=1 ;
                        @endphp
                        <tbody>
                        @foreach($penggajian as $penggajians)
                        <td>{{$no++}}</td>                        
                        <td>{{$penggajians->TunjanganPegawai->Pegawai->User->name}}</td>
                        <td>{{$penggajians->TunjanganPegawai->Pegawai->nip}}</td>
                         <td><b>@if($penggajians->tgl_pengambilan == ""&&$penggajians->status_pengambilan == "0")

                        Gaji Belum Diambil

                                <div >

                                    <a class="btn btn-primary" href="{{route('penggajian.edit',$penggajians->id)}}">Ubah Pengambilan</a>

                                </div>

                            

                        @elseif($penggajians->tgl_pengambilan == ""||$penggajians->status_pengambilan == "0")

                            Gaji Belum Diambil

                           

                        @else

                            Gaji Sudah Diambil Pada {{$penggajians->tgl_pengambilan}}

                        @endif</b></td>





                        </h5>
                                <td><a class="btn btn-primary form-control" href="{{route('penggajian.show',$penggajians->id)}}">Lihat</a></td>
                                     <td>{!!Form::open(['method'=>'DELETE','route'=>['penggajian.destroy',$penggajians->id]])!!}
                                    {!!Form::submit('Delete',['class'=>'btn btn-danger col-md-12'])!!}
                                     <div>
                                 
                                </div></td>
                                <td>   <a class="btn btn-primary" href="{{route('penggajian.edit',$penggajians->id)}}">Ubah Pengambilan</a>
</td>
                                    {!!Form::close()!!}
                                
                        </center>
                        </div> 
                          </tbody>
                        @endforeach
                        
                    </table>
                </div>

           
        
@endsection

