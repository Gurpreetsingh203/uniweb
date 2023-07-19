@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <a href="{{ route('school.create') }}">
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
                                    <!-- <th>Firstname</th>
                                    <th>Lastname</th> -->
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Created</th>
                                    <th class="text-center">Group</th>
                                    <th class="text-center">Student</th>
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
            ajax: "{{ route('school.index') }}",
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
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'contact',
                    name: 'contact'
                },
                {
                    data: 'created',
                    name: 'created'
                },
                {
                    data: 'group',
                    name: 'group',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'student',
                    name: 'student',
                    orderable: false,
                    searchable: false
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
                text: "Once deleted, you will not be able to recover this school!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "DELETE",
                        url: SITE_URL + '/admin/school/' + id,
                        success: function() {
                            swal("Poof! Your school has been deleted!", {
                                icon: "success",
                            });
                            $('.data-table').DataTable().ajax.reload();
                        }
                    });
                } else {
                    swal("Your school is safe!");
                }
            });
    }
</script>
@endsection

@endsection
