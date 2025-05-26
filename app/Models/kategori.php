<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function produks()
    {
        return $this->hasMany(produk::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
