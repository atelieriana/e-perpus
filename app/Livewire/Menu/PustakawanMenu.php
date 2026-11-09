<?php

namespace App\Livewire\Menu;

class PustakawanMenu
{
    public function listMenu()
    {
        return [
            [
                'name' => 'Dashboard',
                'route' => route('dashboard'),
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
                                'route' => route('buku-pelajaran.index'),
                            ],
                            [
                                'name' => 'Buku Umum',
                                'route' => route('buku-umum.index'),
                            ]
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Peminjaman',
                'route' => '#',
                'icon' => 'bx bx-folder-open',
                'child' => [
                    [
                        'name' => 'Buku Pelajaran',
                        'route' => route('peminjaman-buku-pelajaran.index'),
                    ],
                    [
                        'name' => 'Buku Umum',
                        'route' => route('peminjaman-buku-umum.index'),
                    ],
                ]
            ],
            [
                'name' => 'Hibah Buku',
                'route' => route('hibah-buku.index'),
                'icon' => 'bx bx-history',
            ],
            [
                'name' => 'Bebas Perpustakaan',
                'route' => route('surat-bebas-pinjam.index'),
                'icon' => 'bx bx-book',
            ],
        ];
    }
}