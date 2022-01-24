@extends('layouts.main')

@section('content')

<div class="page-title-actions">
    <div class="d-inline-block dropdown" style="float: right">
        <a href="#" class="btn btn-primary btn-icon-split btn-sm cetak mb-2" data-toggle="modal" data-target=".create-jadwal">
            <span class="icon text-white-50">
                <i class="fas fa-pen"></i>
            </span>
            <span class="text">Create Anggota</span>
        </a>
    </div>
    <div class="clear" style="clear: both"></div>
</div>
<br>
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Anggota List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered dt-responsive wrap" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $key => $anggota)
                    <tr class="text-center">
                        <td>{{$key+1}}</td>
                        <td>{{$anggota->username}}</td>
                        <td>{{$anggota->email}}</td>
                        <td><a href="" class="btn btn-primary btn-icon-split btn-sm edit" data-toggle="modal" data-target="#edit-rekap-absen"><span class="icon text-white-50"><i class="fas fa-pen"></i></span><span class="text">Edit</span></a>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

 <!-- Modal Create Jadwal -->
<div class="modal fade create-jadwal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="post" action="{{url('jadwal/create')}}">
                {{ csrf_field() }}
                <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control nama" id="nama" placeholder="Masukkan Nama" autocomplete="off">
                <div id="namaList"></div>
                </div>

                <div class="form-group">
                    <label for="jadwal">Jadwal</label>
                    <input type="text" class="form-control" name="jadwal" id="jadwal" placeholder="Masukkan Jadwal">
                </div>

                <div class="form-group">
                    <label for="gaji">Gaji</label>
                    <input type="text" class="form-control" name="gaji" id="gaji" placeholder="Masukkan Gaji">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button  class="btn btn-primary" type="submit">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Jadwal -->
<div class="modal fade edit-jadwal" id="edit-jadwal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{url('jadwal/update')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id2" id="idJadwal" placeholder="Masukkan Jadwal">
                <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama2" class="form-control nama" id="nama2" placeholder="Masukkan Nama" autocomplete="off">
                <div id="namaList"></div>
                </div>

                <div class="form-group">
                    <label for="tanggal_hadir">Jadwal</label>
                    <input type="text" class="form-control jadwal" name="jadwal2" id="jadwal2" placeholder="Masukkan Jadwal">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button  class="btn btn-primary" type="submit">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
