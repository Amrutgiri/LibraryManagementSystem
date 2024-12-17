var bookLimitTable = $("#book_issue_table").DataTable({
    searchDelay: 500,
    processing: true,
    serverSide: true,
    responsive: true,

    order: [[0, "desc"]],

    ajax: {
        url: listDataUrl,
        type: "POST",
        data: {
            // parameters for custom backend script demo
            _token: csrfToken,
        },
    },
    columns: [
        {
            data: "id",
        },
        {
            data: "book_name",
        },

        {
            data: "username",
        },
        {
            data: "issue_date",
        },
        {
            data: "return_date",
        },
        {
            data: "is_returned",
        },
        {
            data: "is_lost",
        },
        {
            data: "is_damage",
        },
        {
            data: "actions",
            sClass: "text-end",
        },
    ],
    columnDefs: [
        {
            targets: 0,
            title: "#ID",
        },

        {
            width: "200px",
            targets: -1,
            title: "Actions",
            orderable: false,
            render: function (data, type, full, meta) {
                return (
                    ' <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-light-primary btn-active-primary edit_book_limit" data-toggle="modal" data-target="#staticBackdrop" data-id="' +
                    data +
                    '" data-name="' +
                    full.name +
                    '" data-max_day_limit="' +
                    full.max_day_limit +
                    '" data-user_id="' +
                    full.user_id +
                    '" data-max_book_limit="' +
                    full.max_book_limit +
                    '" data-title="Edit Book Limit">\
								<span class="svg-icon">\
                                    <i class="icon-copy bi bi-pencil-square text-primary" style="font-size: 1.5rem;"></i>\
								</span>\
							</a>\
							<a href="javascript:void(0);" data-id="' +
                    data +
                    '" onClick="destroyFunction(this)" class="btn btn-sm btn-icon btn-light-danger btn-active-danger">\
								<span class="svg-icon">\
                                    <i class="icon-copy bi bi-trash text-danger" style="font-size: 1.5rem;"></i>\
								</span>\
							</a>'
                );
            },
        },
    ],
});

function destroyFunction(e) {
    var id = $(e).attr("data-id");

    Swal.fire({
        title: "Are you sure ? ",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        customClass: {
            confirmButton: "btn btn-sm btn-success",
            cancelButton: "btn btn-sm btn-danger",
        },
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "limit/delete/" + id,
                data: { id: id, _token: csrfToken },
                dataType: "json",
                success: function (response) {
                    $("#book_limit_table").DataTable().ajax.reload();
                    Toast.fire({
                        icon: "info",
                        title:
                            "<span style='color:black'>" +
                            response.message +
                            "</span>",
                    });
                },
            });
        } else {
        }
    });
}
