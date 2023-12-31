@extends('layouts.master')

@section('title', 'Supplier')

@push('css')
    <link href="{{ asset('assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
                            <li class="breadcrumb-item active">Supplier</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Supplier</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-5">
                                <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal"
                                    data-bs-target="#create-supplier"><i class="mdi mdi-plus-circle me-2"></i> Add
                                    Suppliers</button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered w-100 dt-responsive nowrap" id="suppliers-datatable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="all">Name</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th style="width: 85px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
    </div>
@endsection

@push('modal')
    <div id="create-supplier" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="create-supplierLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="create-supplierLabel">Supplier</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="row gap-2 form-supplier">
                        <input type="hidden" name="key">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="number" name="phone_number" id="phone_number" class="form-control"
                                    placeholder="Phone Number">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary save-supplier" type="button">
                        <span class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
                        <span class="spin-title d-none">Loading...</span>
                        <span class="btn-title">Simpan</span>
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endpush

@push('js')
    <script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatables-checkboxes/js/dataTables.checkboxes.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/pages/supplier.js') }}"></script>
@endpush
