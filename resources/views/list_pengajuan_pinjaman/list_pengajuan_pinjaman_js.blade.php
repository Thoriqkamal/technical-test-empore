<script>
    $(document).ready( function () {
    $('#pengajuanPinjamanTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('pengajuan-pinjaman') }}",
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

$('body').on('click', '#approvePinjaman', function(){
    approveId = $(this).data('id');
})
$(document).on('click', '#ApproveModalForm', function(e) {
    e.preventDefault();
    var id = approveId;
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    $.ajax({
        async: true,
        url: "{{ url('approve-pinjaman') }}",
        method: "POST",
        data: {
            id: id
        },
        dataType: "json",
        success: function(rt) {
            if (rt == 'Success di approve') {
                alert('Success di Approve!');
                window.location.reload();
                window.location.href = "{{ url('list-pengajuan-peminjaman') }}";
            }else if (rt == 'Tidak bisa approve status reject!') {
                alert('Tidak bisa approve status reject!');
                $('#ApproveModal').modal('hide');
            }else if(rt == 'Pengajuan sudah di Approve!'){
                alert('Pengajuan sudah di Approve!');
                $('#ApproveModal').modal('hide');
            }else if (rt == 'Tidak bisa approve status sudah di kembalikan!') {
                alert('Tidak bisa approve status sudah di kembalikan!');
                $('#ApproveModal').modal('hide');
            }
        }
    });
});

$('body').on('click', '#rejectPinjaman', function(){
    rejectId = $(this).data('id');
})
$(document).on('click', '#RejectModalForm', function(e) {
    e.preventDefault();
    var id = rejectId;
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    $.ajax({
        async: true,
        url: "{{ url('reject-pinjaman') }}",
        method: "POST",
        data: {
            id: id
        },
        dataType: "json",
        success: function(rt) {
            if (rt == 'Success di reject') {
                alert('Success di Reject!');
                window.location.reload();
                window.location.href = "{{ url('list-pengajuan-peminjaman') }}";
            }else if(rt == 'Pengajuan sudah di reject!'){
                alert('Pengajuan sudah di Reject!');
                $('#RejectModal').modal('hide');
            }else if(rt == 'Tidak bisa reject status approve!'){
                alert('Tidak bisa reject status approve!');
                $('#RejectModal').modal('hide');
            }else if(rt == 'Tidak bisa reject status sudah di kembalikan!'){
                alert('Tidak bisa reject status sudah di kembalikan!');
                $('#RejectModal').modal('hide');
            }
        }
    });
});
</script>
