<?php

namespace App\Livewire\Menu;

class AdminMenu
{
    public function listMenu()
    {
        return [
            [
                'name' => 'Dashboard',
                'route' => 'dashboard',
                'icon' => 'bx bx-home-circle',
            ],
            [
                'name' => 'Master Data',
                'route' => '#',
                'icon' => 'bx bx-folder-open',
                'child' => [
                    [
                        'name' => 'Buku',
                        'route' => '#',
                        'child' => [
                            [
                                'name' => 'Buku Pelajaran',
                                'route' => '#',
                            ],
                            [
                                'name' => 'Buku Umum',
                                'route' => '#',
                            ]
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Level 1',
                'route' => '#',
                'icon' => 'bx bx-home-circle',
                'child' => [
                    [
                        'name' => 'Level 2',
                        'route' => '#',
                    ],
                ]
            ]
        ];
    }
}