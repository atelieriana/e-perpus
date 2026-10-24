<?php

namespace App\Livewire\Menu;

class PustakawanMenu
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
                'name' => 'Peminjaman',
                'route' => '#',
                'icon' => 'bx bx-folder-open',
                'child' => [
                    [
                        'name' => 'Buku Pelajaran',
                        'route' => '#',
                    ],
                    [
                        'name' => 'Buku Umum',
                        'route' => '#',
                    ],
                ]
            ]
        ];
    }
}