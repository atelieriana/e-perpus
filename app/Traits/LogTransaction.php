<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

trait LogTransaction
{
    public static function bootLogTransaction()
    {
        static::creating(function ($model) {
            $model->created_by = Session::get('access-data')->username;
            $model->updated_by = Session::get('access-data')->username;
        });

        static::updating(function ($model) {
            $model->updated_by = Session::get('access-data')->username;
        });

        static::deleting(function ($model) {
            $model->deleted_by = Session::get('access-data')->username;
            $model->deleted_at = Carbon::now(config('app.timezone'));
            $model->save();
        });
    }
}
