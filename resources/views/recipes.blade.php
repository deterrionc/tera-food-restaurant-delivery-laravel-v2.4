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
                                    <h3 class="mb-0">Recipes</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#createRecipeModal">
                                        Add Recipe
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">

                        </div>

                        <!-- Recipe Create Modal -->
                        <div class="modal fade" id="createRecipeModal" tabindex="-1" role="dialog"
                            aria-labelledby="createRecipeModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createRecipeModalLabel">Create a new Recipe</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Recipe Title</label>
                                            <input type="text" class="form-control" id="recipeTitle"
                                                placeholder="Beef Stake">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="createRecipe">Save
                                            changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recipe Edit Modal -->
                        <div class="modal fade" id="editRecipeModal" tabindex="-1" role="dialog"
                            aria-labelledby="editRecipeModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="/updateRecipeByAjax" method="POST" enctype="multipart/form-data"
                                        id="updateRecipe">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editRecipeModalLabel">Edit a Recipe</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body row">
                                            <div class="form-group" style="display: none">
                                                <label>Id</label>
                                                <input type="text" class="form-control" id="updateRecipeId" name="id">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Title</label>
                                                <input type="text" class="form-control" id="updateRecipeTitle" name="title">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Image</label>
                                                <input type="file" class="form-control" id="updateRecipeImage" name="file">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Youtube</label>
                                                <input type="text" class="form-control" id="updateRecipeYoutube"
                                                    name="youtube">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Category</label>
                                                <select class="form-control" id="updateRecipeCategory" name="category">
                                                    @foreach ($categories as $item)
                                                        <option value={{ $item->id }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Tags</label>
                                                <select class="form-control" id="updateRecipeTagSelect">
                                                    <option value="">Select Tag</option>
                                                    @foreach ($tags as $item)
                                                        <option value={{ $item->name }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Tags Selected</label>
                                                <input type="text" class="form-control" id="updateRecipeTags"
                                                    name="tags">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update Recipe</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Recipe Delete Modal -->
                        <div class="modal fade" id="deleteRecipeModal" tabindex="-1" role="dialog"
                            aria-labelledby="deleteRecipeModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteRecipeModalLabel">Are you sure to delete this
                                            recipe?
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Id</label>
                                            <input type="text" class="form-control" id="deleteRecipeId" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" id="deleteRecipeTitle" disabled>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="deleteRecipe">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>image</th>
                                        <th>youtube</th>
                                        <th>category</th>
                                        <th>tags</th>
                                        <th>type</th>
                                        <th>quantity</th>
                                        <th>description</th>
                                        <th>ingredients</th>
                                        <th>prepare</th>
                                        <th>tips</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($recipes); $i++)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $recipes[$i]->title }}</td>
                                            <td><img src="{{ asset('storage/app/' . $recipes[$i]->image) }}"
                                                    alt="no image" width="50px" height="50px"></td>
                                            <td>
                                                <div id="panel-9-11-0-0"
                                                    class="so-panel widget widget_sow-editor panel-first-child"
                                                    data-index="27">
                                                    <iframe width="50" height="50" src={{ $recipes[$i]->youtube }}
                                                        frameborder="0" allow="autoplay; encrypted-media"
                                                        allowfullscreen></iframe>
                                                </div>
                                            </td>
                                            <td>{{ $recipes[$i]->categoryName }}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#editRecipeModal"
                                                            onclick="getRecipeForUpdate({{ $i }}, {{ $recipes }})">Edit</a>
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#deleteRecipeModal"
                                                            onclick="getRecipeForDelete({{ $i }}, {{ $recipes }})">Delete</a>
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
            $("#createRecipe").click(function() {
                var title = $("#recipeTitle").val();
                if (title) {
                    $.ajax({
                        url: '/createRecipeByAjax',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            title: title,
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            window.location.href = "/recipe"
                        }
                    });
                }
            })

            $('#updateRecipe').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                console.log(formData)
                $.ajax({
                    type: 'POST',
                    url: '/updateRecipeByAjax',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        console.log(data)
                        // this.reset();
                        // window.location.href = "/recipe"
                    },
                    error: function(data) {
                        alert("There is an error. Try again.")
                    }
                });
            })

            $("#deleteRecipe").click(function() {
                var id = $("#deleteRecipeId").val();
                if (id) {
                    $.ajax({
                        url: '/deleteRecipeByAjax',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            id: id,
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            window.location.href = "/recipe"
                        }
                    });
                }
            })

            $("#updateRecipeTagSelect").change(function() {
                var tag = $("#updateRecipeTagSelect").val()
                console.log(tag)
            })
        });

        function getRecipeForUpdate(index, recipes) {
            var recipe = recipes[index]
            $("#updateRecipeId").val(recipe.id);
            $("#updateRecipeTitle").val(recipe.title);
            $("#updateRecipeYoutube").val(recipe.youtube);
            $("#updateRecipeCategory").val(recipe.categoryID);
        }

        function getRecipeForDelete(index, recipes) {
            var recipe = recipes[index]
            $("#deleteRecipeId").val(recipe.id);
            $("#deleteRecipeTitle").val(recipe.title);
        }
    </script>
@endpush
