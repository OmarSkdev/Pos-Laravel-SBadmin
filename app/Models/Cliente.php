<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function compra()
    {
        return $this->hasMany(Compra::class);
    }

    protected $fillable = ['persona_id'];
}
