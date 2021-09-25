@extends('main')


@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">{{$page_title}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" class="row">
                            <div class="form-group col-lg-4">
                                <label for="">Dokter</label>
                                <select class="form-select form-select-sm " name="" id="">
                                    <option value="">Rahayu, dr.</option>
                                    <option value="">Abdullah, dr.</option>
                                </select>
                            </div>
                             <div class="form-group col-lg-2">
                                <label for="">Tanggal Masuk :</label>
                                <input class="form-control form-control-sm" type="date" value>
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">Sampai Dengan :</label>
                                <input class="form-control form-control-sm" type="date" value>
                            </div>
                             <div class="form-group col-lg-4">
                                <label for="">Poliklinik</label>
                                <select class="form-select form-select-sm " name="" id="">
                                    <option value="">Umum Poli</option>
                                    <option value="">THT</option>
                                    <option value="">Umum Anak</option>
                                </select>
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
                                     <th>Tanggal</th>
                                     <th>Register</th>
                                     <th>MR</th>
                                     <th>Nama Pasien</th>
                                     <th>JK</th>
                                     <th>Umur</th>
                                     <th>Poliklinik</th>
                                     <th>Dokter</th>
                                     <th>Jaminan</th>
                                     <th>Rekam Medis</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr>
                                     <td>1</td>
                                     <td>{{date('d-m-Y')}}</td>
                                     <td>0000000128</td>
                                     <td>10101021</td>
                                     <td>Daryono, Tn</td>
                                     <td>L</td>
                                     <td>38Th</td>
                                     <td>Umum Poli</td>
                                     <td>Rahayu, dr.</td>
                                     <td>BPJS</td>
                                     <td>
                                         <a href="{{route('rekam-medis.detail')}}">
                                             Lihat
                                         </a>
                                     </td>
                                    
                                 </tr>
                                 <tr>
                                     <td>2</td>
                                     <td>{{date('d-m-Y')}}</td>
                                     <td>0000000129</td>
                                     <td>10101022</td>
                                     <td>Suyoni, Tn</td>
                                     <td>L</td>
                                     <td>38Th</td>
                                     <td>Umum Poli</td>
                                     <td>Rahayu, dr.</td>
                                     <td>Pribadi</td>
                                     <td>
                                         <a href="{{route('rekam-medis.detail')}}">
                                             Lihat
                                         </a>
                                     </td>
                                    
                                 </tr>
                                 <tr>
                                     <td>2</td>
                                     <td>{{date('d-m-Y')}}</td>
                                     <td>0000000129</td>
                                     <td>10101032</td>
                                     <td>Yanti, Ny</td>
                                     <td>P</td>
                                     <td>38Th</td>
                                     <td>Umum Poli</td>
                                     <td>Rahayu, dr.</td>
                                     <td>BniLife</td>
                                     <td>
                                         <a href="{{route('rekam-medis.detail')}}">
                                             Lihat
                                         </a>
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