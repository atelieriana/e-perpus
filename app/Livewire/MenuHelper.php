<?php

namespace App\Livewire;

use App\Livewire\Menu\AdminMenu;
use App\Livewire\Menu\KepalaPerpusatakaanMenu;
use App\Livewire\Menu\PustakawanMenu;

class MenuHelper
{
    public static function getMenuByRole($role)
    {
        if ($role === 1) {
            return (new AdminMenu())->listMenu();
        }
        if ($role === 3) {
            return (new PustakawanMenu())->listMenu();
        }
        if ($role === 2) {
            return (new KepalaPerpusatakaanMenu())->listMenu();
        }
    }
}