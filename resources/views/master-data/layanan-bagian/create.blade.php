@extends('main')


@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        {{-- <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">{{$page_title}}</h4>
    </div>
</div>
</div> --}}
<!-- end page title -->
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{$page_title}}</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{route('layanan.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Kode Layanan <span class="text-danger">*</span></label>
                        <input placeholder="masukkan kode layanan" type="text" class="form-control"
                            name="FS_KD_LAYANAN" value="{{old('FS_KD_LAYANAN')}}">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Nama Layanan <span class="text-danger">*</span></label>
                        <input placeholder="masukkan nama layanan" type="text" class="form-control"
                            name="FS_NM_LAYANAN" value="{{old('FS_NM_LAYANAN')}}">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Instalasi <span class="text-danger">*</span></label>
                        <select class="form-control" name="FS_NM_INSTALASI" id="">
                            <option value="">---PILIH INSTALASI</option>
                            @foreach ($instalasi as $instl)
                                <option {{old('FS_NM_INSTALASI') == $instl->FS_NM_INSTALASI ? 'selected=selected': '' }} value="{{$instl->FS_NM_INSTALASI}}">{{$instl->FS_NM_INSTALASI}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mt-2">
                        <button class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>
                            Save</button>
                        <a href="{{route('satuan-tugas-medis.index')}}" class="btn btn-sm btn-danger"><i
                                class="fa fa-arrow-left"></i> Back</a>
                    </div>
                </form>

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
