<?php

namespace App\Livewire;

use App\Livewire\Menu\AdminMenu;
use App\Livewire\Menu\KepalaPerpusatakaanMenu;
use App\Livewire\Menu\PustakawanMenu;

class MenuHelper
{
    public static function getMenuByRole($role)
    {
        if ($role === "Admin") {
            return (new AdminMenu())->listMenu();
        }
        if ($role === "Pustakawan") {
            return (new PustakawanMenu())->listMenu();
        }
        if ($role === "Kepala Perpusatakaan") {
            return (new KepalaPerpusatakaanMenu())->listMenu();
        }
    }
}