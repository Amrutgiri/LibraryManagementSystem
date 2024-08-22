

var bookTable = $('#book_table').DataTable({
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
            data: 'name',
        },

        {
            data: 'language',

        },
        {
            data: 'auther',
        },
         {
            data: 'publication',
        },
         {
            data: 'genre',
        },
         {
            data: 'number_of_copy',
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
                if(full.barcode>0){
                     return ' <a href="'+full.edit_url+'" class="btn btn-sm btn-icon btn-light-primary btn-active-primary"  data-id="'+data+'" >\
								<span class="svg-icon">\
                                    <i class="icon-copy bi bi-pencil-square text-primary" style="font-size: 1.5rem;"></i>\
								</span>\
							</a>\
							<a href="javascript:void(0);" data-id="' + data + '" onClick="destroyFunction(this)" class="btn btn-sm btn-icon btn-light-danger btn-active-danger">\
								<span class="svg-icon">\
                                    <i class="icon-copy bi bi-trash text-danger" style="font-size: 1.5rem;"></i>\
								</span>\
							</a>\
                             <a href="'+full.barcode_url+'" data-id="' + data + '" data-total-copy="'+full.number_of_copy+'"  class="btn btn-sm btn-icon btn-light-danger btn-active-danger">\
								<span class="svg-icon">\
                                    <i class="icon-copy bi bi-eye-fill" style="font-size: 1.5rem;"></i>\
								</span>\
							</a>';
                } else {
                            return ' <a href="'+full.edit_url+'" class="btn btn-sm btn-icon btn-light-primary btn-active-primary"  data-id="'+data+'" >\
								<span class="svg-icon">\
                                    <i class="icon-copy bi bi-pencil-square text-primary" style="font-size: 1.5rem;"></i>\
								</span>\
							</a>\
							<a href="javascript:void(0);" data-id="' + data + '" onClick="destroyFunction(this)" class="btn btn-sm btn-icon btn-light-danger btn-active-danger">\
								<span class="svg-icon">\
                                    <i class="icon-copy bi bi-trash text-danger" style="font-size: 1.5rem;"></i>\
								</span>\
							</a>\
                            <a href="javascript:void(0);" data-id="' + data + '" data-total-copy="'+full.number_of_copy+'" onClick="generateBarcodeFunction(this)" class="btn btn-sm btn-icon btn-light-danger btn-active-danger">\
								<span class="svg-icon">\
                                    <i class="icon-copy bi bi-upc-scan" style="font-size: 1.5rem;"></i>\
								</span>\
							</a>';
                }


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


function generateBarcodeFunction(e) {

	var book_id = $(e).attr('data-id');
	var number_of_copies = $(e).attr('data-total-copy');

	Swal.fire({
		title: "Are you sure Generate Barcode ?",
		text: "You won\'t be able to revert this!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonText: "Yes, Generate it!",
		customClass: {
			confirmButton: 'btn btn-sm btn-success',
			cancelButton: 'btn btn-sm btn-danger',
		}

	}).then(function (result) {

        if (result.value) {
			$.ajax({
                type: "POST",
                url: barcodeGenerateUrl,
                data: {book_id:book_id,number_of_copies:number_of_copies, "_token": csrfToken},
                dataType: "json",
                beforeSend: function () {
                    $('#loader').show();
                },
                success: function (response) {
                     $('#loader').hide();
                    $('#book_table').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'info',
                        title: "<span style='color:black'>Barcode Generated Successfully</span>",
                    })

                }
            });

		}
	});
}

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
                 beforeSend: function () {
                    $('#loader').show();
                },
                success: function (response) {
                     $('#loader').hide();
                    $('#book_table').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'info',
                        title: "<span style='color:black'>Book Deleted Successfully</span>",
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
            $('#book_table').DataTable().ajax.reload();
            Toast.fire({
                icon: 'success',
                title: "<span style='color:black'>The status updated success.</span>",
            })

        }
    })
}
