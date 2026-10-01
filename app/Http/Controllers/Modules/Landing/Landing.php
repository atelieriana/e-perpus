<?php

namespace App\Http\Controllers\Modules\Landing;

use App\Http\Controllers\Controller;
use App\Traits\AuditAccess;

class Landing extends Controller
{
    use AuditAccess;

    // Trait variable
    protected $moduleName = 'Landing - Page';

    public function __construct()
    {
        $this->logAccess();
    }

    public function index()
    {
        return view('modules.landing.index');
    }
}
