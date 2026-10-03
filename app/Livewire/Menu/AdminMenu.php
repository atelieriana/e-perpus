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
            ],
            [
                'name' => 'Master Data',
                'route' => '#',
                'child' => [
                    [
                        'name' => 'Buku',
                        'route' => '#',
                        'child' => [
                            [
                                'name' => 'Buku Pelajaran',
                                'route' => 'pencarian.index',
                            ],
                            [
                                'name' => 'Buku Umum',
                                'route' => '#',
                            ]
                        ]
                    ],
                ]
            ]
        ];
    }
}