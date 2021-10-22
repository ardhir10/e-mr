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
                <a href="{{route('user.create')}}" class="btn btn-success btn-sm"> Create New <i
                        class="fa fa-plus align-middle"></i></a>
            </div>
            <div class="card-body">
                <div class="col-12">
                    @include('components.flash-message')
                </div>
                <table class="cell-border" id="data-table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama </th>
                            <th width="20%">Nama Pegawai </th>
                            <th>Email </th>
                            <th>Username </th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px">
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->namaDokter()}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->username}}</td>
                            <td>
                                <a href="{{route('user.edit',$user->id)}}"
                                    class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i> EDIT</a>

                                    @if (Auth::user()->id != $user->id)

                                    <button class="btn btn-sm btn-danger"
                                    onclick="return confirmDelete('{{route('user.delete',$user->id)}}')">
                                    <i class="fa fa-trash"></i> DELETE</button>
                                    @endif
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
