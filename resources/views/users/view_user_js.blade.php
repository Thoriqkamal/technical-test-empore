<script>
    $(document).ready( function () {
    $('#userTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('users-list') }}",
        columns: [
                    { data: 'id' , name: 'id', sClass:'text-center'},
                    { data: 'username', name: 'username', sClass:'text-center'},
                    { data: 'email', name: 'email', sClass:'text-center'},
                    { data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
                ]
        });
    });

    $('.modelClose').on('click', function(){
        $('#EditProductModal').hide();
    });
    var id;
    $('body').on('click', '#getEditUserData', function(e) {
        var id = $(this).data('id');
        var token = $("input[name='_token']").val();
        e.preventDefault();
        $('.alert-danger').html('');
        $('.alert-danger').hide();
        $.ajax({
            url:  "{{ url('get-user') }}",
            method: 'POST',
            data: {
                _token: token,
                id: id
            },
            dataType: "json",
            success: function(result) {
                $('#EditProductModalBody').html(result.html);
                $('#EditProductModal').show();
                var data_user = result.get_user;
                $('#id_update_user').val(data_user.id);
                $('#update_username').val(data_user.username);
                $('#update_email').val(data_user.email);
                $('#update_password').val(data_user.password);
            }
        });
    });

    var deleteID;
    $('body').on('click', '#getDeleteId', function(){
        deleteID = $(this).data('id');
    })
    $('#SubmitDeleteUserForm').click(function(e) {
        e.preventDefault();
        var id = deleteID;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "user/"+id,
            method: 'DELETE',
            success: function(result) {
                window.location.reload();
                $('#DeleteProductModal').hide();
            }
        });
    });
</script>
