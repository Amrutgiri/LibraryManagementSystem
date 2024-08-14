$(document).ready(function() {
    $('#genre-form').parsley();

});
var genreTable = $('#genre_table').DataTable({
    searchDelay: 500,
    processing: true,
    serverSide: true,
    responsive: true,

    order: [
        [0, "desc"]
    ],

    ajax: {
        url: genreListUrl,
        type: 'POST',
        data: {
            // parameters for custom backend script demo
            "_token": csrfToken,
        },
    },
    columns: [{
        data: 'id'
    },
        {
            data: 'name',
        },

        {
            data: 'serial_no',

        },
        {
            data: 'create_at',
        },
        {
            data: 'status',
        },
        {
            data: 'actions',
            sClass: "text-end"
        },
    ],
    columnDefs: [{

        targets: 0,
        "title": "#ID"
    },

        {
            width: '200px',
            targets: -1,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) {
                return ' <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-light-primary btn-active-primary edit_genre" data-toggle="modal" data-target="#staticBackdrop" data-id="'+data+'" data-name="'+full.name+'" data-serial-no="'+full.serial_no+'" data-title="Edit Genre">\
								<span class="svg-icon">\
                                    <i class="icon-copy bi bi-pencil-square text-primary" style="font-size: 1.5rem;"></i>\
								</span>\
							</a>\
							<a href="javascript:void(0);" data-id="' + data + '" onClick="destroyFunction(this)" class="btn btn-sm btn-icon btn-light-danger btn-active-danger">\
								<span class="svg-icon">\
                                    <i class="icon-copy bi bi-trash text-danger" style="font-size: 1.5rem;"></i>\
								</span>\
							</a>';

            },
        },
        {
            width: '75px',
            targets: -2,
            render: function (data, type, full, meta) {
                var status = {
                    0: {
                        'title': 'Inactive',
                        'state': 'danger'
                    },
                    1: {
                        'title': 'Active',
                        'state': 'success'
                    },
                };
                if (typeof status[data] === 'undefined') {
                    return data;
                }

                return '<a href="javascript:void(0)" data-url="' + full.status_change_url +
                    '" data-status="' + data +
                    '" onClick="statusChangeFunction(this)"><div class="badge badge-' +
                    status[data].state + ' fw-bold">' + status[data].title +
                    '</div></a>';

            },
        },

    ],

});

$('#genre_table').on('click', '.edit_genre', function() {
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    var serial_no = $(this).attr('data-serial-no');
    var title = $(this).attr('data-title');

    $('#staticBackdropLabel').html(title);
    $('#genre_id').val(id);
    $('#genre_name').val(name);
    $('#genre_serial').val(serial_no);
    $('#save_genre').hide();
    $('#update_genre').show();

})

$('.add_genre').on('click', function() {
    $('#staticBackdropLabel').html('Add Genre');
    $('#genre_id').val('');
    $('#genre_name').val('');
    $('#genre_serial').val('');
    $('#rack_notes').val('');
    $('#save_genre').show();
    $('#update_genre').hide();
})

$('#staticBackdrop').on('hide.bs.modal', function (event) {
    $('#staticBackdropLabel').html('Add Genre');
    $('#genre_id').val('');
    $('#genre_name').val('');
    $('#genre_serial').val('');
    $('#rack_notes').val('');
    $('#save_genre').show();
    $('#update_genre').hide();
  })

  $('#save_genre').on("click", function(e) {
    e.preventDefault();
    if ($('#genre-form').parsley().validate()) {
        $.ajax({
            type: "POST",
            url: genreStoreUrl,
            data: $('#genre-form').serialize(),
            success: function(response) {
                Toast.fire({
                    icon: 'success',
                    title: "<span style='color:black'>Genre Added Successfully</span>",
                })
                $('#staticBackdrop').modal('hide');
                $('#genre_table').DataTable().ajax.reload();

            },
            error: function(response) {

                Toast.fire({
                    icon: 'error',
                    title: '<span style="color:black">' + response.responseJSON
                        .message + '</span>',
                });
            }
        });
    }
});

$('#update_genre').on("click", function(e) {
    e.preventDefault();
    var genre_id = $('#genre_id').val();
    if ($('#genre-form').parsley().validate()) {
        $.ajax({
            type: "PUT",
            url: "update/"+genre_id,
            data: $('#genre-form').serialize(),
            success: function(response) {
                Toast.fire({
                    icon: 'success',
                    title: "<span style='color:black'>Genre Updated Successfully</span>",
                })
                $('#staticBackdrop').modal('hide');
                $('#genre_table').DataTable().ajax.reload();
            },
            error: function(response) {
                Toast.fire({
                    icon: 'error',
                    title: '<span style="color:black">' + response.responseJSON
                        .message + '</span>',
                });
            }
        });


    }
});

function destroyFunction(e) {

	var id = $(e).attr('data-id');

	Swal.fire({
		title: "Are you sure?",
		text: "You won\'t be able to revert this!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonText: "Yes, delete it!",
		customClass: {
			confirmButton: 'btn btn-sm btn-success',
			cancelButton: 'btn btn-sm btn-danger',
		}

	}).then(function (result) {

        if (result.value) {
			$.ajax({
                type: "POST",
                url: "delete/"+id,
                data: {id:id, "_token": csrfToken},
                dataType: "json",
                success: function (response) {
                    $('#genre_table').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'info',
                        title: "<span style='color:black'>Genre Deleted Successfully</span>",
                    })
                }
            });

		}else {

        }
	});
}
function statusChangeFunction(e) {
    var url = $(e).attr('data-url');
    var status = $(e).attr('data-status');
    $.ajax({
        method: "POST",
        url: url,
        data: {
            status: status,
            "_token": csrfToken
        },
        success: function (resultData) {
            $('#genre_table').DataTable().ajax.reload();
            Toast.fire({
                icon: 'success',
                title: "<span style='color:black'>The status updated success.</span>",
            })

        }
    })
}
