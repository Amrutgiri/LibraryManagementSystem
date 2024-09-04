$(document).ready(function() {
    $('#book-limit-form').parsley();
});
var bookLimitTable = $('#book_limit_table').DataTable({
    searchDelay: 500,
    processing: true,
    serverSide: true,
    responsive: true,

    order: [
        [0, "desc"]
    ],

    ajax: {
        url: listDataUrl,
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
            data: 'max_day_limit',

        },
        {
            data: 'max_book_limit',
        },
        {
            data: 'created_at',
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
                return ' <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-light-primary btn-active-primary edit_book_limit" data-toggle="modal" data-target="#staticBackdrop" data-id="'+data+'" data-name="'+full.name+'" data-max_day_limit="'+full.max_day_limit+'" data-user_id="'+full.user_id+'" data-max_book_limit="'+full.max_book_limit+'" data-title="Edit Book Limit">\
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


    ],

});

$('#book_limit_table').on('click', '.edit_book_limit', function() {
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    var max_book_limit = $(this).attr('data-max_book_limit');
    var max_day_limit = $(this).attr('data-max_day_limit');
    var title = $(this).attr('data-title');
    var user_id = $(this).attr('data-user_id');

    $('#staticBackdropLabel').html(title);
    $('#book_limit_id').val(id);
    $('#user_id').trigger('change').val(user_id);
    $('#max_book_limit').val(max_book_limit);
    $('#max_day_limit').val(max_day_limit);
    $('#store_book_limit').hide();
    $('#update_book_limit').show();

})

$('.add_book_limit_btn').on('click', function() {
    $('#staticBackdropLabel').html('Add Book Limit');
    $('#book_limit_id').val('');
    $('#user_id').val('');
    $('#max_book_limit').val('');
    $('#max_day_limit').val('');
    $('#store_book_limit').show();
    $('#update_book_limit').hide();
})

$('#staticBackdrop').on('hide.bs.modal', function (event) {
    $('#staticBackdropLabel').html('Add Book Limit');
    $('#book_limit_id').val('');
    $('#genre_name').val('');
    $('#genre_serial').val('');
    $('#rack_notes').val('');
    $('#save_genre').show();
    $('#update_genre').hide();
  })

  $('.save_book_limit').on("click", function(e) {
    e.preventDefault();
    if ($('#book-limit-form').parsley().validate()) {
        $.ajax({
            type: "POST",
            url: bookLimitStoreUrl,
            data: $('#book-limit-form').serialize(),
            success: function(response) {
                Toast.fire({
                    icon: 'success',
                    title: "<span style='color:black'>"+response.message+"</span>",
                })
                $('#staticBackdrop').modal('hide');
                $('#book_limit_table').DataTable().ajax.reload();

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

$('#update_book_limit').on("click", function(e) {
    e.preventDefault();
    var book_limit_id = $('#book_limit_id').val();
    if ($('#book-limit-form').parsley().validate()) {
        $.ajax({
            type: "POST",
            url: "limit/update/"+book_limit_id,
            data: $('#book-limit-form').serialize(),
            success: function(response) {
                Toast.fire({
                    icon: 'success',
                    title: "<span style='color:black'>"+response.message+"</span>",
                })
                $('#staticBackdrop').modal('hide');
                $('#book_limit_table').DataTable().ajax.reload();
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
		title: "Are you sure ? ",
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
                url: "limit/delete/"+id,
                data: {id:id, "_token": csrfToken},
                dataType: "json",
                success: function (response) {
                    $('#book_limit_table').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'info',
                        title: "<span style='color:black'>"+response.message+"</span>",
                    })
                }
            });

		}else {

        }
	});
}


