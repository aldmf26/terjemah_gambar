
@if (session()->has('sukses') || session()->has('error'))
    <div class="alert alert-{{ session()->has('sukses') ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
        {{ session()->get('sukses') ?? session()->get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
