@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <p class="fw-semibold">Terdapat Kesalahan</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <h4 class="fw-semibold">Terdapat Error</h4>
        <span>{!! session('error') !!}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <h4 class="fw-semibold">Berhasil</h4>
            <span>{{ session('success') }}</span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-dismissible bg-light-warning d-flex flex-column flex-sm-row p-5 mb-10">
        <i class="ki-duotone ki-notification-bing fs-2hx text-warning me-4">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
        </i>
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <h4 class="fw-semibold">Data Kosong</h4>
            <span>{{ session('warning') }}</span>
        </div>
        <button type="button"
            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">
            <i class="ki-duotone ki-cross fs-1 text-warning">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </button>
    </div>
@endif
@if (session('error_login'))
    <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10">
        <i class="ki-duotone ki-notification-bing fs-2hx text-danger me-4"><span
                class="path1"></span><span class="path2"></span><span class="path3"></span></i>
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <h4 class="fw-semibold">Terdapat Error</h4>
            <span>{!! session('error_login') !!}</span>
        </div>
        <button type="button"
            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">
            <i class="ki-duotone ki-cross fs-1 text-danger"><span class="path1"></span><span class="path2"></span></i>
        </button>
    </div>
@endif
