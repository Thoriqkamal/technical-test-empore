<script>
    $(document).ready( function () {
    $('#masterBukuTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('master-buku-list') }}",
        columns: [
                    { data: 'id', name: 'id', sClass:'text-center'},
                    { data: 'kode_buku', name: 'kode_buku', sClass:'text-center'},
                    { data: 'judul_buku', name: 'judul_buku', sClass:'text-center'},
                    { data: 'tahun_terbit', name: 'tahun_terbit', sClass:'text-center'},
                    { data: 'penulis', name: 'penulis', sClass:'text-center'},
                    { data: 'stok_buku', name: 'stok_buku', sClass:'text-center'},
                    { data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
                ]
        });
    });
</script>
