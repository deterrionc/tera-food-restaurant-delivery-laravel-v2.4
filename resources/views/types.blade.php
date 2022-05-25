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
                                    <h3 class="mb-0">Types</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#createTypeModal">
                                        Add Type
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">

                        </div>

                        <!-- Type Create Modal -->
                        <div class="modal fade" id="createTypeModal" tabindex="-1" role="dialog"
                            aria-labelledby="createTypeModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createTypeModalLabel">Create a new Type</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Type Name</label>
                                            <input type="text" class="form-control" id="typeName" placeholder="Vegetable">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="createType">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Type Edit Modal -->
                        <div class="modal fade" id="editTypeModal" tabindex="-1" role="dialog"
                            aria-labelledby="editTypeModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editTypeModalLabel">Edit a Type</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Id</label>
                                            <input type="text" class="form-control" id="updateTypeId" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" id="updateTypeName">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="updateType">Update Type</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Type Delete Modal -->
                        <div class="modal fade" id="deleteTypeModal" tabindex="-1" role="dialog"
                            aria-labelledby="deleteTypeModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteTypeModalLabel">Are you sure to delete this type?
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Id</label>
                                            <input type="text" class="form-control" id="deleteTypeId" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" id="deleteTypeName" disabled>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="deleteType">Delete</button>
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
                                        <th scope="col">Creation Date</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($types); $i++)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $types[$i]->name }}</td>
                                            <td>{{ $types[$i]->id }}</td>
                                            <td>{{ $types[$i]->created_at }}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#editTypeModal"
                                                            onclick="getTypeForUpdate({{ $types[$i] }})">Edit</a>
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#deleteTypeModal"
                                                            onclick="getTypeForDelete({{ $types[$i] }})">Delete</a>
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

@endpush

@push('js')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function() {
            $("#createType").click(function() {
                var name = $("#typeName").val();
                if (name) {
                    $.ajax({
                        url: '/createTypeByAjax',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            name: name,
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            window.location.href = "/type"
                        }
                    });
                }
            })

            $("#updateType").click(function() {
                var id = $("#updateTypeId").val();
                var name = $("#updateTypeName").val();
                if (name) {
                    $.ajax({
                        url: '/updateTypeByAjax',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            id: id,
                            name: name,
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            window.location.href = "/type"
                        }
                    });
                }
            })

            $("#deleteType").click(function() {
                var id = $("#deleteTypeId").val();
                if (id) {
                    $.ajax({
                        url: '/deleteTypeByAjax',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            id: id,
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            window.location.href = "/type"
                        }
                    });
                }
            })
        });

        function getTypeForUpdate(type) {
            $("#updateTypeId").val(type.id);
            $("#updateTypeName").val(type.name);
        }

        function getTypeForDelete(type) {
            $("#deleteTypeId").val(type.id);
            $("#deleteTypeName").val(type.name);
        }
    </script>
@endpush