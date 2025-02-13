<div class="bg-primary container border d-flex justify-content-around align-items-center fw-bold mt-3 p-4 shadow rounded">
    <img class="img-fluid" src="{{ Storage::url('logo.png') }}" alt="" style="width: 60px; height: auto;">
    <a class="text-white text-decoration-none fs-5" href="{{ route('admin.dashboard') }}">
        <span class="material-symbols-outlined">dashboard</span>
    </a>
    <a class="text-white text-decoration-none fs-5" href="{{ route('admin.update') }}">
        <span class="material-symbols-outlined">edit</span>
    </a>
    <a class="text-white text-decoration-none fs-5" href="{{ route('admin.register') }}">
        <span class="material-symbols-outlined">add</span>
    </a>
    <a class="text-white text-decoration-none fs-5 hover" href="{{ route('login') }}">
        <span class="material-symbols-outlined">logout</span>
    </a>
</div>