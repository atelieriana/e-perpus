<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    @foreach ($listMenu as $menuItem)
                        @livewire('MenuItem', ['item' => $menuItem])
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
</div>