<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coque extends Produit
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('coque', function (Builder $builder) {
            $builder->where('type', 'Coque');
        });
    }

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }
}
