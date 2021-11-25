<!-- Headings -->
<tr>
    <td colspan="5">
        <h3>{{$rumah_sakit[0]->fs_nm_rs ?? ''}}</h3>
        <h5>{{$rumah_sakit[0]->fs_alm_rs ?? ''}}</h5>
        <p>Tlp : {{$rumah_sakit[0]->fs_tlp_rs ?? ''}}</p>
    </td>
</tr>
<tr>
    <td colspan="3">
        <span style="">Nomor MR</span>
        : {{$rekam_medis->FS_MR}}
    </td>
</tr>
<tr>
    <td colspan="3">
        Nama Pasien
        : {{$rekam_medis->FS_NM_PASIEN}}
    </td>

</tr>
<tr></tr>

<table>
    <tr>
        <td>No</td>
        <td >Tanggal Jam</td>
        <td >Profesi / Bagian</td>
        <td>Hasil Pemeriksaan/Assesmen, Analisis dan Rencana Penatalaksanaan</td>
        <td>Instruksi / Tindak Lanjut</td>
        <td>Verifikasi</td>
        <td >User</td>
    </tr>
    @foreach ($CPPT as $cppt)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{date('d-m-Y H:i:s',strtotime($cppt->FD_DATE))}}</td>
        <td>
            <span class="badge bg-primary d-block "
                style="font-size: 10px;margin-bottom:3px;background: #038EDC;padding:3px;display:block;">{{$cppt->FS_PROFESI}}</span>
                <br>
            <span class="badge bg-secondary "
                style="font-size: 10px;    white-space: normal !important;margin-bottom:3px;background: #74788D;padding:3px;display:block;">{{$cppt->FS_NM_LAYANAN}}</span>
                <br>
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

</table>
