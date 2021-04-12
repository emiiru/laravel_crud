<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Users</title>
    <!-- Bootstrap core CSS -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>

<body>

    <main role="main" class="container mt-3">
        <div class="row">
            <div class="col-md-6">
                <h1>Users</h1>
            </div>
            <div class="col-md-6">
                <a href="{{route('users.create')}}" class="btn btn-primary float-right">Add User</a>
            </div>
        </div>
        <table id="users-table" class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td>
                        <a href="{{route('users.show',$user->id)}}" class="btn btn-sm btn-info">View</a>
                        <a href="{{route('users.edit',$user->id)}}" class="btn btn-sm btn-warning">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $user->id }}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>

    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $('#users-table').DataTable({
                columnDefs: [{
                    orderable: false,
                    searchable: false,
                    targets: 4
                }],
                order: [
                    [2, 'asc']
                ]
            });

            $('.btn-delete').click(function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this user",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "{{route('users.delete')}}",
                                type: 'post',
                                dataType: "json",
                                data: {
                                    "id": id
                                },
                                success: function(response) {
                                    swal("User Deleted", {
                                        icon: "success",
                                    });
                                    location.reload();
                                },
                                error: function(xhr) {
                                    swal("Error: " + xhr.responseText, {
                                        icon: "error",
                                    });
                                }
                            });
                        }
                    });
            })
        });

    </script>
</body>

</html>
