<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$page_title}}</title>
    <style>
        body{
            background: white !important;
        }
        @page { margin: 20px; }

    </style>
</head>
<body style="font-family:sans-serif ;">
    <div class="">
       <div style="font-size:14px;">
            <span style="float: right;font-weight:bolder;">FORM CPPT</span>
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
                        <tr>
                            <td>
                                Tanggal Lahir
                            </td>
                            <td>
                                : {{$rekam_medis->FD_TGL_LAHIR}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jenis Kelamin
                            </td>
                            <td>
                                : {{$rekam_medis->FB_JNS_KELAMIN == 0 ? 'LAKI - LAKI':'PEREMPUAN'}}
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td>
                                Register
                            </td>
                            <td>
                                : {{$rekam_medis->FS_KD_REG}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tanggal Jam Masuk
                            </td>
                            <td>
                                : {{date('d-m-Y',strtotime($rekam_medis->FD_TGL_MASUK))}} {{$rekam_medis->FS_JAM_MASUK}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Dokter DPJP
                            </td>
                            <td>
                                : {{$rekam_medis->FS_NM_PEG}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jaminan/ Cara Bayar
                            </td>
                            <td>
                                : {{$rekam_medis->fs_nm_jaminan}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <hr>

        {{-- PROFESI/LAYANAN --}}
        <table style="font-size:12px; width:100%;">
            <tr>
                <td style="width: 50%">
                    <table>
                        <tr>
                            <td><span style="width: 110px;">Profesi </span></td>
                            <td> : Dokter</td>
                        </tr>

                    </table>
                </td>
                <td style="width: 50%">
                    <table><tr>
                            <td><span style="width: 120px;">Layanan / Bagian</span></td>
                            @foreach ($layanan_bagian as $lb)
                            @if ($CPPT->FS_KD_LAYANAN == $lb->FS_KD_LAYANAN)
                                <td> : {{$lb->FS_NM_LAYANAN}}</td>
                            @endif
                            @endforeach
                        </tr></table>
                </td>
            </tr>
        </table>
        <hr>
        {{-- SOAP --}}
        <div style="width:100%">
            <span style="font-size: 14px;display:block;font-weight:bold;">Subjective</span>
            <span style="font-size: 12px;">
                <textarea style="width: 100% ;font-family:sans-serif;padding:5px;border-radius:5px;height:auto;min-height:30px;" readonly>{{$CPPT->FT_SUBJECTIVE}}</textarea>
            </span>
        </div>

        <div style="width:100%">
            <span style="font-size: 14px;display:block;font-weight:bold;">Objective</span>
            <span style="font-size: 12px;">
                <textarea style="width: 100% ;font-family:sans-serif;padding:5px;border-radius:5px;height:auto;min-height:30px;" readonly>{{$CPPT->FT_OBJECTIVE}}</textarea>
            </span>
        </div>

        <div style="width:100%">
            <span style="font-size: 14px;display:block;font-weight:bold;">Assesmen</span>
            <span style="font-size: 12px;">
                <textarea style="width: 100% ;font-family:sans-serif;padding:5px;border-radius:5px;height:auto;min-height:30px;" readonly>{{$CPPT->FT_ASSESMENT}}</textarea>
            </span>
        </div>

        <div style="width:100%">
            <span style="font-size: 14px;display:block;font-weight:bold;">Plan :</span>
            <span style="font-size: 14px;display:block;">Instruksi PPA (Termasuk Pasca Bedah)</span>
            <div style="width: 100%;font-size: 12px;">
                <table style="width: 100%">
                    <tr>
                        <td style="vertical-align:top">1.</td>
                        <td>
                            <textarea style="width: 100% ;font-family:sans-serif;padding:5px;border-radius:5px;height:auto;display:block;min-height:30px;" readonly>{{$CPPT->FS_PLAN1}} </textarea>
                            <table style="width: 100%">
                                <tr>
                                    <td width="50px">1.a</td>
                                    <td>
                                        <input type="text" readonly style="border-radius:5px;width:100%;" value="{{$CPPT->FS_IPPA1A}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50px">1.b</td>
                                    <td>
                                        <input type="text" readonly style="border-radius:5px;width:100%;" value="{{$CPPT->FS_IPPA1B}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50px">1.c</td>
                                    <td>
                                        <input type="text" readonly style="border-radius:5px;width:100%;" value="{{$CPPT->FS_IPPA1C}}">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align:top">2.</td>
                        <td>
                            <textarea style="width: 100% ;font-family:sans-serif;padding:5px;border-radius:5px;height:auto;display:block;min-height:30px;" readonly>{{$CPPT->FS_PLAN2}} </textarea>
                            <table style="width: 100%">
                                <tr>
                                    <td width="50px">2.a</td>
                                    <td>
                                        <input type="text" readonly style="border-radius:5px;width:100%;" value="{{$CPPT->FS_IPPA2A}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50px">2.b</td>
                                    <td>
                                        <input type="text" readonly style="border-radius:5px;width:100%;" value="{{$CPPT->FS_IPPA2B}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50px">2.c</td>
                                    <td>
                                        <input type="text" readonly style="border-radius:5px;width:100%;" value="{{$CPPT->FS_IPPA2C}}">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>


                     <tr>
                        <td style="vertical-align:top">3.</td>
                        <td>
                            <textarea style="width: 100% ;font-family:sans-serif;padding:5px;border-radius:5px;height:auto;display:block;min-height:30px;" readonly>{{$CPPT->FS_PLAN3}} </textarea>
                            <table style="width: 100%">
                                <tr>
                                    <td width="50px">3.a</td>
                                    <td>
                                        <input type="text" readonly style="border-radius:5px;width:100%;" value="{{$CPPT->FS_IPPA3A}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50px">3.b</td>
                                    <td>
                                        <input type="text" readonly style="border-radius:5px;width:100%;" value="{{$CPPT->FS_IPPA3B}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50px">3.c</td>
                                    <td>
                                        <input type="text" readonly style="border-radius:5px;width:100%;" value="{{$CPPT->FS_IPPA3C}}">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                     <tr>
                        <td style="vertical-align:top">4.</td>
                        <td>
                            <textarea style="width: 100% ;font-family:sans-serif;padding:5px;border-radius:5px;height:auto;display:block;min-height:30px;" readonly>{{$CPPT->FS_PLAN4}} </textarea>
                            <table style="width: 100%">
                                <tr>
                                    <td width="50px">4.a</td>
                                    <td>
                                        <input type="text" readonly style="border-radius:5px;width:100%;" value="{{$CPPT->FS_IPPA4A}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50px">4.b</td>
                                    <td>
                                        <input type="text" readonly style="border-radius:5px;width:100%;" value="{{$CPPT->FS_IPPA4B}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50px">4.c</td>
                                    <td>
                                        <input type="text" readonly style="border-radius:5px;width:100%;" value="{{$CPPT->FS_IPPA4C}}">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>


    </div>


</body>
</html>
