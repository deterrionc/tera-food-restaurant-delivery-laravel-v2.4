@extends('layouts.admin')

@section('content')

    <div class="main-content">
        <!-- Top navbar -->
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">

        </div>
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Users</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#createUserModal">
                                        Add user
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">

                        </div>

                        <!-- User Create Modal -->
                        <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog"
                            aria-labelledby="createUserModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createUserModalLabel">Create a new Customer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" id="userName" placeholder="John Doe">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="userEmail"
                                                placeholder="johndoe@gmail.com">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" id="userPassword">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="createUser">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User Edit Modal -->
                        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog"
                            aria-labelledby="editUserModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editUserModalLabel">Edit a Customer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Id</label>
                                            <input type="text" class="form-control" id="updateUserId" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" id="updateUserName">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="updateUserEmail">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="updateUser">Update User</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User Delete Modal -->
                        <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog"
                            aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteUserModalLabel">Are you sure to delete this user?
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Id</label>
                                            <input type="text" class="form-control" id="deleteUserId" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" id="deleteUserName" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="deleteUserEmail" disabled>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="deleteUser">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Creation Date</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">active / deactive</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($users); $i++)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $users[$i]->name }}</td>
                                            <td>{{ $users[$i]->id }}</td>
                                            <td>
                                                <a href="mailto:{{ $users[$i]->email }}">{{ $users[$i]->email }}</a>
                                            </td>
                                            <td>{{ $users[$i]->created_at }}</td>
                                            <td>{{ $users[$i]->type }}</td>
                                            <td>
                                                <input onchange="updateUserState({{ $users[$i] }})"
                                                    data-id="{{ $users[$i]->id }}" class="toggle-class" type="checkbox"
                                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                    data-on="Active" data-off="InActive"
                                                    {{ $users[$i]->status == 'active' ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#editUserModal"
                                                            onclick="getUserForUpdate({{ $users[$i] }})">Edit</a>
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#deleteUserModal"
                                                            onclick="getUserForDelete({{ $users[$i] }})">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">

                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="row align-items-center justify-content-xl-between">
                    <div class="col-xl-6">
                        <div class="copyright text-center text-xl-left text-muted">
                            © 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1"
                                target="_blank">Creative Tim</a> &amp;
                            <a href="https://www.updivision.com" class="font-weight-bold ml-1"
                                target="_blank">Updivision</a>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.updivision.com" class="nav-link" target="_blank">Updivision</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About
                                    Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md"
                                    class="nav-link" target="_blank">MIT License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>

@endsection

@push('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function() {
            $("#createUser").click(function() {
                var name = $("#userName").val();
                var email = $("#userEmail").val();
                var password = $("#userPassword").val();
                if (name && email && password) {
                    $.ajax({
                        url: '/createCustomerByAjax',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            name: name,
                            email: email,
                            password: password,
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            window.location.href = "/user"
                        }
                    });
                }
            })
            $("#updateUser").click(function() {
                var id = $("#updateUserId").val();
                var name = $("#updateUserName").val();
                var email = $("#updateUserEmail").val();
                if (name && email) {
                    $.ajax({
                        url: '/updateCustomerByAjax',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            id: id,
                            name: name,
                            email: email,
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            window.location.href = "/user"
                        }
                    });
                }
            })
            $("#deleteUser").click(function() {
                var id = $("#deleteUserId").val();
                var name = $("#deleteUserName").val();
                var email = $("#deleteUserEmail").val();
                if (name && email) {
                    $.ajax({
                        url: '/deleteCustomerByAjax',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            id: id,
                            name: name,
                            email: email,
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            window.location.href = "/user"
                        }
                    });
                }
            })
        });

        function getUserForUpdate(user) {
            $("#updateUserId").val(user.id);
            $("#updateUserName").val(user.name);
            $("#updateUserEmail").val(user.email);
        }

        function getUserForDelete(user) {
            $("#deleteUserId").val(user.id);
            $("#deleteUserName").val(user.name);
            $("#deleteUserEmail").val(user.email);
        }

        function updateUserState(user) {
            var status = '';
            if (user.status == 'active') status = 'inactive'
            else status = 'active'
            $.ajax({
                url: '/updateCustomerStatusByAjax',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    id: user.id,
                    status: status,
                },
                dataType: 'JSON',
                success: function(data) {

                }
            });
        }
    </script>
@endpush
