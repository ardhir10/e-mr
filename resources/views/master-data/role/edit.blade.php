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
                <form action="{{ route('role.update',$role->id) }}" method="post">
                    @csrf
                   <div class="form-group">
                        <label for=""><strong>Name</strong></label>
                        <input type="text" name="name" value="{{$role->name}}" class="form-control" placeholder="Role name">
                    </div>
                     {{-- <div class="form-group">
                        <label for=""><strong>Permissions</strong></label>
                        <select name="permissions[]" class="form-control" multiple id="select-permission-type">
                            @foreach ($permissions as $p)
                                <option value="{{$p->id}}">{{$p->name}}</option>
                            @endforeach
                        </select>
                    </div> --}}

                     <div class="form-group">
                        <label for="">Permissions</label>
                        <br>
                        @foreach ($permissions as $p)
                        <div style="display:block">
                            <input {{in_array($p->id,array_column($my_permissions, 'id')) ? 'checked' :''}} name="permissions[]" type="checkbox" value="{{$p->id}}">
                            <small>{{$p->name}}</small>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-2">
                        <button class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>
                            Save</button>
                        <a href="{{route('role.index')}}" class="btn btn-sm btn-danger"><i
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
    // var options = document.getElementById('select-permission-type').selectedOptions;
    var options = @json($role->permissions);
    console.log(options[0].id);

    var values = options.map((v)=>{
        return v.id
    });
    $('#select-permission-type').val(values);
</script>
@endpush
