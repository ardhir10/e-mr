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
                        <form action="" class="row">
                            <div class="form-group col-lg-2">
                                <label for="">Nama</label>
                                <input class="form-control form-control-sm" type="text" value placeholder="masukkan nama pasien">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">Alamat</label>
                                <input class="form-control form-control-sm" type="text" value placeholder="masukkan alamat pasien">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">Telepon</label>
                                <input class="form-control form-control-sm" type="number" value placeholder="masukkan telepon pasien">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">HP</label>
                                <input class="form-control form-control-sm" type="number" value placeholder="masukkan nomor hp pasien">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">Nomor MR</label>
                                <input class="form-control form-control-sm" type="text" value placeholder="masukkan nomor MR">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">Tanggal Lahir</label>
                                <input class="form-control form-control-sm" type="date" value placeholder="masukkan tanggal lahir">
                            </div>
                        </form>
                        <div class="mt-2">
                            <button class="btn btn-sm btn-success">
                                <i class=" fa fa-search" ></i>

                                Cari
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <i class=" fa fa-refresh"></i>
                                <i class="fa fa-sync" aria-hidden="true"></i>

                                Reset
                            </button>
                        </div>
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
                                 <tr>
                                     <td>1</td>
                                     <td>31093039</td>
                                     <td>Aris S</td>
                                     <td>20-01-1987</td>
                                     <td>Bekasi</td>
                                     <td>-</td>
                                     <td>0819829282</td>
                                     <td>
                                         <a href="{{route('rekam-medis.detail')}}">Lihat</a>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td>2</td>
                                     <td>83938938</td>
                                     <td>Suyono</td>
                                     <td>02-09-1991</td>
                                     <td>Bogor</td>
                                     <td>-</td>
                                     <td>08981928292</td>
                                     <td>
                                         <a href="{{route('rekam-medis.detail')}}">Lihat</a>
                                     </td>
                                 </tr>
                                  
                                 
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