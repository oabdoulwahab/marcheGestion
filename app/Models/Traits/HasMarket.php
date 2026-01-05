<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasMarket
{
    protected static function booted()
    {
        static::creating(function ($model) {
            if (session()->has('current_market_id') && empty($model->market_id)) {
                $model->market_id = session('current_market_id');
            }
        });
    }

    public function scopeForCurrentMarket(Builder $query)
    {
        if (session()->has('current_market_id')) {
            return $query->where('market_id', session('current_market_id'));
        }

        return $query;
    }
}
