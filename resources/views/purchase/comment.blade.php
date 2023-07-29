@extends('layouts.master')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Purchase</a></li>
                            <li class="breadcrumb-item active">Comment</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Comment</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <!-- start user detail -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-3 row">
                            <hr class="" />

                            <div class="col-md-3">
                                <p class="mb-1"><strong> Product:</strong></p>
                                <p>{{ $purchase->product?->name }}</p>
                            </div>

                            <div class="col-md-3">
                                <p class="mb-1"><strong> Price:</strong></p>
                                <p>{{ $purchase->product?->price }}</p>
                            </div>

                            <div class="col-md-3">
                                <p class="mb-1"><strong> Supplier:</strong></p>
                                <p>{{ $purchase->supplier?->name }}</p>
                            </div>

                            <div class="col-md-3">
                                <p class="mb-1"><strong> Quantity:</strong></p>
                                <p>{{ $purchase->quantity }}</p>
                            </div>
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body px-0 pb-0">
                        <ul class="conversation-list px-3" data-simplebar style="max-height: 300px; min-height: 300px">
                            @foreach ($purchase->comments as $comment)
                                @if ($comment->user_id == auth()->user()->id)
                                    <li class="clearfix odd">
                                        <div class="chat-avatar">
                                            <img src="{{ asset('assets/images/user.png') }}" class="rounded"
                                                alt="{{ $comment->user?->name }}" />
                                            <i>{{ \Carbon\Carbon::make($comment->created_at)->format('H:i') }}</i>
                                        </div>
                                        <div class="conversation-text">
                                            <div class="ctext-wrap">
                                                <i>{{ $comment->user?->name }}</i>
                                                <p>
                                                    {{ $comment->content }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="conversation-actions dropdown">
                                            <button class="btn btn-sm btn-link" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class='uil uil-ellipsis-v'></i></button>

                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Copy Message</a>
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li class="clearfix">
                                        <div class="chat-avatar">
                                            <img src="{{ asset('assets/images/user.png') }}" class="rounded"
                                                alt="{{ $comment->user?->name }}" />
                                            <i>{{ \Carbon\Carbon::make($comment->created_at)->format('H:i') }}</i>
                                        </div>
                                        <div class="conversation-text">
                                            <div class="ctext-wrap">
                                                <i>{{ $comment->user?->name }}</i>
                                                <p>
                                                    {{ $comment->content }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="conversation-actions dropdown">
                                            <button class="btn btn-sm btn-link" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class='uil uil-ellipsis-v'></i></button>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Copy Message</a>
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div> <!-- end card-body -->
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col">
                                <div class="mt-2 bg-light p-3">
                                    <div class="row">
                                        <div class="col mb-2 mb-sm-0">
                                            <textarea name="message" class="form-control border-0" placeholder="Enter your comment"></textarea>
                                            <div class="invalid-feedback">
                                                Please enter your messsage
                                            </div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="btn-group">
                                                <div class="d-grid">
                                                    <button type="button" class="btn btn-success chat-send"><i
                                                            class='uil uil-message'></i></button>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                </div>
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->
                    </div>
                </div> <!-- end card -->
            </div>
            <!-- end chat area-->

        </div> <!-- end row-->

    </div> <!-- container -->
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.chat-send').click(function(e) {
                e.preventDefault();
                var message = $('textarea[name="message"]').val();
                if (!message) {
                    $(".invalid-feedback").show();
                } else {
                    $(".invalid-feedback").hide();
                    $.ajax({
                        type: "POST",
                        url: "/purchases/{{ $purchase->getKey() }}/send",
                        data: {
                            message
                        },
                        dataType: "JSON",
                        success: function(response) {
                            add(response);
                            $('textarea[name="message"]').val('');
                            toTop();
                        }
                    });
                }
            });

            function toTop() {
                $('.conversation-list .simplebar-content-wrapper').scrollTop($(
                    '.conversation-list .simplebar-content').height());
            }

            function add(response) {
                $('.conversation-list .simplebar-content').append(`<li class="clearfix odd">
                                        <div class="chat-avatar">
                                            <img src="{{ asset('assets/images/user.png') }}" class="rounded"
                                                alt="${response.user}" />
                                            <i>${response.time}</i>
                                        </div>
                                        <div class="conversation-text">
                                            <div class="ctext-wrap">
                                                <i>${response.user}</i>
                                                <p>
                                                    ${response.content}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="conversation-actions dropdown">
                                            <button class="btn btn-sm btn-link" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class='uil uil-ellipsis-v'></i></button>

                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Copy Message</a>
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </li>`);
            }
            toTop();
        });
    </script>
@endpush
