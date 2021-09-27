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
                                    @foreach ($dokter as $dkt)
                                    <option value="">{{$dkt->fs_dokter}}</option>
                                    @endforeach
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
                                <i class=" fa fa-search"></i>

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

                                @foreach ($rawat_jalan as $rj)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$rj->fd_tgl_masuk}}</td>
                                    <td>{{$rj->fs_kd_reg}}</td>
                                    <td>{{$rj->fs_mr}}</td>
                                    <td>{{$rj->FS_NM_PASIEN}}</td>
                                    @if ($rj->FB_JNS_KELAMIN)
                                        <td>P</td>
                                    @else
                                        <td>L</td>
                                    @endif
                                    <td>{{$rj->fn_umur}}</td>
                                    <td>{{$rj->fs_nm_layanan}}</td>
                                    <td>{{$rj->fs_dokter}}</td>
                                    <td>{{$rj->fs_nm_jaminan}}</td>

                                    <td>
                                        <a href="{{route('rekam-medis.detail')}}">
                                            Lihat
                                        </a>
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
