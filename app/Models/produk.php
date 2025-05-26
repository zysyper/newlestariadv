<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'name',
        'slug',
        'images',
        'deskripsi',
        'harga',
        'is_active',
        'is_featured',
        'in_stock',
        'on_sale'

    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'in_stock' => 'boolean',
        'on_sale' => 'boolean'
    ];

    public function kategori() {
        return $this->belongsTo(kategori::class);
    }

    public function orderitem() {
        return $this->hasMany(orderitem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('in_stock', true);
    }

    public function scopeOnSale($query)
    {
        return $query->where('on_sale', true);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getPrimaryImageAttribute()
    {
        if (is_array($this->images) && count($this->images) > 0) {
            return $this->images[0];
        }

        return null;
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
