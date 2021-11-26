<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      {{-- <link rel="icon" type="image/x-icon" href="{{asset('assets/images/iconsolvus.png')}}"> --}}
    <link href="../../../favicon.ico" rel="icon" type="image/x-icon" />
      {{-- <link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAADAxeYA3+DcAH55ewDg4uIA2+L9AKeorADl5+gAzNDjAJaXlQCsrKYAdlrbAC8x+wD6/v8AMTH7AJiYmACChocA/P7/AISDhwDp6+sAAQD6AP/+/wAAAf0AgH+xAO7w8QCfoJ4Aop2eAJ+i/QDV2/IApZ6hAPL09ADd5ewA9/b6AJOTkwDk5uYAUkbgAKiqqgCEgH8A6OTpAPn/+gCDhIIA+/39AOrn6QD9/f0A1NfVAP//+gDX1tIA//39AOnr7ADn6vIA1tjYANjY2ACLiYgAjI2LAN7c2wDz8PIA9fDyAJCPkQDh4eEA9vf1AMvQ0wBGQfYA9vj4ANDOzQCqrasA6OnnANXT0wD+//sAhoSDAP/9/gCYmZ0AytfxAAED/ACdnpoAiYmJAHt5xQCen50AnqCgANzc3ADv8vAAoqCgAPH18ADz8/MABQG4AN/h4gDy9/YA4uDfAFc/zQDQzNEAlJCVAKepqQDl5eUAMADYAP34+QD6/PwAnIn9AMjR8gD8+v8AmJmVAPz9/wDr6egA/v3/AP/9/wD///wAAAD9AAIA/QA2M/sAYkvWAKirygDZ2NoA2tzdAIuMigAwM70AAAC2AAMAtgD08vEA9fb0APX39wDz+vcAkJKTAF8y5gD8//0A6+npAP7//QDr6uwAAAD+AAAC+wDR4NgAAgD+AHdm3wCIiIgAAAK0AKGdogAEALcA9PLyAAcAtwDCyugAz83NAJOSlADk5OQAlJOXAJeVlADo5ecA+/v7APr//gCurKsAeFzdAP3//gA1MvoA///+AAIB+QB2V/IA6+3tAAMC/ADt7e0A2NriAAIAuAD09fMA4+DiAJGPlQD69/kA+fj8AP76+QD6//8A+///AK6srAD9//8ANwnSAP///wA4IMYA3NvdAO/x8QAoC74Ap6enAOfk5gD6+voA5ujpAC40+QBXVs4A6OvpANXV1QD//v0A7ejpAIiDhQACAfsAAQL+AImKiADt7vIAiYuLAJ+gnADU4OQAxNDQAMrI3ACopqUAqaqoAKurqwAuMv0A09XWAPz+/gD+/v4AAAD5AP/+/gCMh4kAn52dAAABtQB4eHgAdW3vAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAZZTIWIk0uUkzucmBDyQCzCylxcp7KSmvBoqKOQFtMm6lpXpIErJjJVqtA51VTWy7pS6nwB6rqL61eUCNUzs1IKeUo6w6G2pKX5khfocWqTinp8VZoB+9sW9rClZbppqMxrTIwV0uVBo8RndeAAcvDqfGkiN6tMgEIoAwdFCcuginxacJo2W0dZGWKI5cPR1FlKUqBbR6ZGDNvyZEKJ8XGWaGgsuEm3Fwy3KLQye2EWFiaLjHlbd9R1I3wqKul4grlBOYFX98fGdxUT+hc1ctNqVpDQsLw5OwFSikOj5BTqWUDJSexo94yEIQkMSzqqcUxXpkvBhLTINPdhwxhaWUpwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=" rel="icon" type="image/x-icon" /> --}}

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
                                : {{date('d-m-Y',strtotime($rekam_medis->FD_TGL_LAHIR))}}
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
