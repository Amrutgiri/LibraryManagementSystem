
	var userTable = $('#user_table').DataTable({
		searchDelay: 500,
		processing: true,
		serverSide: true,
		responsive: true,

		order: [
			[0, "desc"]
		],

		ajax: {
			url: userListUrl,
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
			data: 'email',

		},
        {
			data: 'registered_date',
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
				return ' <a href="' + full.edit_url + '" class="btn btn-sm btn-icon btn-light-primary btn-active-primary">\
								<span class="svg-icon">\
                                    <i class="icon-copy bi bi-pencil-square text-primary" style="font-size: 1.5rem;"></i>\
								</span>\
							</a>\
							<a href="javascript:void(0);" data-id="' + data + '" onClick="destroyFunction(this)" class="btn btn-sm btn-icon btn-light-danger btn-active-danger">\
								<span class="svg-icon">\
                                    <i class="icon-copy bi bi-trash text-danger" style="font-size: 1.5rem;"></i>\
								</span>\
							</a>\
							<form id="' + data + '" action="' + full.destroy_url + '" method="POST" style="display: none;"><input name="_method" type="hidden" value="delete"> <input type="hidden" name="_token" value="' + csrfToken + '"></form>';
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
                $('#user_table').DataTable().ajax.reload();
                Toast.fire({
                    icon: 'success',
                    title: "<span style='color:black'>The status updated success.</span>",
                })

            }
        })
    }
