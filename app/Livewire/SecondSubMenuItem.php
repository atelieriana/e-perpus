<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class SecondSubMenuItem extends Component
{
    public array $item;
    private $listRoute = [];

    /**
     * Data injection from component
     * @param $item
     * @return void
     */
    public function mount($item)
    {
        if (!empty($item['child'])) {
            $this->generateRoute($item['child']);
        } else {
            $this->generateRoute($item);
        }
    }

    /**
     * @return Factory|View|Application|object
     */
    public function render()
    {
        $listRoute = $this->listRoute;
        return view('livewire.second-submenu', compact('listRoute'));
    }

    /**
     * Digunakan untuk melakukan generate route
     * @param $item
     * @return void
     */
    private function generateRoute($item)
    {
        if (is_array($item)) {
            foreach ($item as $data) {
                if (!empty($data['child'])) {
                    $this->generateRoute($data['child']);
                } else {
                    if ($data['route'] ?? '#' != '#') {
                        $this->listRoute[] = $data['route'];
                    } else {
                        $this->listRoute[] = $item['route'];
                    }
                }
            }
        } else {
            if ($item['route'] ?? '#' != '#') {
                $this->listRoute[] = $item['route'];
            }
        }
    }
}