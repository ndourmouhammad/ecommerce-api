<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livraison extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
