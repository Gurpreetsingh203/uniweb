@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }} Table</h4>
                    <p class="card-description">
                        {{ $title }} <code>list</code>
                    </p>

                    <div class="table-responsive">
                        <table class="table data-table" id="">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
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
            ajax: "{{ route('user.index',['school' => Request::get('school')]) }}",
            columns: [{
                    data: 'rowCount',
                    name: 'rowCount',
                    searchable: false
                },
                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {
                    data: 'email',
                    name: 'email'
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
                text: "Once deleted, you will not be able to recover this user!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "DELETE",
                        url: SITE_URL + '/admin/user/' + id,

                        success: function() {
                            swal("Poof! Your user has been deleted!", {
                                icon: "success",
                            });
                            $('.data-table').DataTable().ajax.reload();
                        }
                    });
                } else {
                    swal("Your user is safe!");
                }
            });
    }
</script>
@endsection

@endsection
