<?php

namespace App\Models\Store;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stock_quantity'];
    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
