<ul class="navbar-nav">
    <li class="nav-item @if(!empty($item['child'])) dropdown @endif">
        <a class="nav-link dropdown-toggle arrow-none" href="{{ $item['route'] }}" id="topnav-dashboard" role="button">
            <i class="{{ $item['icon'] }} me-2"></i><span key="t-dashboards">{{ $item['name'] }}</span>
            @if(!empty($item['child']))
                <div class="arrow-down"></div>
            @endif
        </a>
        @livewire('FirstSubMenuItem', ['item' => $item])
    </li>
</ul>