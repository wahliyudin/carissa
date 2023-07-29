@extends('layouts.master')

@section('title', 'Product')

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
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Product</h4>
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
                                    data-bs-target="#standard-modal"><i class="mdi mdi-plus-circle me-2"></i> Add
                                    Products</button>
                            </div>
                            <div class="col-sm-7">
                                <div class="text-sm-end">
                                    <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                    <button type="button" class="btn btn-light mb-2">Export</button>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="all">Name</th>
                                        <th>Price</th>
                                        <th>Unit</th>
                                        <th style="width: 85px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Name
                                        </td>
                                        <td>
                                            Aeron Chairs
                                        </td>
                                        <td>
                                            09/12/2018
                                        </td>
                                        <td class="table-action">
                                            <a href="javascript:void(0);" class="action-icon"> <i
                                                    class="mdi mdi-eye"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i
                                                    class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i
                                                    class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
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
    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Modal Heading</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Text in a modal</h6>
                    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                    <hr>
                    <h6>Overflowing text to show scroll behavior</h6>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
    <script src="{{ asset('assets/js/pages/product.js') }}"></script>
@endpush
