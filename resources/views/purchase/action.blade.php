<div class="table-action">
    <a href="{{ route('purchases.comment', $purchase->getKey()) }}" class="btn btn-primary"><i
            class="uil-comments-alt me-1"></i>Comment</a>
    <button class="btn btn-info edit" data-key="{{ $purchase->getKey() }}"><i
            class="mdi mdi-square-edit-outline"></i></button>
    <button class="btn btn-danger destroy" data-key="{{ $purchase->getKey() }}"><i class="mdi mdi-delete"></i></button>
</div>
