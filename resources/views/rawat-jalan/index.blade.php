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
                                <select class="form-select form-select-sm " name="dokter" id="">
                                    <option value="">--PILIH DOKTER</option>

                                    @foreach ($dokter as $dkt)
                                    <option {{ $dkt->fs_dokter === $request->get('dokter') ? 'selected=selected':''}}  value="{{$dkt->fs_dokter}}">{{$dkt->fs_dokter}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">Tanggal Masuk :</label>
                                <input class="form-control form-control-sm" name="tgl_masuk" type="date" value="{{$request->get('tgl_masuk') ?: date('Y-m-d')}}">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">Sampai Dengan :</label>
                                <input class="form-control form-control-sm" name="tgl_masuk_sampai" type="date" value="{{$request->get('tgl_masuk_sampai') ?: date('Y-m-d')}}">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="">Poliklinik</label>
                                <select class="form-select form-select-sm " name="layanan" id="">
                                    <option value="">--PILIH LAYANAN</option>
                                    @foreach ($layanan as $ly)
                                        <option {{ $ly->FS_NM_LAYANAN === $request->get('layanan') ? 'selected=selected':''}}  value="{{$ly->FS_NM_LAYANAN}}">{{$ly->FS_NM_LAYANAN}}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-sm btn-success">
                                    <i class=" fa fa-search"></i>

                                    Cari
                                </button>
                                <a href="{{route('rawat-jalan.index')}}" class="btn btn-sm btn-danger">
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
                            <tbody style="font-size: 12px">

                                @foreach ($rawat_jalan as $rj)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{date('d-m-Y',strtotime($rj->fd_tgl_masuk))}}</td>
                                    <td>{{$rj->fs_kd_reg}}</td>
                                    <td>{{$rj->fs_mr}}</td>
                                    <td>{{$rj->FS_NM_PASIEN}}</td>
                                    @if ($rj->FB_JNS_KELAMIN)
                                        <td>P</td>
                                    @else
                                        <td>L</td>
                                    @endif
                                    <td>{{$rj->fn_umur}} Th {{$rj->fn_umur_bulan}} Bl</td>
                                    <td>{{$rj->fs_nm_layanan}}</td>
                                    <td>{{$rj->fs_dokter}}</td>
                                    <td>{{$rj->fs_nm_jaminan}}</td>

                                         <td>
                                         <a href="{{route('rekam-medis.detail',['rawatjalan',$rj->fs_mr,$rj->fs_kd_dokter,$rj->fs_kd_reg])}}">Lihat</a>
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
