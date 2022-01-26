<script>
    $(document).ready( function () {
    $('#listPeminjamanBukuTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('peminjaman-buku') }}",
        columns: [
                    { data: 'id', name: 'id', sClass:'text-center'},
                    { data: 'username', name: 'username', sClass:'text-center'},
                    { data: 'judul_buku', name: 'judul_buku', sClass:'text-center'},
                    { data: 'stok_buku', name: 'stok_buku', sClass:'text-center'},
                    { data: 'tanggal_peminjaman', name: 'tanggal_peminjaman', sClass:'text-center'},
                    { data: 'tanggal_pengembalian', name: 'tanggal_pengembalian', sClass:'text-center'},
                    { data: 'is_status', name: 'is_status', sClass:'text-center'},
                    { data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
                ]
        });
    });

    $('body').on('click', '#updateStatus', function(){
    updateId = $(this).data('id');
    });
    $(document).on('click', '#UpdateModalForm', function(e) {
        e.preventDefault();
        var id = updateId;
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            async: true,
            url: "{{ url('update-status') }}",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(rt) {
                if (rt == 'Success di update') {
                    alert('Success di update!');
                    window.location.reload();
                    window.location.href = "{{ url('list-peminjaman-buku') }}";
                }else if(rt == 'List peminjaman sudah di update!'){
                    alert('Peminjaman sudah di update!');
                    $('#UpdateStatusModal').modal('hide');
                }
            }
        });
    });
</script>
