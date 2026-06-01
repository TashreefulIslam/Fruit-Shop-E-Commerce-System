<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'description',
        'image',
        'stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all cart items for this product.
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Get all order items for this product.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Check if product is in stock.
     */
    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    /**
     * Get a usable image URL for the product.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        $image = trim($this->image);

        if (Str::startsWith($image, ['http://', 'https://', '//', 'data:'])) {
            return $image;
        }

        if (Str::startsWith($image, 'public/')) {
            $image = Str::after($image, 'public/');
        }

        if (file_exists(public_path($image))) {
            return asset($image);
        }

        if (file_exists(storage_path('app/public/' . ltrim($image, '/')))) {
            return asset('storage/' . ltrim($image, '/'));
        }

        if (Str::startsWith($image, 'storage/')) {
            return asset($image);
        }

        return asset($image);
    }
}
