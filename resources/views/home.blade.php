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
                        <h3><span>{{ $supplier }}</span></h3>
                        <a class="text-muted font-15 mb-0" href="{{ route('master.suppliers.index') }}">Suppliers</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card rounded-0 shadow-none m-0 border-start border-light">
                    <div class="card-body text-center">
                        <i class="ri-stack-fill text-muted font-24"></i>
                        <h3><span>{{ $product }}</span></h3>
                        <a class="text-muted font-15 mb-0" href="{{ route('master.products.index') }}">Products</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card rounded-0 shadow-none m-0 border-start border-light">
                    <div class="card-body text-center">
                        <i class="ri-bar-chart-2-fill text-muted font-24"></i>
                        <h3><span>{{ $stock }}</span></h3>
                        <a class="text-muted font-15 mb-0" href="{{ route('master.stocks.index') }}">Stocks</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card rounded-0 shadow-none m-0 border-start border-light">
                    <div class="card-body text-center">
                        <i class="ri-shopping-bag-3-fill text-muted font-24"></i>
                        <h3><span>{{ $purchase }}</span></h3>
                        <a class="text-muted font-15 mb-0" href="{{ route('purchases.index') }}">Purchases</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
