$(document).ready(function () {
    "use strict";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var datatable = $("#reports-datatable").DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Showing reports _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> reports'
        },
        ajax: {
            type: "POST",
            url: "/reports/datatable",
            data: function (data) {
                data.status = $('select[name="status"]').val();
                data.status_approv = $('select[name="status_approv"]').val();
            },
        },
        pageLength: 5,
        columns: [{
            orderable: !0,
            name: "product",
            data: "product",
        },
        {
            orderable: !0,
            name: "supplier",
            data: "supplier",
        },
        {
            orderable: !0,
            name: "price",
            data: "price",
        },
        {
            orderable: !0,
            name: "quantity",
            data: "quantity",
        },
        {
            orderable: !0,
            name: "status",
            data: "status",
        },
        {
            orderable: !0,
            name: "status_approv",
            data: "status_approv",
        }],
        order: [
            [1, "asc"]
        ],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded"), $("#reports-datatable_length label").addClass("form-label"), document.querySelector(".dataTables_wrapper .row").querySelectorAll(".col-md-6").forEach(function (e) {
                e.classList.add("col-sm-6"), e.classList.remove("col-sm-12"), e.classList.remove("col-md-6")
            })
        }
    });

    $('select[name="status"]').change(function (e) {
        e.preventDefault();
        datatable.ajax.reload();
    });

    $('select[name="status_approv"]').change(function (e) {
        e.preventDefault();
        datatable.ajax.reload();
    });

    var btnLoad = (selector, isDisabled) => {
        $(selector).attr('disabled', isDisabled);
        $(selector + ' .spinner-border').toggleClass('d-none');
        $(selector + ' .spin-title').toggleClass('d-none');
        $(selector + ' .btn-title').toggleClass('d-none');
    }

    $('.export').click(function (e) {
        e.preventDefault();
        btnLoad('.export', true);
        $.ajax({
            type: "POST",
            url: "/reports/export",
            data: function (data) {
                data.status = $('select[name="status"]').val();
                data.status_approv = $('select[name="status_approv"]').val();
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function (data) {
                btnLoad('.export', false);
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(data);
                a.href = url;
                a.download = 'report.pdf';
                document.body.append(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            },
            error: function (jqXHR, xhr, textStatus, errorThrow, exception) {
                btnLoad('.export', false);
                if (jqXHR.status == 500) {
                    Swal.fire(
                        'Error!',
                        'Something went wrong',
                        'error'
                    );
                }
                if (jqXHR.status == 422) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan!',
                        text: JSON.parse(jqXHR.responseText).message,
                    })
                }
            }
        });
    });

    $('.select2').select2();
});
