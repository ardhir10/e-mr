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
                                <input type="hidden" name="seach" id="" value="true">
                                <select class="form-select form-select-sm " name="dokter" id="">
                                    <option value="">--PILIH DOKTER</option>

                                    @foreach ($dokter as $dkt)
                                    <option {{ $dkt->fs_dokter === $request->get('dokter') ? 'selected=selected':''}}
                                        value="{{$dkt->fs_dokter}}">{{$dkt->fs_dokter}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">Tanggal Masuk :</label>
                                <input class="form-control form-control-sm" name="tgl_masuk" type="date"
                                    value="{{$request->get('tgl_masuk')}}">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">Sampai Dengan :</label>
                                <input class="form-control form-control-sm" name="tgl_masuk_sampai" type="date"
                                    value="{{$request->get('tgl_masuk_sampai')}}">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="">Status Pasien :</label>
                                <select class="form-select form-select-sm " name="" id="">
                                    <option value="">Aktif</option>
                                    <option value="">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-sm btn-success">
                                    <i class=" fa fa-search"></i>

                                    Cari
                                </button>
                                <a href="{{route('rawat-inap.index')}}" class="btn btn-sm btn-danger">
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
                        <table class="cell-border table-striped" id="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Register</th>
                                    <th>MR</th>
                                    <th>Nama Pasien</th>
                                    <th>JK</th>
                                    <th>Umur</th>
                                    <th>DPJP</th>
                                    <th>Jaminan</th>
                                    <th>Tgl Pulang</th>
                                    <th>Rekam Medis</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 12px">
                                @foreach ($rawat_inap as $ri)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{date('d-m-Y',strtotime($ri->fd_tgl_masuk))}}</td>
                                    <td>{{$ri->fs_kd_reg }}</td>
                                    <td>{{$ri->fs_mr }}</td>
                                    <td>{{$ri->FS_NM_PASIEN }}</td>
                                    @if ($ri->FB_JNS_KELAMIN)
                                    <td>P</td>
                                    @else
                                    <td>L</td>
                                    @endif
                                    <td>{{$ri->fn_umur}} Th {{$ri->fn_umur_bulan}} Bl</td>
                                    <td>{{$ri->fs_dokter}}</td>
                                    <td>{{$ri->fs_nm_jaminan}}</td>
                                    <td>{{ $ri->FD_TGL_KELUAR == '' ? '' : date('d-m-Y',strtotime($ri->FD_TGL_KELUAR))}}</td>
                                    <td>

                                         <a href="{{route('rekam-medis.detail',['rawatinap',$ri->fs_mr,$ri->fs_kd_dokter,$ri->fs_kd_reg])}}">Lihat</a>

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
