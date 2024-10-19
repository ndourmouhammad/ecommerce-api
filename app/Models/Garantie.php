<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Garantie extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function garanties()
    {
        return $this->hasMany(GarantieProduit::class);
    }
}
