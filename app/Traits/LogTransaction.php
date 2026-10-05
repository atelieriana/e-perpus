<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

trait LogTransaction
{
    public static function bootLogTransaction()
    {
        static::creating(function ($model) {
            $model->created_by = Session::get('access-data')->username ?? Session::get('name');
            $model->updated_by = Session::get('access-data')->username ?? Session::get('name');
        });

        static::updating(function ($model) {
            $model->updated_by = Session::get('access-data')->username ?? Session::get('name');
        });

        static::deleting(function ($model) {
            $model->deleted_by = Session::get('access-data')->username ?? Session::get('name');
            $model->deleted_at = Carbon::now();
            $model->save();
        });
    }
}
