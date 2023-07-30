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
            url: "/reports/datatable"
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

    var btnLoad = (selector, isDisabled) => {
        $(selector).attr('disabled', isDisabled);
        $(selector + ' .spinner-border').toggleClass('d-none');
        $(selector + ' .spin-title').toggleClass('d-none');
        $(selector + ' .btn-title').toggleClass('d-none');
    }

    $('.select2').select2({
        dropdownParent: $("#create-report")
    });
});
