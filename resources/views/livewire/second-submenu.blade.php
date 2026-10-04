<div class="dropdown-menu" aria-labelledby="topnav-form">
    @foreach($item['child'] ?? [] as $secondSubMenu)
        <a href="{{ $secondSubMenu['route'] }}" class="dropdown-item" key="t-form-elements">{{ $secondSubMenu['name'] }}</a>
    @endforeach
</div>