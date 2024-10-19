<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paiement extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function livraison()
    {
        return $this->hasOne(Livraison::class);
    }
}
