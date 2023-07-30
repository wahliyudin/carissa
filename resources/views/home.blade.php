@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-sm-6 col-lg-3">
                <div class="card rounded-0 shadow-none m-0">
                    <div class="card-body text-center">
                        <i class="ri-group-line text-muted font-24"></i>
                        <h3><span>29</span></h3>
                        <p class="text-muted font-15 mb-0">Suppliers</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card rounded-0 shadow-none m-0 border-start border-light">
                    <div class="card-body text-center">
                        <i class="ri-stack-fill text-muted font-24"></i>
                        <h3><span>715</span></h3>
                        <p class="text-muted font-15 mb-0">Products</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card rounded-0 shadow-none m-0 border-start border-light">
                    <div class="card-body text-center">
                        <i class="ri-bar-chart-2-fill text-muted font-24"></i>
                        <h3><span>31</span></h3>
                        <p class="text-muted font-15 mb-0">Stocks</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card rounded-0 shadow-none m-0 border-start border-light">
                    <div class="card-body text-center">
                        <i class="ri-shopping-bag-3-fill text-muted font-24"></i>
                        <h3><span>31</span></h3>
                        <p class="text-muted font-15 mb-0">Purchases</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
