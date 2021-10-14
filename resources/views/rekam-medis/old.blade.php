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
                    <tbody style="font-size: 12px">

                        @foreach ($rekam_medis as $rm)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$rm->fs_mr}}</td>
                            <td>{{$rm->fs_nm_pasien}}</td>
                            <td>{{date('d-m-Y',strtotime($rm->fd_tgl_lahir))}}</td>
                            <td>{{$rm->FS_ALM_PASIEN}}</td>
                            <td>{{$rm->FS_TLP_PASIEN}}</td>
                            <td>{{$rm->FS_HP_PASIEN}}</td>
                            <td>
                                <a href="{{route('rekam-medis.detail',['rekammedis',$rm->fs_mr])}}">Lihat</a>
                            </td>
                        </tr>
                        @endforeach




                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
