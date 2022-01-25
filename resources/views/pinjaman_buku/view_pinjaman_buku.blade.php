@extends('layouts.main')

@section('content')
<br>
@if (\Session::has('status'))
    <div class="alert alert-success">
        {{ \Session::get('status') }}
    </div>
@endif
<br>
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Peminjaman Buku</h6>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <form method="post" action="{{url('create-pinjaman-buku')}}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="col-md-3">
                        <label>Judul Buku<span style="color:red">*</span></label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select id="judul_buku" name="judul_buku" class="custom-select custom-select-sm form-control" required>
                                <option value="">Pilih Buku</option>
                                @foreach ($master_buku as $val)
                                <option value="{{$val->id}}">{{$val->judul_buku}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                        <label>Tanggal Peminjaman<span style="color:red">*</span></label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="date" class="form-control" id="tanggal_pinjaman" name="tanggal_pinjaman" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                        <label>Tanggal Pengembalian<span style="color:red">*</span></label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required>
                        </div>
                    </div>
                </div>

                <div class="text-center col-md-6">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button type="button" class="btn btn-secondary">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
