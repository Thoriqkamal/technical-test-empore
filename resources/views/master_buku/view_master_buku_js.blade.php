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

    $('.modelClose').on('click', function(){
        $('#EditMasterBukuModal').hide();
    });
    var id;
    $('body').on('click', '#getEditMasterBuku', function(e) {
        var id = $(this).data('id');
        var token = $("input[name='_token']").val();
        e.preventDefault();
        $('.alert-danger').html('');
        $('.alert-danger').hide();
        $.ajax({
            url:  "{{ url('get-master-buku') }}",
            method: 'POST',
            data: {
                _token: token,
                id: id
            },
            dataType: "json",
            success: function(result) {
                $('#EditMasterBukuModalBody').html(result.html);
                $('#EditMasterBukuModal').show();
                var data_master_buku = result.get_master_buku;
                $('#id_update_master_buku').val(data_master_buku.id);
                $('#update_kode_buku').val(data_master_buku.kode_buku);
                $('#update_judul_buku').val(data_master_buku.judul_buku);
                $('#update_penulis').val(data_master_buku.penulis);
                $('#update_stok_buku').val(data_master_buku.stok_buku);
                $('#update_tahun_terbit').val(data_master_buku.tahun_terbit);
            }
        });
    });

    var deleteID;
    $('body').on('click', '#getDeleteId', function(){
        deleteID = $(this).data('id');
    })
    $('#SubmitDeleteMasterBukuForm').click(function(e) {
        e.preventDefault();
        var id = deleteID;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "master-buku/"+id,
            method: 'DELETE',
            success: function(result) {
                window.location.reload();
                $('#DeleteMasterBukuModal').hide();
            }
        });
    });
</script>
