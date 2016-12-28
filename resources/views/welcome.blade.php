<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Laravel Ajax User</title>

    <!-- Load Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-narrow">
        <h2>Laravel Ajax User App</h2>
        <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Add New User</button>
        <div>

            <!-- Table-to-load-the-data Part -->
            <table class="table">
                <thead>
                    <tr>
                        <th>UUID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody id="users-list" name="users-list">
                    @foreach ($users as $user)
                    <tr id="user{{$user->uuid}}">
                        <td>{{$user->uuid}}</td>
                        <td>{{$user->nama}}</td>
                        <td>{{$user->alamat}}</td>
                        <td>
                            <button class="btn btn-warning btn-xs btn-detail open-modal" value="{{$user->uuid}}">Edit</button>
                            <button class="btn btn-danger btn-xs btn-delete delete-user" value="{{$user->uuid}}">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">User Editor</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmusers" name="frmusers" class="form-horizontal" novalidate="">

                                <div class="form-group error">
                                    <label for="inputuser" class="col-sm-3 control-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="username" name="user" placeholder="Nama" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                            <input type="hidden" id="user_id" name="user_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{asset('js/ajax-crud.js')}}"></script>
</body>
</html>