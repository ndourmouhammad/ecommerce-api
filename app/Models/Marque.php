<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marque extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function coques()
    {
        return $this->hasMany(Coque::class);
    }

    public function modele()
    {
        return $this->belongsTo(Modele::class);
    }
}
