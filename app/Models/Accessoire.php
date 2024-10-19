<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accessoire extends Produit
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('accessoire', function (Builder $builder) {
            $builder->where('type', 'Accessoire');
        });
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
