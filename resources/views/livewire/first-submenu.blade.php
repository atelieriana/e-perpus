<div class="dropdown-menu" aria-labelledby="topnav-dashboard">
    @foreach($item['child'] ?? [] as $firstSubMenu)
        @if(empty($firstSubMenu['child']))
            <div class="dropdown">
                <a hreflang="{{ $firstSubMenu['route'] }}" class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form" role="button">
                    {{ $firstSubMenu['name'] }}
                </a>
            </div>
        @else
            <div class="dropdown">
                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form" role="button">
                    <span key="t-forms">{{ $firstSubMenu['name'] }}</span> <div class="arrow-down"></div>
                </a>
                @livewire('SecondSubMenuItem', ['item' => $firstSubMenu])
            </div>
        @endif
    @endforeach
</div>