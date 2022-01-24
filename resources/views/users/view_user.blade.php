@extends('layouts.main')

@section('content')
<br>
<div class="page-title-actions">
    <div class="d-inline-block dropdown" style="float: right">
        <button style="float: right; font-weight: 900;" class="btn btn-info btn-sm" type="button"  data-toggle="modal" data-target=".create-anggota">
            Create Anggota
        </button>
    </div>
    <div class="clear" style="clear: both"></div>
</div>
<br>
@if (\Session::has('status'))
    <div class="alert alert-success">
        {{ \Session::get('status') }}
    </div>
@endif
<br>
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered dt-responsive wrap" id="userTable" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

 <!-- Modal Create Anggota -->
<div class="modal fade create-anggota" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('create-user')}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password">
                </div>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-primary" type="submit">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Anggota -->
<div class="modal" id="EditProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Anggota</h4>
                <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="{{url('update-user')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" class="form-control" id="id_update_user" name="id_update_user">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="update_username" class="form-control" id="update_username" placeholder="Masukkan Username" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="update_email" id="update_email" placeholder="Masukkan Email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="update_password" id="update_password" placeholder="Masukkan Password">
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Anggota -->
<div class="modal" id="DeleteUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h4>Are you sure want to delete this user?</h4>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="SubmitDeleteUserForm">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
@endsection
