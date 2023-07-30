<div class="table-action">
    <a href="{{ route('purchases.comment', $purchase->getKey()) }}" class="btn btn-primary"><i
            class="uil-comments-alt me-1"></i>Comment</a>
    @if (auth()->user()->role == \App\Enums\Role::PURCHASE && $purchase->status == \App\Enums\Purchase\Status::DIPESAN)
        <button class="btn btn-info diterima" data-key="{{ $purchase->getKey() }}"><i class="ri-hand-coin-fill me-1"></i>
            Diterima</button>
    @endif
    @if (auth()->user()->role == \App\Enums\Role::PURCHASE &&
            !in_array($purchase->status_approv, [
                \App\Enums\Purchase\StatusApprov::SETUJU,
                \App\Enums\Purchase\StatusApprov::TOLAK,
            ]))
        <button class="btn btn-info edit" data-key="{{ $purchase->getKey() }}"><i
                class="mdi mdi-square-edit-outline"></i></button>
    @endif
    @if (auth()->user()->role == \App\Enums\Role::PURCHASE)
        <button class="btn btn-danger destroy" data-key="{{ $purchase->getKey() }}"><i
                class="mdi mdi-delete"></i></button>
    @endif
</div>
