 {{-- wizardnya --}}
                                        <div class="card-body d-none">
                                            <ul class="wizard-nav mb-5">
                                                <li class="wizard-list-item">
                                                    <div class="list-item">
                                                        <div class="step-icon" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Halaman 1">
                                                            <i class="uil uil-list-ul" data-feather="user-check"></i>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="wizard-list-item">
                                                    <div class="list-item">
                                                        <div class="step-icon" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Halaman 2">
                                                            <i class="uil uil-list-ul" data-feather="user-check"></i>
                                                        </div>
                                                    </div>
                                                </li>


                                            </ul>

                                            {{-- HALAMAN 1 --}}
                                            <div class="wizard-tab">
                                                <table class="detail-asesmen w-100 table-bordered">
                                                    <tr>
                                                        <td>
                                                            <div class="form-group row">
                                                                <div class="col-6">
                                                                    <label for=""><strong> ALASAN KUNJUNGAN (Keluhan
                                                                            Pertama
                                                                            saat masuk RS) : </strong></label>
                                                                </div>
                                                                <div class="col-6">
                                                                    <textarea class="form-control form-control-sm"
                                                                        name="" id="" rows="1"></textarea>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group row">
                                                                <div class="col-5">
                                                                    <label for=""><strong> PEMERIKSAAN FISIK </strong>
                                                                    </label>
                                                                </div>
                                                                <div class="col-7">

                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group row">
                                                                        <div class="col-3 text-align-right">
                                                                            <label for="">TD :</label>
                                                                        </div>
                                                                        <div class="col-5">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm">
                                                                        </div>
                                                                        <div class="col-4">
                                                                            mmHG
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-3 text-align-right">
                                                                            <label for="">TB :</label>
                                                                        </div>
                                                                        <div class="col-5">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm">
                                                                        </div>
                                                                        <div class="col-4">
                                                                            cm
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group row">
                                                                        <div class="col-3 text-align-right">
                                                                            <label for="">Nadi :</label>
                                                                        </div>
                                                                        <div class="col-5">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm">
                                                                        </div>
                                                                        <div class="col-4">
                                                                            x/menit
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-3 text-align-right">
                                                                            <label for="">TB :</label>
                                                                        </div>
                                                                        <div class="col-5">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm">
                                                                        </div>
                                                                        <div class="col-4">
                                                                            kg
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group row">
                                                                        <div class="col-5 text-align-right">
                                                                            <label for=""> Respirasi :</label>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm">
                                                                        </div>
                                                                        <div class="col-4">
                                                                            x/menit
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group row">
                                                                        <div class="col-3 text-align-right">
                                                                            <label for="">Suhu :</label>
                                                                        </div>
                                                                        <div class="col-5">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm">
                                                                        </div>
                                                                        <div class="col-4">
                                                                            c
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="form-group row">
                                                                <div class="col-5">
                                                                    <label for=""><strong> RIWAYAT KELUHAN UTAMA
                                                                        </strong></label>
                                                                </div>
                                                                <div class="col-7">

                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <ul class="list-unstyled mb-0">
                                                                    <li>a. Riwayat Penyakit Dahulu
                                                                        <ul>
                                                                            <li class="">
                                                                                <table class="w-100 ">
                                                                                    <tr>
                                                                                        <td width="15%" class="p-0">
                                                                                            Pernah dirawat :</td>
                                                                                        <td class="d-flex p-0">
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox"
                                                                                                    value="Tidak"
                                                                                                    name="cPernahDirawat[1][]">
                                                                                                Tidak
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox"
                                                                                                    value="Ya"
                                                                                                    name="cPernahDirawat[1][]">
                                                                                                Ya
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <span
                                                                                                    class="align-top">Diagnosa</span>
                                                                                                <input type="text">
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <span
                                                                                                    class="align-top">Kapan</span>
                                                                                                <input type="text">
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>


                                                                            </li>
                                                                            <li class="">
                                                                                <table class="w-100 standard-table">
                                                                                    <tr>
                                                                                        <td width="15%" class="p-0">
                                                                                            Pernah dioperasi :</td>
                                                                                        <td class="d-flex p-0">
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox">
                                                                                                Tidak
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox">
                                                                                                Ya
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <span
                                                                                                    class="align-top">Jenis
                                                                                                    Operasi</span>
                                                                                                <input type="text">
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <span
                                                                                                    class="align-top">Kapan</span>
                                                                                                <input type="text">
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </li>
                                                                            <li class="">
                                                                                <table class="w-100 standard-table">
                                                                                    <tr>
                                                                                        <td width="15%" class="p-0">
                                                                                            Masih dalam pengobatan :
                                                                                        </td>
                                                                                        <td class="d-flex p-0">
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox">
                                                                                                Tidak
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox">
                                                                                                Ya
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <span
                                                                                                    class="align-top">Obat
                                                                                                </span>
                                                                                                <input type="text">
                                                                                            </div>

                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>b. Riwayat Penyakit Keluarga
                                                                        <ul>
                                                                            <li class="null"><input type="checkbox">
                                                                                Tidak</li>
                                                                            <li class="null">
                                                                                <div class="d-flex align-top">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top"> Ya</span>
                                                                                        &nbsp;&nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Hipertensi</span> &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Jantung</span> &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top"> DM</span>
                                                                                        &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Paru</span> &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Hepatitis</span> &nbsp;:
                                                                                    </div>
                                                                                    Lainnya&nbsp; <input type="text">
                                                                                </div>
                                                                            </li>

                                                                        </ul>
                                                                    </li>
                                                                    <li>c. Ketergantungan
                                                                        <ul>
                                                                            <li class="null"><input type="checkbox">
                                                                                Tidak</li>
                                                                            <li class="null">
                                                                                <div class="d-flex align-top">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top"> Ya</span>
                                                                                        &nbsp;&nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Obat-obatan</span> &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Alkohol</span> &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Rokok</span> &nbsp;:
                                                                                    </div>
                                                                                    Lainnya&nbsp; <input type="text">
                                                                                </div>
                                                                            </li>

                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <div class="d-flex">
                                                                            d. Riwayat Alergi :
                                                                            <div style="margin-left:30px;">
                                                                                <input type="checkbox"> Tidak
                                                                            </div>
                                                                            <div style="margin-left:30px;">
                                                                                <input type="checkbox"> Ya , sebutkan
                                                                            </div>
                                                                            <input style="margin-left:10px;"
                                                                                type="text">
                                                                        </div>
                                                                    </li>
                                                                </ul>

                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>

                                            {{-- HALAMAN 2 --}}
                                            <div class="wizard-tab">
                                                <table class="detail-asesmen w-100 table-bordered">
                                                    <tr>
                                                        <td>
                                                            <div class="form-group row">
                                                                <div class="col-6">
                                                                    <label for=""><strong> RIWAYAT PSIKOSOSIAL
                                                                        </strong></label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <ul class="list-unstyled mb-0">
                                                                    <li>1 . <strong> Status Psikologis</strong>
                                                                        <ul>
                                                                            <li class="null">
                                                                                <div class="d-flex align-top">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Tenang</span> &nbsp;&nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Cemas</span> &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Takut</span> &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Marah</span> &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Sedih</span> &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Kecenderungan Bunuh
                                                                                            Diri</span> &nbsp;:
                                                                                    </div>
                                                                                    lapor ke&nbsp; <input type="text">
                                                                                </div>
                                                                            </li>
                                                                            <li class="null">
                                                                                <div class="d-flex align-top">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <span class="align-top"> Lain
                                                                                            lain,sebutkan </span> &nbsp;
                                                                                        <textarea name="" id=""
                                                                                            cols="100"
                                                                                            rows="1"></textarea>:
                                                                                    </div>
                                                                                </div>
                                                                            </li>


                                                                        </ul>
                                                                    </li>
                                                                    <li>2 . <strong> Status Mental</strong>
                                                                        <ul>
                                                                            <li class="null d-flex">
                                                                                <div class="m-r-1" style="margin-right:30px">
                                                                                    <input type="checkbox"> <span
                                                                                        class="align-top"> Sadar dan orientasi baik</span>
                                                                                    &nbsp;&nbsp;
                                                                                </div>
                                                                                <div class="m-r-1" style="margin-right:30px">
                                                                                    <input type="checkbox"> <span
                                                                                        class="align-top"> Ada masalah prilaku, sebutkan</span>
                                                                                    &nbsp;&nbsp; <input type="text">
                                                                                </div>

                                                                            </li>
                                                                              <li class="null d-flex">
                                                                                <div class="m-r-1" style="margin-right:30px">
                                                                                    <input type="checkbox"> <span
                                                                                        class="align-top"> Prilaku kekerasan yang dialami pasien sebelumnya</span>
                                                                                    &nbsp;&nbsp;<input type="text">
                                                                                </div>
                                                                                <div class="m-r-1" style="margin-right:30px">
                                                                                    <input type="checkbox"> <span
                                                                                        class="align-top"> Tidak dapat dinilai</span>
                                                                                    &nbsp;&nbsp;
                                                                                </div>

                                                                            </li>

                                                                        </ul>
                                                                    </li>
                                                                    <li>3 . <strong> Status Sosial</strong>
                                                                        <ul>
                                                                            <li class="null d-flex">
                                                                                <div class="m-r-1" style="margin-right:30px">
                                                                                   <span
                                                                                        class="align-top">a. Hubungan pasien dengan anggota keluarga </span>
                                                                                    &nbsp;&nbsp;
                                                                                </div>
                                                                                <div class="m-r-1" style="margin-right:30px">
                                                                                    <input type="checkbox"> <span
                                                                                        class="align-top"> Baik</span>
                                                                                    &nbsp;&nbsp;
                                                                                </div>
                                                                                <div class="m-r-1" style="margin-right:30px">
                                                                                    <input type="checkbox"> <span
                                                                                        class="align-top"> Tidak Baik</span>
                                                                                    &nbsp;&nbsp;
                                                                                </div>

                                                                            </li>
                                                                            <li class="null d-flex">
                                                                                <div class="m-r-1" style="margin-right:30px">
                                                                                   <span
                                                                                        class="align-top">b. Kerabat terdekat yang dapat dihubungi </span>
                                                                                    &nbsp;&nbsp;
                                                                                </div>

                                                                            </li>
                                                                            <li class="null d-flex">

                                                                                <div class="m-r-1" style="margin-right:30px">
                                                                                    <span class="align-top"> Nama </span>
                                                                                    &nbsp;&nbsp; <input type="text">
                                                                                </div>
                                                                                <div class="m-r-1" style="margin-right:30px">
                                                                                    <span class="align-top"> Hubungan </span>
                                                                                    &nbsp;&nbsp; <input type="text">
                                                                                </div>
                                                                                <div class="m-r-1" style="margin-right:30px">
                                                                                    <span class="align-top"> Telepon </span>
                                                                                    &nbsp;&nbsp; <input type="text">
                                                                                </div>

                                                                            </li>


                                                                        </ul>
                                                                    </li>
                                                                     <li>4 . <strong> Status Ekonomi</strong>
                                                                        <ul>
                                                                            <li class="null">
                                                                                <div class="d-flex align-top">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px;width:20%">
                                                                                       <span
                                                                                            class="align-top">
                                                                                            Pekerjaan </span> &nbsp;&nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px;width:10%">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            PNS</span> &nbsp;
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px;width:10%">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Swsasta</span> &nbsp;
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px;width:10%">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Wiraswasta</span> &nbsp;
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px;width:10%">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Petani</span> &nbsp;
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Lainnya</span> &nbsp;:
                                                                                    </div>
                                                                                    &nbsp; <input type="text">
                                                                                </div>
                                                                            </li>

                                                                            <li class="null">
                                                                                <div class="d-flex align-top">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px ;width:20%">
                                                                                       <span
                                                                                            class="align-top">
                                                                                            Jaminan Kesehatan </span> &nbsp;&nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px;width:10%">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            JKN</span> &nbsp;
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px;width:10%;width:10%">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Jamkesda</span> &nbsp;
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px;width:10%">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Asuransi</span> &nbsp;
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px;width:10%">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Pribadi</span> &nbsp;
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Lainnya</span> &nbsp;:
                                                                                    </div>
                                                                                   &nbsp; <input type="text">
                                                                                </div>
                                                                            </li>



                                                                        </ul>
                                                                    </li>
                                                                    <li>5. <strong> Agama</strong>
                                                                        <ul>
                                                                            <li class="null">
                                                                                <div class="d-flex align-top">

                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px;width:10%">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Islam</span> &nbsp;
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px;width:10%">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Kristen</span> &nbsp;
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px;width:10%">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Katolik</span> &nbsp;
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px;width:10%">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Hindu</span> &nbsp;
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px;width:10%">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Budha</span> &nbsp;
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-right:30px">
                                                                                        <input type="checkbox"> <span
                                                                                            class="align-top">
                                                                                            Kepercayaan lain</span> &nbsp;:
                                                                                    </div>
                                                                                    &nbsp; <input type="text">
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>

                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>

                                            {{-- HALAMAN 3 --}}
                                            <div class="wizard-tab">
                                                <table class="detail-asesmen w-100 table-bordered">
                                                    <tr>
                                                        <td   colspan="2">
                                                            <div class="form-group row">
                                                                <div class="col-6">
                                                                    <label for=""><strong> SKALA NYERI
                                                                        </strong></label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="40%">
                                                            <img src="{{asset('assets/images/nyeri.png')}}" alt="">
                                                        </td>
                                                        <td width="60%" rowspan="2">2</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                    </tr>

                                                </table>
                                            </div>


                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                <button type="button" class="btn btn-primary w-sm" id="prevBtn"
                                                    onclick="nextPrev(-1)">Previous</button>
                                                <button type="button" class="btn btn-primary w-sm ms-auto" id="nextBtn"
                                                    onclick="nextPrev(1)">Next</button>
                                            </div>
                                        </div>
