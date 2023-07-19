@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('group.create',['school' => Request::get('school')]) }}">
                        <button type="button" class="btn btn-primary mb-5">
                            <i class="mdi mdi-library-plus"></i>
                        </button>
                    </a>


                    <div class="table-responsive">
                        <table class="table data-table" id="">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Created</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('js')
<script type="text/javascript">
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('group.index',['school' => Request::get('school')]) }}",
            columns: [{
                    data: 'rowCount',
                    name: 'rowCount',
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'created',
                    name: 'created'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Delete school
    function confirmDelete(id) {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this group!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "DELETE",
                        url: SITE_URL + '/admin/group/' + id,

                        success: function() {
                            swal("Poof! Your group has been deleted!", {
                                icon: "success",
                            });
                            $('.data-table').DataTable().ajax.reload();
                        }
                    });
                } else {
                    swal("Your group is safe!");
                }
            });
    }
</script>
@endsection

@endsection
