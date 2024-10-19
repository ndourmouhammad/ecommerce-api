<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function getTypeAttribute($value)
    {
        return ucfirst($value);
    }

    public function image_produits()
    {
        return $this->hasMany(ImageProduit::class);
    }

    public function garanties()
    {
        return $this->hasMany(GarantieProduit::class);
    }

    public function commandes()
    {
        return $this->hasMany(CommandeProduit::class);
    }
}
