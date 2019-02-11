$(document).ready(function() {
  $(document).on('change', '#searchByStatus', function(){
        $.ajax({
            type: 'post',
            url: '/searchItem',
            data: {
                '_token': $('input[name=_token]').val(),
				'Status': $(this).val()
            },
            success: function(response) {
				console.log(response);
				
				$('tbody').html(response);
				
            
			}
        });  
  });
  $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
		$('.form-horizontal').show();
		$('.addpegawai').hide();
        $('#NIK').val($(this).data('nik'));
        $('#Nama').val($(this).data('nama'));
		$('#Unit').val($(this).data('unit'));
		$('#Status').val($(this).data('status'));
        $('#myModal').modal('show');
    });
	$(document).on('click', '#add', function() {
        $('#footer_action_button').text(" Add");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('add');
        $('.modal-title').text('Add');
        $('.deleteContent').hide();
		$('.form-horizontal').hide();
        $('.addpegawai').show();
        $('#myModal').modal('show');
    });
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.deletenik').text($(this).data('nik'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
		$('.addpegawai').hide();
        $('.deletenama').html($(this).data('nama'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function() {

        $.ajax({
            type: 'post',
            url: '/editItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'NIK': $("#NIK").val(),
                'Nama': $("#Nama").val(),
				'Unit': $("#Unit").val(),
				'Status': $("#Status").val()
            },
            success: function(response) {
				console.log(response);
                $('.item' + response.NIK).replaceWith("<tr class='item" + response.NIK + "'><td>" + response.NIK + "</td><td>" + response.Nama_Pegawai + "</td><td>" + response.Nama_Unit + "</td><td>" + response.Nama_Status + "</td><td><button class='edit-modal btn btn-info' data-nik='" + response.NIK + "' data-nama='" + response.Nama_Pegawai + "' data-unit='" + response.ID_Unit + "' data-status='" + response.ID_Status + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-nik='" + response.NIK + "' data-nama='" + response.Nama_Pegawai + "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
            }
        });
    });
    $('.modal-footer').on('click', '.add', function() {

        $.ajax({
            type: 'post',
            url: '/addItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'NIK': $("#addNIK").val(),
                'Nama_Pegawai': $("#addNama").val(),
				'ID_Unit': $("#addUnit").val(),
				'ID_Status': $("#addStatus").val()
            },
            success: function(response) {
				console.log(response);
                if ((response.errors)){
                  $('.error').removeClass('hidden');
                    $('.error').text(response.errors.name);
                }
                else {
                    $('.error').addClass('hidden');
                    $('#table').append("<tr class='item" + response.NIK + "'><td>" + response.NIK + "</td><td>" + response.Nama_Pegawai + "</td><td>" + response.Nama_Unit + "</td><td>" + response.Nama_Status + "</td><td><button class='edit-modal btn btn-info' data-nik='" + response.NIK + "' data-nama='" + response.Nama_Pegawai + "' data-unit='" + response.ID_Unit + "' data-status='" + response.ID_Status + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-nik='" + response.NIK + "' data-nama='" + response.Nama_Pegawai + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                }
            },

        });
        $('#name').val('');
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'NIK': $('.deletenik').text()
            },
            success: function(data) {
                $('.item' + $('.deletenik').text()).remove();
            }
        });
    });
});
