<script>
    $(document).ready( function () {
    $('#pinjamanBukuTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('list-pinjaman-buku') }}",
        columns: [
                    { data: 'id', name: 'id', sClass:'text-center'},
                    { data: 'judul_buku', name: 'judul_buku', sClass:'text-center'},
                    { data: 'tahun_terbit', name: 'tahun_terbit', sClass:'text-center'},
                    { data: 'penulis', name: 'penulis', sClass:'text-center'},
                    { data: 'tanggal_peminjaman', name: 'tanggal_peminjaman', sClass:'text-center'},
                    { data: 'tanggal_pengembalian', name: 'tanggal_pengembalian', sClass:'text-center'},
                    { data: 'is_status', name: 'is_status', sClass:'text-center'},
                ]
        });
    });
</script>
