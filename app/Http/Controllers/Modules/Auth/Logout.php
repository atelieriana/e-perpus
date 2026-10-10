<?php

namespace App\Http\Controllers\Modules\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class Logout extends Controller
{
    public function __construct(
        private Session $session,
    )
    {}

    public function __invoke()
    {
        $this->session::invalidate();
        return redirect()
            ->route('auth.login')
            ->with('success', 'Berhasil keluar dari aplikasi');
    }
}