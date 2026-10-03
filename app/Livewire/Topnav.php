<?php

namespace App\Livewire;

use App\Helpers\MenuHelper;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Topnav extends Component
{
    public $currentUrl;
    protected $listeners = ['refreshMenu' => '$refresh'];

    /**
     * Data injection from component
     * @return void
     */
    public function mount()
    {
        $this->currentUrl = request()->route()->getName();
    }

    /**
     * @return Application|Factory|object|View
     */
    public function render()
    {
        $listMenu = MenuHelper::getMenuByRole(true);
        return view('livewire.topnav', compact('listMenu'));
    }
}