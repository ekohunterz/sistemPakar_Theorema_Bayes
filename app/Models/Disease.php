<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'probability',
        'solution',
        'image'
    ];

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('storage/diseases/' . basename($value)) : null
        );
    }
}