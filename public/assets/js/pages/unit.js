$(document).ready(function () {
    "use strict";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var datatable = $("#units-datatable").DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Showing units _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> units'
        },
        ajax: {
            type: "POST",
            url: "/master/units/datatable",
            data: function (d) {
                d.search = $('input[name="search"]').val();
            }
        },
        pageLength: 5,
        columns: [{
            orderable: !0,
            name: "name",
            data: "name",
        }, {
            orderable: false,
            name: "action",
            data: "action",
        }],
        order: [
            [1, "asc"]
        ],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded"), $("#units-datatable_length label").addClass("form-label"), document.querySelector(".dataTables_wrapper .row").querySelectorAll(".col-md-6").forEach(function (e) {
                e.classList.add("col-sm-6"), e.classList.remove("col-sm-12"), e.classList.remove("col-md-6")
            })
        }
    })


    $('.save-unit').click(function (e) {
        e.preventDefault();
        var postData = new FormData($(`.form-unit`)[0]);
        btnLoad('.save-unit', true);
        $.ajax({
            type: 'POST',
            url: "/master/units/store",
            processData: false,
            contentType: false,
            data: postData,
            success: function (response) {
                btnLoad('.save-unit', false);
                Swal.fire({
                    text: "Form has been successfully submitted!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function (result) {
                    $('#create-unit').modal('hide');
                    datatable.ajax.reload();
                });
            },
            error: function (jqXHR) {
                btnLoad('.save-unit', false);
                if (jqXHR.status == 422 || jqXHR.responseJSON.message.includes("404")) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan!',
                        text: JSON.parse(jqXHR.responseText).message,
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: jqXHR.responseText,
                    })
                }
            }
        });
    });

    $('#units-datatable').on('click', '.destroy', function (e) {
        e.preventDefault();
        var key = $(this).data('key');
        Swal.fire({
            text: "Are you sure you want to delete ?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Yes, delete!",
            cancelButtonText: "No, cancel",
            customClass: {
                confirmButton: "btn fw-bold btn-danger",
                cancelButton: "btn fw-bold btn-active-light-primary"
            }
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type: "DELETE",
                    url: `/master/units/${key}/destroy`,
                    dataType: "JSON",
                    success: function (response) {
                        Swal.fire({
                            text: "You have deleted !.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function () {
                            datatable.ajax.reload();
                        });
                    },
                    error: function (jqXHR) {
                        if (jqXHR.status == 422 || jqXHR.responseJSON.message.includes("404")) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Peringatan!',
                                text: JSON.parse(jqXHR.responseText).message,
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: jqXHR.responseText,
                            })
                        }
                    }
                });
            } else if (result.dismiss === 'cancel') {
                Swal.fire({
                    text: "was not deleted.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                }).then(function () {
                });
            }
        });
    });

    $('#units-datatable').on('click', '.edit', function (e) {
        e.preventDefault();
        var key = $(this).data('key');
        $.ajax({
            type: "GET",
            url: `/master/units/${key}/edit`,
            dataType: "JSON",
            success: function (response) {
                $('input[name="key"]').val(response.id);
                $('input[name="name"]').val(response.name);
                $('#create-unit').modal('show');
            }
        });
    });

    $('#create-unit').on('hidden.bs.modal', function () {
        $('input[name="key"]').val('');
        $('input[name="name"]').val('');
    });

    var btnLoad = (selector, isDisabled) => {
        $(selector).attr('disabled', isDisabled);
        $(selector + ' .spinner-border').toggleClass('d-none');
        $(selector + ' .spin-title').toggleClass('d-none');
        $(selector + ' .btn-title').toggleClass('d-none');
    }
});
