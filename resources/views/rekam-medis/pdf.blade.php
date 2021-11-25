<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('/assets')}}/images/logo-solvus-small.jpeg">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{$page_title}}</title>
    <style>
        body {
            background: white !important;
        }

        @page {
            margin: 20px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .column {
            float: left;
            width: 50%;
        }

        #tableDetail {
            /* border-collapse: collapse; */
            /* border-spacing: 0; */
            border-spacing: -1px

        }

        #tableDetail tr td{
            padding: 5px;
            border: 1px solid black;
            border-collapse: collapse;
            /* border-spacing: 0; */
            /* border-spacing: -1px */

        }
        #tableDetail tr th {
            padding: 5px;
            border: 1px solid black;
            border-collapse: collapse;
            background: #B4C6E7;

        }

        #pemeriksaanFisik tr td {
            padding: 2px;
            border: 0.5px solid black;
            border-collapse: collapse;

        }

    </style>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" > --}}

</head>

<body style="font-family:sans-serif ;">
    <div class="">
        <div style="font-size:14px;">
            <span style="float: right;font-weight:bolder;">LIST MR</span>
            <span style="display: block;font-weight:bold;font-size:16px;">{{$rumah_sakit[0]->fs_nm_rs ?? ''}}</span>
            <span style="display:block;font-size:14px;">{{$rumah_sakit[0]->fs_alm_rs ?? ''}}</span>
            Tlp : {{$rumah_sakit[0]->fs_tlp_rs ?? ''}}
            {{-- <img src="{{asset('assets/images/logo-solvus.jpeg')}}" alt="" width="100" class="auth-logo-light"> --}}
        </div>
        <hr>
        {{-- HEADER --}}
        <table style="font-size:12px; width:100%">
            <tr>
                <td style="width: 50%">
                    <table>
                        <tr>
                            <td>
                                <span style="width: 100px;">Nomor MR</span>
                            </td>
                            <td>
                                : {{$rekam_medis->FS_MR}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Nama Pasien
                            </td>
                            <td>
                                : {{$rekam_medis->FS_NM_PASIEN}}
                            </td>
                        </tr>

                    </table>
                </td>

            </tr>
        </table>
        <hr>
        <table style="font-size:12px; width:100%" class="cell-border table-catatan-perkembangan " id="tableDetail">
            <thead>
                <tr>
                    <th width="2%">No</th>
                    <th width="8%">Tanggal Jam</th>
                    <th width="10%">Profesi / Bagian</th>
                    <th>Hasil Pemeriksaan/Assesmen, Analisis dan Rencana Penatalaksanaan</th>
                    <th>Instruksi / Tindak Lanjut</th>
                    <th>Verifikasi</th>
                    <th width="6%">User</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($CPPT as $cppt)
                <tr>
                    <td style="vertical-align:top;" style="vertical-align:top;">{{$loop->iteration}}</td>
                    <td style="vertical-align:top;">
                        <span style="d-block">{{date('d-m-Y H:i:s',strtotime($cppt->FD_DATE))}}</span>
                    </td>

                    <td style="vertical-align:top;">
                        <span class="badge bg-primary d-block "
                            style="font-size: 10px;margin-bottom:3px;background: #038EDC;padding:3px;display:block;">{{$cppt->FS_PROFESI}}</span>
                        <span class="badge bg-secondary "
                            style="font-size: 10px;    white-space: normal !important;margin-bottom:3px;background: #74788D;padding:3px;display:block;">{{$cppt->FS_NM_LAYANAN}}</span>
                        @if ($cppt->TB_FROM == 'cppt')
                        <span class="badge bg-info d-block">CPPT</span>
                        @elseif ($cppt->TB_FROM == 'asesmen_dokter')
                        <span class="badge bg-info d-block">Asesmen Dokter</span>

                        @elseif ($cppt->TB_FROM == 'asesmen_dokter_bidan')
                        <span class="badge bg-info d-block">Asesmen Dokter Bidan</span>

                        @else
                        <span class="badge bg-info d-block">Asesmen Perawat</span>

                        @endif
                    </td>
                    <td style="vertical-align:top;">
                        <div style=" height: 200px;overflow: auto;" class="style-3 detail-soap">
                            <table class="no-border detail-harp">
                                {{-- SUBJECTIVE --}}
                                <tr>
                                    <td style="border: 0px !important;vertical-align:top;">S:
                                    </td>
                                    @if ($cppt->TB_FROM == 'asesmen_dokter' || $cppt->TB_FROM == 'asesmen_dokter_bidan'
                                    )
                                    <td style="border: 0px !important;">{{json_decode($cppt->FT_SUBJECTIVE)->Text}}</td>
                                    @else
                                    <td style="border: 0px !important;">{{$cppt->FT_SUBJECTIVE}}</td>
                                    @endif
                                </tr>

                                {{-- OBJECTIVE --}}
                                <tr class="different">
                                    <td style="border: 0px !important;vertical-align:top;">O:
                                    </td>

                                    @if ($cppt->TB_FROM == 'cppt')
                                    <td style="border: 0px !important;">{{$cppt->FT_OBJECTIVE}}
                                    </td>
                                    @elseif ($cppt->TB_FROM == 'asesmen_dokter')
                                    <td style="border: 0px !important;">
                                        <ul>
                                            <li>Keadaan Umum : {{json_decode($cppt->FT_OBJECTIVE)->KeadaanUmum}}</li>
                                            <li>Kesadaran : {{json_decode($cppt->FT_OBJECTIVE)->Kesadaran}}</li>
                                            <li>TD : {{json_decode($cppt->FT_OBJECTIVE)->TD}} mmHg</li>
                                            <li>Nadi : {{json_decode($cppt->FT_OBJECTIVE)->Nadi}} x/menit</li>
                                            <li>Respirasi : {{json_decode($cppt->FT_OBJECTIVE)->Respirasi}} x/menit</li>
                                            <li>Suhu : {{json_decode($cppt->FT_OBJECTIVE)->Suhu}} C</li>
                                        </ul>
                                    </td>
                                    @elseif ($cppt->TB_FROM == 'asesmen_dokter_bidan')
                                    <td style="border: 0px !important;">
                                        <ul>
                                            <li>Keadaan Umum : {{json_decode($cppt->FT_OBJECTIVE)->KeadaanUmum}}</li>
                                            <li>Kesadaran : {{json_decode($cppt->FT_OBJECTIVE)->Kesadaran}}</li>
                                            <li>TD : {{json_decode($cppt->FT_OBJECTIVE)->TD}} mmHg</li>
                                            <li>Nadi : {{json_decode($cppt->FT_OBJECTIVE)->Nadi}} x/menit</li>
                                            <li>Respirasi : {{json_decode($cppt->FT_OBJECTIVE)->Respirasi}} x/menit</li>
                                            <li>Suhu : {{json_decode($cppt->FT_OBJECTIVE)->Suhu}} C</li>
                                            <li>TFU : {{json_decode($cppt->FT_OBJECTIVE)->TFU}} cm</li>
                                            <li>DJJ : {{json_decode($cppt->FT_OBJECTIVE)->DJJ}} x/menit</li>
                                            <li>His : {{json_decode($cppt->FT_OBJECTIVE)->His}} x/10 menit</li>
                                            <li>TBJ : {{json_decode($cppt->FT_OBJECTIVE)->TBJ}} gram</li>
                                        </ul>
                                    </td>

                                    @else
                                    <td style="border: 0px !important;">
                                        <ul>
                                            <li>TD : {{$cppt->TD}} mmHG</li>
                                            <li>TB : {{$cppt->TB}} cm</li>
                                            <li>Nadi : {{$cppt->NADI}} x/menit</li>
                                            <li>BB : {{$cppt->BB}} kg</li>
                                            <li>Respirasi : {{$cppt->RESPIRASI}} x/menit</li>
                                            <li>Suhu : {{$cppt->SUHU}} c</li>
                                        </ul>
                                    </td>
                                    @endif
                                </tr>
                                @if ($cppt->TB_FROM == 'cppt')
                                {{-- OBJECTIVE --}}
                                <tr>
                                    <td style="border: 0px !important;vertical-align:top;">A:
                                    </td>
                                    <td style="border: 0px !important;">{{$cppt->FT_ASSESMENT}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 0px !important;vertical-align:top;">P:
                                    </td>
                                    <td style="border: 0px !important;">
                                        <ul style="padding: 0px;">
                                            @if ($cppt->FS_PLAN1 != '')
                                            <li style="margin-bottom:10px;" class="testPosition">1 : {{$cppt->FS_PLAN1}}
                                            </li>
                                            @endif
                                            @if ($cppt->FS_PLAN2 != '')
                                            <li style="margin-bottom:10px;">2 : {{$cppt->FS_PLAN2}}</li>
                                            @endif
                                            @if ($cppt->FS_PLAN3 != '')
                                            <li style="margin-bottom:10px;">3 : {{$cppt->FS_PLAN3}}</li>
                                            @endif
                                            @if ($cppt->FS_PLAN4 != '')
                                            <li style="margin-bottom:10px;">4 : {{$cppt->FS_PLAN4}}</li>
                                            @endif
                                        </ul>
                                    </td>
                                </tr>
                                @endif

                            </table>
                        </div>
                    </td>
                    <td style="vertical-align:top;">-
                        @if ($cppt->TB_FROM == 'cppt')
                        <div style=" height: 200px;overflow: auto;" class="style-3">
                            <ul style="padding:13px">

                                @if ($cppt->FS_PLAN1 != '')
                                <li>{{$cppt->FS_PLAN1}}
                                    <ul style="padding:0px;margin-left: 11px;">
                                        @if ($cppt->FS_IPPA1A != '')
                                        <li>{{$cppt->FS_IPPA1A}}</li>
                                        @endif
                                        @if ($cppt->FS_IPPA1B != '')
                                        <li>{{$cppt->FS_IPPA1B}}</li>
                                        @endif
                                        @if ($cppt->FS_IPPA1C != '')
                                        <li>{{$cppt->FS_IPPA1C}}</li>
                                        @endif
                                    </ul>
                                </li>
                                @endif

                                @if ($cppt->FS_PLAN2 != '')
                                <li>{{$cppt->FS_PLAN2}}
                                    <ul style="padding:0px;margin-left: 11px;">
                                        @if ($cppt->FS_IPPA2A != '')
                                        <li>{{$cppt->FS_IPPA2A}}</li>
                                        @endif
                                        @if ($cppt->FS_IPPA2B != '')
                                        <li>{{$cppt->FS_IPPA2B}}</li>
                                        @endif
                                        @if ($cppt->FS_IPPA2C != '')
                                        <li>{{$cppt->FS_IPPA2C}}</li>
                                        @endif
                                    </ul>
                                </li>
                                @endif

                                @if ($cppt->FS_PLAN3 != '')
                                <li>{{$cppt->FS_PLAN3}}
                                    <ul style="padding:0px;margin-left: 11px;">
                                        @if ($cppt->FS_IPPA3A != '')
                                        <li>{{$cppt->FS_IPPA3A}}</li>
                                        @endif
                                        @if ($cppt->FS_IPPA3B != '')
                                        <li>{{$cppt->FS_IPPA3B}}</li>
                                        @endif
                                        @if ($cppt->FS_IPPA3C != '')
                                        <li>{{$cppt->FS_IPPA3C}}</li>
                                        @endif
                                    </ul>
                                </li>
                                @endif

                                @if ($cppt->FS_PLAN4 != '')
                                <li>{{$cppt->FS_PLAN4}}
                                    <ul style="padding:0px;margin-left: 11px;">
                                        @if ($cppt->FS_IPPA4A != '')
                                        <li>{{$cppt->FS_IPPA4A}}</li>
                                        @endif
                                        @if ($cppt->FS_IPPA4B != '')
                                        <li>{{$cppt->FS_IPPA4B}}</li>
                                        @endif
                                        @if ($cppt->FS_IPPA4C != '')
                                        <li>{{$cppt->FS_IPPA4C}}</li>
                                        @endif
                                    </ul>
                                </li>
                                @endif


                            </ul>
                        </div>
                        @endif

                        @if ($cppt->TB_FROM == 'asesmen_dokter')
                        {{-- <ul>
                                                        <li>Pulang <input type="checkbox" disabled {{json_decode($cppt->FT_ASSESMENT)->Pulang == 'on' ? 'checked' : ''}}>
                        </li>
                        <li>Kontrol Tgl : {{json_decode($cppt->FT_ASSESMENT)->KontrolTanggalText}}</li>
                        <li>Konsul Ke : {{json_decode($cppt->FT_ASSESMENT)->KonsulKeText}}</li>
                        <li>Rujuk Ke : {{json_decode($cppt->FT_ASSESMENT)->RujukKeText}}</li>
                        <li>Ruang Rawat : {{json_decode($cppt->FT_ASSESMENT)->RawatInapText}}</li>
                        </ul> --}}
                        <span>{{$cppt->FT_ASSESMENT}}</span>
                        @else

                        @endif


                    </td>
                    <td style="vertical-align:top;">
                        <span class="d-block">Verified By :</span>
                        @if ($cppt->FS_KD_PEG == Auth::user()->fs_kd_peg)
                        @if ($cppt->TB_FROM == 'cppt')
                        @if ($cppt->FS_VERIFIED_BY)
                        <span class="d-block">{{$cppt->FS_DPJP}}</span>
                        <a href="{{route('cppt.unverified',$cppt->FN_ID)}}">
                            <button class="btn btn-sm btn-danger">Unverify</button>
                        </a>
                        @else
                        <a href="{{route('cppt.verified',$cppt->FN_ID)}}">
                            <button class="btn btn-sm btn-success">Verify</button>
                        </a>
                        @endif
                        @elseif ($cppt->TB_FROM == 'asesmen_dokter')
                        @if ($cppt->FS_VERIFIED_BY)
                        <span class="d-block">{{$cppt->FS_DPJP}}</span>
                        <a href="{{route('asesmen-dokter.unverified',$cppt->FN_ID)}}">
                            <button class="btn btn-sm btn-danger">Unverify</button>
                        </a>
                        @else
                        <a href="{{route('asesmen-dokter.verified',$cppt->FN_ID)}}">
                            <button class="btn btn-sm btn-success">Verify</button>
                        </a>
                        @endif
                        @elseif ($cppt->TB_FROM == 'asesmen_dokter_bidan')
                        @if ($cppt->FS_VERIFIED_BY)
                        <span class="d-block">{{$cppt->FS_DPJP}}</span>
                        <a href="{{route('asesmen-dokter-bidan.unverified',$cppt->FN_ID)}}">
                            <button class="btn btn-sm btn-danger">Unverify</button>
                        </a>
                        @else
                        <a href="{{route('asesmen-dokter-bidan.verified',$cppt->FN_ID)}}">
                            <button class="btn btn-sm btn-success">Verify</button>
                        </a>
                        @endif
                        @else
                        @if ($cppt->FS_VERIFIED_BY)
                        <span class="d-block">{{$cppt->FS_DPJP}}</span>
                        <a href="{{route('asesmen-perawat.unverified',$cppt->FN_ID)}}">
                            <button class="btn btn-sm btn-danger">Unverify</button>
                        </a>
                        @else
                        <a href="{{route('asesmen-perawat.verified',$cppt->FN_ID)}}">
                            <button class="btn btn-sm btn-success">Verify</button>
                        </a>
                        @endif
                        @endif
                        @else
                        @if ($cppt->FS_VERIFIED_BY)
                        <span class="d-block">{{$cppt->FS_DPJP}}</span>

                        @else
                        <p style="font-size: 9.2px;    white-space: normal !important;" class="badge bg-danger">Not
                            Allowed</p>
                        @endif
                        @endif

                    </td>
                    <td style="vertical-align:top;">
                        {{$cppt->FS_USER}}
                    </td>
                </tr>
                @endforeach



            </tbody>

        </table>


    </div>


</body>

</html>
