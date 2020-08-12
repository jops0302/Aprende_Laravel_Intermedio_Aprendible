@if(session('status'))
<div class="alert alert-primary">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" arial-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
