
var bookTable = $('#barcode_table').DataTable({
    searchDelay: 500,
    processing: true,
    serverSide: true,
    responsive: true,

    order: [
        [0, "desc"]
    ],

    ajax: {
        url: bookListUrl,
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
            data: 'barcode',
        },

        {
            data: 'barcode_image',

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
			width: '250px',
			targets: 2,
			render: function (data, type, full, meta) {
				return '<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">\
									<div class="symbol-label">\
										<img src="'+ full.barcode_image + '" alt="' + data + '" class="w-100">\
									</div>\
							</div>';
			},
		},

        {
            width: '200px',
            targets: -1,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) {

                     return ' <a href="javascript:void(0);" data-id="' + data + '" onClick="destroyFunction(this)" class="btn btn-sm btn-icon btn-light-danger btn-active-danger" data-url="'+full.destroy_url+'">\
								<span class="svg-icon">\
                                    <i class="icon-copy bi bi-trash text-danger" style="font-size: 1.5rem;"></i>\
								</span>\
							</a>';
            },
        },


    ],

});



function destroyFunction(e) {

	var id = $(e).attr('data-id');
    var destroy_url = $(e).attr('data-url');
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
                url: destroy_url,
                data: {id:id, "_token": csrfToken},
                dataType: "json",
                success: function (response) {
                    $('#barcode_table').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'info',
                        title: "<span style='color:black'>Barcode Deleted Successfully</span>",
                    })
                }
            });

		}else {

        }
	});
}
