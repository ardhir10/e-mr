@extends('main')


@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">{{$page_title}}</h4>

                    {{-- <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Utility</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
                        </ol>
                    </div> --}}

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="GET" class="row">
                            <div class="form-group col-lg-2">
                                <label for="">Nama</label>
                                <input class="form-control form-control-sm" name="nama" type="text" value="{{$request->get('nama')}}" placeholder="masukkan nama pasien">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">Alamat</label>
                                <input class="form-control form-control-sm" name="alamat" type="text" value="{{$request->get('alamat')}}" placeholder="masukkan alamat pasien">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">Telepon</label>
                                <input class="form-control form-control-sm" name="telepon" type="number" value="{{$request->get('telepon')}}" placeholder="masukkan telepon pasien">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">HP</label>
                                <input class="form-control form-control-sm" name="hp" type="number" value="{{$request->get('hp')}}" placeholder="masukkan nomor hp pasien">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">Nomor MR</label>
                                <input class="form-control form-control-sm" name="nomor_mr" type="text" value="{{$request->get('nomor_mr')}}" placeholder="masukkan nomor MR">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">Tanggal Lahir</label>
                                <input class="form-control form-control-sm" name="tgl_lahir"type="date" value="{{$request->get('tgl_lahir')}}" paceholder="masukkan tanggal lahir">
                            </div>
                             <div class="mt-2">
                            <button class="btn btn-sm btn-success">
                                <i class=" fa fa-search" ></i>

                                Cari
                            </button>
                            <a href="{{route('rekam-medis.index')}}" class="btn btn-sm btn-danger">
                                <i class=" fa fa-refresh"></i>
                                <i class="fa fa-sync" aria-hidden="true"></i>
                                Reset
                            </a>
                        </div>
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                         <table class="cell-border" id="data-table">
                             <thead>
                                 <tr>
                                     <th>No</th>
                                     <th>Nomor MR</th>
                                     <th>Nama Pasien</th>
                                     <th>Tanggal lahir</th>
                                     <th>Alamat</th>
                                     <th>Telepon</th>
                                     <th>HP</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>

                                @foreach ($rekam_medis as $rm)
                                    <tr>
                                     <td>{{$loop->iteration}}</td>
                                     <td>{{$rm->fs_mr}}</td>
                                     <td>{{$rm->fs_nm_pasien}}</td>
                                     <td>{{$rm->fd_tgl_lahir}}</td>
                                     <td>{{$rm->FS_ALM_PASIEN}}</td>
                                     <td>{{$rm->FS_TLP_PASIEN}}</td>
                                     <td>{{$rm->FS_HP_PASIEN}}</td>
                                     <td>
                                         <a href="{{route('rekam-medis.detail')}}">Lihat</a>
                                     </td>
                                 </tr>
                                @endforeach
                                 
                                 
                                  
                                 
                             </tbody>

                         </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
@endsection

@push('scripts')
    <script>
        $('#data-table').DataTable({});
    </script>
@endpush