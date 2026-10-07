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
                                'route' => route('buku-pelajaran.buku.index'),
                            ],
                            [
                                'name' => 'Buku Umum',
                                'route' => '#',
                            ]
                        ],
                    ],
                    [
                        'name' => 'Kesiswaan',
                        'route' => '#',
                        'child' => [
                            [
                                'name' => 'Siswa',
                                'route' => '#',
                            ],
                            [
                                'name' => 'Kelas',
                                'route' => '#',
                            ],
                            [
                                'name' => 'Jurusan',
                                'route' => '#',
                            ],
                            [
                                'name' => 'Tahun Ajar',
                                'route' => '#',
                            ],
                            [
                                'name' => 'Penempatan Siswa',
                                'route' => '#',
                            ]
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Audit',
                'route' => '#',
                'icon' => 'bx bx-home-circle',
                'child' => [
                    [
                        'name' => 'Audit Akses',
                        'route' => '#',
                    ],
                    [
                        'name' => 'Audit Trail',
                        'route' => '#',
                    ],
                ]
            ]
        ];
    }
}