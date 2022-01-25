@extends('layouts.main')

@section('content')
<br>
<br>
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Peminjaman Buku</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered dt-responsive wrap" id="pinjamanBukuTable" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Tahun Terbit</th>
                        <th>Penulis</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
