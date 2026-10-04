<?php

namespace App\Livewire;

use Livewire\Component;

class MenuItem extends Component
{
    public array $item;
    public string $url;
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

    public function render()
    {
        $listRoute = $this->listRoute;
        return view('livewire.menu-item', compact('listRoute'));
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