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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{$page_title}}</h4>
                {{-- <a href="{{route('satuan-tugas-medis.create')}}" class="btn btn-success btn-sm"> Create New <i
                        class="fa fa-plus align-middle"></i></a> --}}
            </div>
            <div class="card-body">
                <div class="col-12">
                    @include('components.flash-message')
                </div>
                <table class="cell-border" id="data-table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama </th>
                            {{-- <th width="20%">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px">
                        @foreach ($dokter as $dk)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$dk->fs_dokter}}</td>
                            {{-- <td>
                                <a href="{{route('satuan-tugas-medis.edit',$ly->FS_KD_LAYANAN)}}"
                                    class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i> EDIT</a>
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirmDelete('{{route('satuan-tugas-medis.delete',$ly->FS_KD_LAYANAN)}}')">
                                    <i class="fa fa-trash"></i> DELETE</button>
                            </td> --}}
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
