<?php

namespace App\Models\Tokens;

use App\Traits\AuditTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TokenForgetPassword extends Model implements Auditable
{
    use SoftDeletes,
        AuditTransaction;

    protected $table = 'token_forget_password';
    protected $primaryKey = 'id';
}